<?php

namespace Database\Seeders;

use App\Models\Summary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SummarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        

        Summary::create([
            'user_id' => 8,
            'title' => 'Bond papers',
            'requisition_id'=>1,
            'content' => '<p>Supplier 1 offering x amount</p>
                            <p>Supplier 2 offering x amount</p>
                            <p>Supplier 3 offering x amount</p>
                            <p>Supplier 4 offering x amount</p>',
        ]);
    }
}
