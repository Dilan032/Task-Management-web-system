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
                'name' => 'super admin',
                'user_type' => 'super admin',
                'status' => 'active',
                'email' => 'super.admin@gmail.com',
                'user_contact_num' => '0718896345',
                'password' => Hash::make('12345678')

            ],
            
        ]);
    }
}
