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
            'address' => 'Zimbabwe, Harare, Jason Moyo Avenue, Building 123',
            'phone' => '+263123456789'
        ])->assignRole('Vendor/Supplier');
        
        $user= User::factory()->create([
            'name' => 'Supplier2',
            'email' => 'Supplier2@example.com',
            'address' => 'Zimbabwe, Bulawayo, Leopold Takawira Avenue, Building 456',
            'phone' => '+263987654321'
        ])->assignRole('Vendor/Supplier');
        
        $user= User::factory()->create([
            'name' => 'Supplier3',
            'email' => 'Supplier3@example.com',
            'address' => 'Zimbabwe, Mutare, Robert Mugabe Road, Building 789',
            'phone' => '+263555555555'
        ])->assignRole('Vendor/Supplier');
        
        $user= User::factory()->create([
            'name' => 'Supplier4',
            'email' => 'Supplier4@example.com',
            'address' => 'Zimbabwe, Gweru, Josiah Tongogara Street, Building 1011',
            'phone' => '+263111111111'
        ])->assignRole('Vendor/Supplier');

        foreach ($roles as $role) {
                $user= User::factory()->create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                
            ])->assignRole($role);
        }
    }
}
