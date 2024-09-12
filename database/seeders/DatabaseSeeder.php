<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'super admin',
            'user_type' => 'super admin',
            'status' => 'active',
            'email' => 'super.admin@gmail.com',
            'user_contact_num' => '0718896345',
            'password' => Hash::make('12345678')
        ]);
    }
}
