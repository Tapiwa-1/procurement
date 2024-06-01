<?php

namespace Database\Seeders;

use App\Models\SupplierStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userProducts = [
            2 => [
                ['Bond Paper', 50, 2],
                ['Pens', 30, 4],
                ['Diaries', 40, 4],
                ['Flat files', 100, 2],
                ['Box files', 60, 3],
                ['Accessible files', 20, 3],
                ['Sticky notes', 50, 1],
                ['Cellotape', 20, 1],
                ['Stapler & pins', 10, 5],
                ['Cartridge', 15, 10],
                ['Highlighters', 25, 2],
                ['Scissors', 20, 3],
                ['Toilet cleaner', 10, 5],
                ['Tissue paper', 100, 1],
                ['Liquid soap', 20, 4],
                ['Furniture polish', 15, 6],
                ['Mop', 10, 8],
                ['Brooms', 10, 7],
                ['Air fresheners', 10, 5],
                ['Cleaning gloves', 20, 3],
                ['Hand wash', 30, 4],
                ['Toilet brush', 10, 5],
                ['Bin plastics', 50, 2],
                ['Fuel', 50, 3],
                // Add more products for user_id 2 here
            ],
            3 => [
                ['Bond Paper', 60, 3],
                ['Pens', 35, 5],
                ['Diaries', 45, 5],
                ['Flat files', 110, 3],
                ['Box files', 65, 4],
                ['Accessible files', 25, 4],
                ['Sticky notes', 55, 2],
                ['Cellotape', 25, 2],
                ['Stapler & pins', 15, 6],
                ['Cartridge', 20, 12],
                ['Highlighters', 30, 3],
                ['Scissors', 25, 4],
                ['Toilet cleaner', 15, 6],
                ['Tissue paper', 120, 2],
                ['Liquid soap', 25, 5],
                ['Furniture polish', 20, 8],
                ['Mop', 15, 10],
                ['Brooms', 15, 9],
                ['Air fresheners', 15, 6],
                ['Cleaning gloves', 25, 4],
                ['Hand wash', 35, 5],
                ['Toilet brush', 15, 6],
                ['Bin plastics', 60, 3],
                ['Fuel', 60, 4],
                // Add more products for user_id 3 here
            ],
            4 => [
                ['Bond Paper', 70, 4],
                ['Pens', 40, 6],
                ['Diaries', 50, 6],
                ['Flat files', 120, 4],
                ['Box files', 70, 5],
                ['Accessible files', 30, 5],
                ['Sticky notes', 60, 3],
                ['Cellotape', 30, 3],
                ['Stapler & pins', 20, 8],
                ['Cartridge', 25, 15],
                ['Highlighters', 35, 4],
                ['Scissors', 30, 5],
                ['Toilet cleaner', 20, 8],
                ['Tissue paper', 140, 3],
                ['Liquid soap', 30, 6],
                ['Furniture polish', 25, 10],
                ['Mop', 20, 12],
                ['Brooms', 20, 10],
                ['Air fresheners', 20, 8],
                ['Cleaning gloves', 30, 5],
                ['Hand wash', 40, 6],
                ['Toilet brush', 20, 8],
                ['Bin plastics', 70, 4],
                ['Fuel', 70, 5],
                // Add more products for user_id 4 here
            ],
            5 => [
                ['Bond Paper', 80, 5],
                ['Pens', 45, 8],
                ['Diaries', 60, 8],
                ['Flat files', 140, 5],
                ['Box files', 80, 6],
                ['Accessible files', 40, 6],
                ['Sticky notes', 70, 4],
                ['Cellotape', 35, 4],
                ['Stapler & pins', 25, 10],
                ['Cartridge', 30, 18],
                ['Highlighters', 40, 5],
                ['Scissors', 35, 6],
                ['Toilet cleaner', 25, 10],
                ['Tissue paper', 160, 4],
                ['Liquid soap', 35, 7],
                ['Furniture polish', 30, 12],
                ['Mop', 25, 15],
                ['Brooms', 25, 12],
                ['Air fresheners', 25, 10],
                ['Cleaning gloves', 35, 6],
                ['Hand wash', 45, 8],
                ['Toilet brush', 25, 10],
                ['Bin plastics', 80, 5],
                ['Fuel', 80, 6],
                // Add more products for user_id 5 here
            ],
            // Add more user_ids and their products here
        ];
    
        foreach ($userProducts as $userId => $products) {
            foreach ($products as $product) {
                SupplierStock::create([
                    'user_id' => $userId,
                    'product_name' => $product[0],
                    'quantity' => $product[1],
                    'price' => $product[2]
                ]);
            }
        }
    }
    
}
