<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            
            // super admin
            [
                'name' => 'superadmin',
                'user_type' => 'super admin',
                'status' => 'active',
                'email' => 'super.admin@gmail.com',
                'user_contact_num' => '0718896345',
                'password' => Hash::make('12345678')

            ],

             // administrator
             [
                'bank_id' => '1',
                'name' => 'administrator',
                'user_type' => 'administrator',
                'status' => 'active',
                'email' => 'administrator@gmail.com',
                'user_contact_num' => '0779985634',
                'password' => Hash::make('12345678')

            ],

             // user
             [
                'bank_id' => '1',
                'name' => 'user',
                'user_type' => 'user',
                'status' => 'active',
                'email' => 'dilan08@gmail.com',
                'user_contact_num' => '0726548931',
                'password' => Hash::make('12345678')

            ],
        ]);
    }
}
