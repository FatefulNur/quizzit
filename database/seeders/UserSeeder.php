<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->admin()->create();

        // User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@test.com',
        //     'role' => Role::ADMIN
        // ]);

        // User::factory()->create([
        //     'name' => 'Seller',
        //     'email' => 'seller@test.com',
        // ]);
    }
}
