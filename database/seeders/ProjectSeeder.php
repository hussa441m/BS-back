<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projectTypes = [
            ['name' => 'تسليم مشروع كامل' ],
            ['name' => 'إشراف' ],
            ['name' => 'تنفيذ ' ],
            ['name' => 'تصميم معماري' ],
        ];
        ProjectType::insert($projectTypes);
        
        $projects = [
            [
                'start_date' => '2026-01-01',
                'duration' => 3,
                'area' =>  1000,
                'location_details' => 'Mazeh',
                'description' => '',
                'building_no' => '123',
                'note' => '',
                'status' => 'new',
                'project_type_id' => 1,
                'customer_id' => 2,
                'performed_by' => 3
            ]
        ];
        Project::insert($projects);
    }
}
