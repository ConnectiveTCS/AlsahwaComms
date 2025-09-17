<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        $adminUser = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@acewebdesign.co.za',
            'password' => Hash::make('1'),
        ]);
        
        RoleUser::factory()->create([
            'user_id' => $adminUser->id,
            'role_id' => 1, // Assuming 1 is the ID for Admin role
        ]);


    }
}
