<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'yagnik',
            'email' => 'yagnikfruxinfo121@gmail.com',
            'mobile' => '7779058869',
            'role' => 'admin',
            'password' => Hash::make('12345678'),
        ]);
    }
}
