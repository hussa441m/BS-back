<?php

namespace Database\Seeders;

use App\Models\AccountStatus;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $account_statuses = [
            [
                'id' => 1,
                'name' => 'active'
            ],
        ];
        AccountStatus::insert($account_statuses);
        $users = [
            ['id' => 1, 'name' => 'admin test', 'email' => 'admin@test.com', 'password' => '123', 'type' => 'admin', 'account_status_id' => 1],

            ['id' => 2, 'name' => 'customer test', 'email' => 'cust@test.com', 'password' => '123', 'type' => 'customer', 'account_status_id' => 1],

            ['id' => 3, 'name' => 'civil engineer test', 'email' => 'civl@test.com', 'password' => '123', 'type' => 'provider', 'account_status_id' => 1],
            ['id' => 4, 'name' => 'architectural engineer test', 'email' => 'arct@test.com', 'password' => '123', 'type' => 'provider', 'account_status_id' => 1],
            ['id' => 5, 'name' => 'contractor  test', 'email' => 'cont@test.com', 'password' => '123', 'type' => 'provider', 'account_status_id' => 1],
            ['id' => 6, 'name' => 'experience  test', 'email' => 'expr@test.com', 'password' => '123', 'type' => 'provider', 'account_status_id' => 1],
        ];
        User::insert($users);

        $roles = [
            ['id' => 1, 'name' => 'مهندس مدني',],
            ['id' => 2, 'name' => 'مهندس معماري',],
            ['id' => 3, 'name' => 'مقاول',],
        ];
        Role::insert($roles);

        $profiles = [
            ['is_consultant' => false, 'experience_start' => '2000-01-01', 'user_id' => 3, 'role_id' => 1],
            ['is_consultant' => false, 'experience_start' => '2005-01-01', 'user_id' => 4, 'role_id' => 2],
            ['is_consultant' => false, 'experience_start' => '2010-01-01', 'user_id' => 5, 'role_id' => 3],
            ['is_consultant' => true, 'experience_start' => '2015-01-01', 'user_id' => 6, 'role_id' => 1],
        ];
        Profile::insert($profiles);
    }
}
