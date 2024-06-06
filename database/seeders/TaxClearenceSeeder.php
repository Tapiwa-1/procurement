<?php

namespace Database\Seeders;

use App\Models\TaxClearance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxClearenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaxClearance::create([
            'user_id' => 2,
            'file'=> '/file/1.png'
        ]);
        // TaxClearance::create([
        //     'user_id' => 3,
        //     'file'=> '/file/2.png'
        // ]);
        // TaxClearance::create([
        //     'user_id' => 4,
        //     'file'=> '/file/3.png'
        // ]);
      
    }
}
