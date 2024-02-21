<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Job;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $jobs = [
            [
                'name' => 'Frontend Web Programmer',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Fullstack Web Programmer',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Quality Control',
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ];

        foreach ($jobs as $job) {
            Job::create($job);
        }

        $skills = [
            [
                'name' => 'PHP',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'PostgreSQL',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'API (JSON, REST)',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Version Control System (Gitlab, Github)',
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
