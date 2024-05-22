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
            "Procurement Manager",
            "Procurement Officer",
            "Finance Officer",
            "Vendor/Supplier",
            "Technical Evaluator",
            "Legal Advisor",
            "Compliance Officer",
            "IT Administrator",
            "User Support Specialist",
            "Quality Assurance Officer",
            "Project Manager",
            "Stakeholder Liaison",
            "Reporting Analyst"
        ];
        $user= User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            
        ])->assignRole('admin');

        foreach ($roles as $role) {
                $user= User::factory()->create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                
            ])->assignRole($role);
        }
    }
}
