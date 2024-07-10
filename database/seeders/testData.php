<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class testData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //add roles
        DB::table('roles')->insert([
            ['name' => 'user'],
            ['name' => 'admin'],
        ]);
        //add users
        DB::table('users')->insert([
            ['name' => 'mirko',
            'email' => 'mirko@mirko.com',
            'role_id' => 2,  //admin
            'password' => Hash::make('12345678'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()],
        ]);
        DB::table('users')->insert([
            ['name' => 'mirko1',
            'email' => 'mirko1@mirko.com',
            'password' => Hash::make('12345678'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'mirko2',
            'email' => 'mirko2@mirko.com',
            'password' => Hash::make('12345678'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()],
        ]);
        //add permissions
        DB::table('permissions')->insert([
            [
            'name' => 'manage_users',
            'description' => 'Create,update,delete,view users.'
            ],
            [
            'name' => 'manage_roles',
            'description' => 'Create,update,delete,view roles.'
            ],
            [
            'name' => 'manage_OWN_comments',
            'description' => 'Create,update,delete,view OWN comments.'
            ],
            [
            'name' => 'manage_ALL_comments',
            'description' => 'Create,update,delete,view ALL comments.'
            ],
            [
            'name' => 'manage_OWN_pages',
            'description' => 'Create,update,delete,view OWN pages.'
            ],
            [
            'name' => 'manage_ALL_pages',
            'description' => 'Create,update,delete,view ALL pages.'
            ],
            [
            'name' => 'manage_navigation',
            'description' => 'Manage navigation bar.'
            ],
        ]);
        //add pivot data role_permission for user,admin
        DB::table('role_permission')->insert([
            [
            'role_id' => 1,
            'permission_id' => 3
            ],
            [
            'role_id' => 2,
            'permission_id' => 1
            ],
            [
            'role_id' => 2,
            'permission_id' => 2
            ],
            [
            'role_id' => 2,
            'permission_id' => 3
            ],
            [
            'role_id' => 2,
            'permission_id' => 4
            ],
            [
            'role_id' => 2,
            'permission_id' => 5
            ],
            [
            'role_id' => 2,
            'permission_id' => 6
            ],
            [
            'role_id' => 2,
            'permission_id' => 7
            ],
        ]);
        //add page categories
        DB::table('page_categories')->insert([
            ['name' => 'Politics'],
            ['name' => 'Education'],
            ['name' => 'Health'],
            ['name' => 'Economy'],
            ['name' => 'Business'],
            ['name' => 'Entertainment'],
            ['name' => 'Sport'],
        ]);
    }
}
