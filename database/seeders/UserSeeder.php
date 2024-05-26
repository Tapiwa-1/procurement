<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $roles = [
            
            "Administrator",
            "Receptionist",
            "Procurement Officer",
            "Assistant Group Accountant",
            "Verification Assistant",
            "Verification Officer",
            "Group Accountant",
            "General Manager",
            "Fm Payments teclar",
        ];
        $user= User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            
        ])->assignRole('admin');

        $user= User::factory()->create([
            'name' => 'Supplier1',
            'email' => 'Supplier1@example.com',
            
        ])->assignRole('Vendor/Supplier');

        $user= User::factory()->create([
            'name' => 'Supplier2',
            'email' => 'Supplier2@example.com',
            
        ])->assignRole('Vendor/Supplier');

        $user= User::factory()->create([
            'name' => 'Supplier3',
            'email' => 'Supplier3@example.com',
            
        ])->assignRole('Vendor/Supplier');

        $user= User::factory()->create([
            'name' => 'Supplier4',
            'email' => 'Supplier4@example.com',
            
        ])->assignRole('Vendor/Supplier');

        foreach ($roles as $role) {
                $user= User::factory()->create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                
            ])->assignRole($role);
        }
    }
}
