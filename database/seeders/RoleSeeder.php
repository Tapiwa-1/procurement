<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin',]);
        Role::create(['name' => 'Administrator']);
        Role::create(['name' => 'Procurement Manager']);
        Role::create(['name' => 'Procurement Officer']);
        Role::create(['name' => 'Finance Officer']);
        Role::create(['name' => 'Vendor/Supplier']);
        Role::create(['name' => 'Technical Evaluator']);
        Role::create(['name' => 'Legal Advisor']);
        Role::create(['name' => 'Compliance Officer']);
        Role::create(['name' => 'IT Administrator']);
        Role::create(['name' => 'User Support Specialist']);
        Role::create(['name' => 'Quality Assurance Officer']);
        Role::create(['name' => 'Project Manager']);
        Role::create(['name' => 'Stakeholder Liaison']);
        Role::create(['name' => 'Reporting Analyst']);
    }
}
