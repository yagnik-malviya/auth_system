<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'yagnik',
            'email' => 'yagnikfruxinfo121@gmail.com',
            'mobile' => '7779058869',
            'password' => Hash::make('12345678'),
            'text_password' => '12345678',
        ]);
    }
}
