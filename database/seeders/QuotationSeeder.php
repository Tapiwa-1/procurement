<?php

namespace Database\Seeders;

use App\Models\Quotation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuotationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        function random_float($min, $max) {
            return $min + mt_rand() / mt_getrandmax() * ($max - $min);
        }
        
        // Loop to create entries for user_ids 3, 4, 5, and 6
        for ($i = 2; $i <= 5; $i++) {
            // Generate a random unit price within the range of 4.0 to 6.0
            $unit_price = number_format(random_float(4.0, 6.0), 2);
            
            // Create a new entry
            Quotation::create([
                'user_id' => $i,
                'title' => 'Bond papers',
                'requisition_id'=>1,
                'description' => 'A4 Bond Papers',
                'unit_price' => $unit_price,
                'quantity' => 10,
            ]);
        }
    }
}
