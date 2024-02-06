<?php

namespace Database\Seeders;

use App\Models\UserResponse;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserResponse::factory()
            ->count(50) 
            ->create();
    }
}
