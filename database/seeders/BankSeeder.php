<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('banks')->insert([
            
            // bank 1
            [
                'bank_name' => 'FIC bank',
                'bank_address' => 'kurunegala',
                'bank_contact_num' => '0789632147',
                'email' => 'fic.bank@gmail.com',
                'status' => 'active',
            ],

            // bank 2
            [
                'bank_name' => 'Sanasa bank',
                'bank_address' => 'puttalam',
                'bank_contact_num' => '0789658742',
                'email' => 'sanasa.bank@gmail.com',
                'status' => 'active',
            ],

            
        ]);
    }
}
