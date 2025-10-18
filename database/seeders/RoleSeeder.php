<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run()
    {
        if (!User::where('email', 'super@local.test')->exists()) {
            User::create([
                'name' => 'Super Admin',
                'email' => 'super@local.test',
                'phone' => '01700000000',
                'password' => Hash::make('password'),
                'role' => 'super-admin',
            ]);
        }

        // Admin
        if (!User::where('email', 'admin@local.test')->exists()) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@local.test',
                'phone' => '01711111111',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);
        }

        // Manager
        if (!User::where('email', 'manager@local.test')->exists()) {
            User::create([
                'name' => 'Manager User',
                'email' => 'manager@local.test',
                'phone' => '01722222222',
                'password' => Hash::make('password'),
                'role' => 'manager',
            ]);
        }

        // Salesman
        if (!User::where('email', 'salesman@local.test')->exists()) {
            User::create([
                'name' => 'Salesman User',
                'email' => 'sales@local.test',
                'phone' => '01733333333',
                'password' => Hash::make('password'),
                'role' => 'salesman',
            ]);
        }
    }
}
