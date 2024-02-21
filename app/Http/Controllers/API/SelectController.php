<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Skill;
use Illuminate\Http\Request;

class SelectController extends Controller
{
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
