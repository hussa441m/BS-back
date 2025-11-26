<?php

namespace Database\Seeders;

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
        ProjectType::create($projectTypes);
        
    }
}
