<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Skill;
use App\Models\SkillSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'job_id' => 'required|exists:jobs,id',
                'phone' => 'required',
                'email' => 'required',
                'year' => 'required',
                'skill_sets_id' => 'required|array|exists:skills,id|min:1',
            ], [
                'name.required' => 'Nama lengkap anda belum dimasukkan.',
                'job_id.required' => 'Jabatan anda belum dimasukkan.',
                'job_id.exists' => 'Jabatan yang anda masukkan tidak tersedia di website ini.',
                'phone.required' => 'Nomor telepon anda belum dimasukkan.',
                'email.required' => 'Email anda belum dimasukkan.',
                'year.required' => 'Tahun lahir anda belum dimasukkan.',
                'skill_sets_id.required' => 'Skill anda belum dimasukkan.',
                'skill_sets_id.exists' => 'Skill yang anda masukkan tidak tersedia di website ini.',
                'skill_sets_id.min' => 'Skill yang anda masukkan minimal 1.',
            ]);

            if ($validator->fails()) {
                return response([
                    'error' => $validator->getMessageBag()
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
                    ]
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
                'request' => $payload
            ], 201);
        } catch (\Exception $e) {
            return response([
                'error' => $e
            ], 500);
        }
    }
}
