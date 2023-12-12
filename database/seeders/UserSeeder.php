<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name' => 'Otong Surotong',
            'email' => 'otong@localhost',
            'password' => Hash::make('otong123'),
            'token' => 'rahasia'
        ]);

        User::create([
            'name' => 'Ucup Surucup',
            'email' => 'ucup@localhost',
            'password' => Hash::make('ucup123'),
            'token' => 'rahasia'
        ]);
    }
}
