<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projectTypes = [
            ['id' => 1,'name' => 'تنفيذ ' ],
            ['id' => 2,'name' => 'تصميم معماري' ],
            ['id' => 3,'name' => 'إشراف' ],
            ['id' => 4,'name' => 'استشارة ' ],
            ['id' => 5,'name' => 'تسليم مشروع كامل' ],
        ];
        ProjectType::insert($projectTypes);
        
        $roles = [
            ['id' => 1, 'name' => 'مقاول',],
            ['id' => 2, 'name' => 'مهندس معماري',],
            ['id' => 3, 'name' => 'مهندس مدني',],
            ['id' => 4, 'name' => 'مهندس مدني استشاري',],
            ['id' => 5, 'name' => 'المكاتب الهندسية',],
        ];
        Role::insert($roles);

        $profileProjectTypes = [
            ['role_id' => 1 ,'project_type_id' => 1],
            ['role_id' => 2,'project_type_id' => 2],
            ['role_id' => 3,'project_type_id' => 3],
            ['role_id' => 4 ,'project_type_id' => 4],
            ['role_id' => 5,'project_type_id' =>5],
        ];
        foreach ($profileProjectTypes as $profileProjectType ){
            Role::find($profileProjectType['role_id'])->projectTypes()->attach($profileProjectType['project_type_id']);
        }

        $users = [
            ['id' => 1, 'name' => 'admin test', 'email' => 'admin@test.com', 'password' => Hash::make('123456'), 'type' => 'admin', ],

            ['id' => 2, 'name' => 'customer test', 'email' => 'cust@test.com', 'password' => Hash::make('123456'), 'type' => 'customer', ],

            ['id' => 3, 'name' => 'civil engineer test', 'email' => 'civl@test.com', 'password' => Hash::make('123456'), 'type' => 'provider', ],
            ['id' => 4, 'name' => 'architectural engineer test', 'email' => 'arct@test.com', 'password' => Hash::make('123456'), 'type' => 'provider', ],
            ['id' => 5, 'name' => 'contractor  test', 'email' => 'cont@test.com', 'password' => Hash::make('123456'), 'type' => 'provider', ],
            ['id' => 6, 'name' => 'experience  test', 'email' => 'expr@test.com', 'password' => Hash::make('123456'), 'type' => 'provider', ],
        ];
        User::insert($users);

        

        $profiles = [
            ['is_consultant' => false, 'experience_start' => '2000-01-01', 'user_id' => 3, 'role_id' => 1],
            ['is_consultant' => false, 'experience_start' => '2005-01-01', 'user_id' => 4, 'role_id' => 2],
            ['is_consultant' => false, 'experience_start' => '2010-01-01', 'user_id' => 5, 'role_id' => 3],
            ['is_consultant' => true, 'experience_start' => '2015-01-01', 'user_id' => 6, 'role_id' => 1],
        ];
        Profile::insert($profiles);

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
