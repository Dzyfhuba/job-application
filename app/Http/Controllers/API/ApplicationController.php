<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Skill;
use App\Models\SkillSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * @OA\Post(
     *     path="/application",
     *     operationId="applicationPost",
     *     tags={"application"},
     *     summary="Store application",
     *     description="Store application",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="job_id",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="year",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="skill_sets_id",
     *                     type="array",
     *                     @OA\Items(type="integer"),
     *                     description="An array of skill set IDs",
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Success response",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="pesan berhasil"
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Failed response - Pesan Kesalahan",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Pesan Kesalahan"
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Exception occurred",
     *     ),
     * )
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'job_id' => 'required|exists:jobs,id',
                'phone' => 'required|regex:/^0\d{9,13}$/',
                'email' => 'required',
                'year' => 'required',
                'skill_sets_id' => 'required|array|exists:skills,id|min:1',
            ], [
                'name.required' => 'Nama lengkap anda belum dimasukkan.',
                'job_id.required' => 'Jabatan anda belum dimasukkan.',
                'job_id.exists' => 'Jabatan yang anda masukkan tidak tersedia di website ini.',
                'phone.required' => 'Nomor telepon anda belum dimasukkan.',
                'phone.regex' => 'Nomor telepon yang anda masukkan tidak sesuai standar kami. Contoh: 012301230123.',
                'email.required' => 'Email anda belum dimasukkan.',
                'year.required' => 'Tahun lahir anda belum dimasukkan.',
                'skill_sets_id.required' => 'Skill anda belum dimasukkan.',
                'skill_sets_id.exists' => 'Skill yang anda masukkan tidak tersedia di website ini.',
                'skill_sets_id.min' => 'Skill yang anda masukkan minimal 1.',
            ]);

            if ($validator->fails()) {
                return response([
                    'error' => $validator->getMessageBag(),
                    'message' => 'Lamaran yang anda kirim terdapat kesalahan input.',
                ], 400);
            }
            $payload = $validator->validated();

            $invalidEmail = Candidate::query()
                ->where('job_id', $payload['job_id'])
                ->where('email', $payload['email'])
                ->exists();
            $invalidPhone = Candidate::query()
                ->where('job_id', $payload['job_id'])
                ->where('phone', $payload['phone'])
                ->exists();

            if ($invalidEmail || $invalidPhone) {
                return response([
                    'error' => [
                        'email' => $invalidEmail ? ['Email yang anda masukkan sudah pernah melamar dijabatan tersebut, silahkan memilih jabatan yang lain.'] : null,
                        'phone' => $invalidPhone ? ['Nomor Telepon yang anda masukkan sudah pernah melamar dijabatan tersebut, silahkan memilih jabatan yang lain.'] : '',
                    ],
                    'message' => 'Lamaran yang anda kirim terdapat kesalahan input.'
                ], 400);
            }

            $candidate = Candidate::create($payload);

            foreach ($payload['skill_sets_id'] as $skill) {
                SkillSet::create([
                    'candidate_id' => $candidate->id,
                    'skill_id' => $skill
                ]);
            }

            return response([
                'message' => 'Lamaran anda telah kami terima.',
            ], 201);
        } catch (\Exception $e) {
            return response([
                'error' => $e,
                'message' => 'Terdapat kesalahan sistem. Segera laporankan ke kontak kami.'
            ], 500);
        }
    }
}
