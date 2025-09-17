<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'teacher', 'parent', 'student', 'hod', 'librarian', 'accountant', 'receptionist', 'principal', 'vice_principal', 'clerk', 'security', 'driver', 'nurse', 'counselor', 'coach', 'janitor', 'it_staff', 'cafeteria_staff'];

         // Insert roles into the roles table
         // Using Eloquent Model
         // Make sure to import the Role model at the top
         // use App\Models\Role;

        foreach ($roles as $role) {
            \App\Models\Role::create(['name' => $role]);
        }
    }
}
