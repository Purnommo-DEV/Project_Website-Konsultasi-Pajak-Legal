<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'kode' => 'ADM-001',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'nik' => '11111111',
            'password' => Hash::make('22222222'),
            'role_id' => 1
        ]);

        \App\Models\User::create([
            'kode' => 'KSL-001',
            'name' => 'Konsultan',
            'email' => 'konsultan@gmail.com',
            'nik' => '22222222',
            'password' => Hash::make('22222222'),
            'role_id' => 2
        ]);

        \App\Models\User::create([
            'kode' => 'CL-001',
            'name' => 'Client',
            'email' => 'client@gmail.com',
            'nik' => '33333333',
            'password' => Hash::make('22222222'),
            'role_id' => 3
        ]);
    }
}
