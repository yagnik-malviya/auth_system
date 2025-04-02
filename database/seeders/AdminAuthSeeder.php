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
            'userName'     => 'fruxinfo',
            'name'         => 'yagnik',
            'email'        => 'yagnikfruxinfo121@gmail.com',
            'mobile'       => '7779058869',
            'password'     => Hash::make('letsdoit'),
            'textPassword'=> 'letsdoit',
        ]);
    }
}
