<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@api.com',
            'password' => Hash::make('123456'),
            'saldo' => 0,
            'role' => 'admin'
        ]);
    }
}