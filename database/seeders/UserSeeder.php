<?php

namespace Database\Seeders;

use App\Models\UsersModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UsersModel::insert([
            [
                'username' => 'test user',
                'email' => 'r@gmail.com',
                'password' => bcrypt('123'),
            ]
        ]);
    }
}
