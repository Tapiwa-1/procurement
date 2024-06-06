<?php

namespace Database\Seeders;

use App\Models\Summary;
use App\Models\TaxClearance;
use App\Models\TaxInvoice;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TaxClearenceSeeder::class);
        $this->call(SupplierStockSeeder::class);
        $this->call(RequisitionSeeder::class);
        $this->call(QuotationSeeder::class);
        $this->call(SummarySeeder::class);
        
    }
}
