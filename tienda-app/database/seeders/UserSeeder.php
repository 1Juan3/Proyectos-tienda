<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@localhost',
            'username'=> 'admin',
            'id_tienda'=>1,
            'password' => bcrypt('1234'),
        ])->assignRole('Admin');
    }
}