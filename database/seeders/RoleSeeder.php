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
        Role::create(['name' => 'Receptionist']);
        Role::create(['name' => 'Procurement Officer']);
        Role::create(['name' => 'Assistant Group Accountant']);
        Role::create(['name' => 'Vendor/Supplier']);
        Role::create(['name' => 'Verification Assistant']);
        Role::create(['name' => 'Verification Officer']);
        Role::create(['name' => 'Group Accountant']);
        Role::create(['name' => 'General Manager']);
        Role::create(['name' => 'Fm Payments teclar']);
    
    }
}
