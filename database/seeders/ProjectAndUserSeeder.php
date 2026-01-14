<?php

namespace Database\Seeders;

use App\Models\ContactType;
use App\Models\Profile;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProjectAndUserSeeder extends Seeder
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
            
            ['id' => 1, 'name' => 'builder test', 'email' => 'builder@test.com', 'password' => Hash::make('123456'), 'type' => 'client', ],
            ['id' => 2, 'name' => 'architectural engineer test', 'email' => 'arct@test.com', 'password' => Hash::make('123456'), 'type' => 'client', ],
            ['id' => 3, 'name' => 'civil engineer test', 'email' => 'civil@test.com', 'password' => Hash::make('123456'), 'type' => 'client', ],
            ['id' => 4, 'name' => 'experience  test', 'email' => 'exper@test.com', 'password' => Hash::make('123456'), 'type' => 'client', ],
            ['id' => 5, 'name' => 'office  test', 'email' => 'office@test.com', 'password' => Hash::make('123456'), 'type' => 'client', ],

            ['id' => 6, 'name' => 'admin test', 'email' => 'admin@test.com', 'password' => Hash::make('123456'), 'type' => 'admin', ],

            ['id' => 7, 'name' => 'customer test', 'email' => 'cust@test.com', 'password' => Hash::make('123456'), 'type' => 'customer', ],
        ];
        User::insert($users);

        

        $profiles = [
            [ 'experience_start' => '2000-01-01', 'user_id' => 1, 'role_id' => 1],
            [ 'experience_start' => '2005-01-01', 'user_id' => 2, 'role_id' => 2],
            [ 'experience_start' => '2010-01-01', 'user_id' => 3, 'role_id' => 3],
            [ 'experience_start' => '2015-01-01', 'user_id' => 4, 'role_id' => 4],
            [ 'experience_start' => '2020-01-01', 'user_id' => 5, 'role_id' => 5],
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
                'province_id' => 2,
                'customer_id' => 2,
                'performed_by' => 3
            ]
        ];
        Project::insert($projects);
        $contactTypes = [
            ['name' => 'phone'],
            ['name' => 'whatsApp'],
            ['name' => 'Telegram'],
        ];
        ContactType::insert($contactTypes);
    }
}
