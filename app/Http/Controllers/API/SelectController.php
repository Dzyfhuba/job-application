<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Skill;
use Illuminate\Http\Request;

/**
 *
 *         @OA\Schema(
 *             schema="Resource",
 *             type="object",
 *             properties={
 *                 @OA\Property(property="id", type="integer"),
 *                 @OA\Property(property="text", type="string"),
 *             }
 *         )
 */
class SelectController extends Controller
{
    /**
     * @OA\Get(
     *     path="/select/jobs",
     *     tags={"select"},
     *     summary="Get select options",
     *     description="Retrieve a list of jobs as option",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Resource")
     *         )
     *     ),
     * )
     */
    public function jobs(Request $request)
    {
        try {
            $search = $request->query('term');

            $data = Job::query();

            if ($search) $data = $data->where('name', 'LIKE', "%$search%");


            return response([
                'results' => $data->select('id', 'name as text')->get(),
                'search' => $search
            ]);
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/select/skills",
     *     tags={"select"},
     *     summary="Get select options",
     *     description="Retrieve a list of skills as option",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Resource")
     *         )
     *     ),
     * )
     */
    public function skills(Request $request)
    {
        try {
            $search = $request->query('term');

            $data = Skill::query();

            if ($search) $data = $data->where('name', 'LIKE', "%$search%");


            return response([
                'results' => $data->select('id', 'name as text')->get(),
                'search' => $search
            ]);
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
