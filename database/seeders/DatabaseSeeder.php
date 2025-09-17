<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        // Admin User
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@acewebdesign.co.za',
            'password' => Hash::make('1'),
            'role_id' => 1,
        ]);
        // Teacher User
        User::factory()->create([
            'name' => 'Teacher User',
            'email' => 'teacher@acewebdesign.co.za',
            'password' => Hash::make('1'),
            'role_id' => 2,
        ]);
        // Parent User
        User::factory()->create([
            'name' => 'Parent User',
            'email' => 'parent@acewebdesign.co.za',
            'password' => Hash::make('1'),
            'role_id' => 3,
        ]);
    }
}
