<?php

namespace Database\Seeders;

use App\Models\Requisition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequisitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['Bond Paper', 80, 5, 'High-quality bond paper for printing and writing purposes.', '2024-06-15',1],
            ['Pens', 45, 8, 'Pack of reliable ballpoint pens for everyday office use.', '2024-06-16',1],
            ['Diaries', 60, 8, 'Professional diaries for organizing schedules and notes.', '2024-06-17',1],
            ['Flat files', 140, 5, 'Durable flat files for storing and organizing documents.', '2024-06-18',1],
            ['Box files', 80, 6, 'Sturdy box files for secure document storage.', '2024-06-19',1],
            ['Accessible files', 40, 6, 'Accessible files for quick and easy document retrieval.', '2024-06-20',1],
            ['Sticky notes', 70, 4, 'Colorful sticky notes for reminders and annotations.', '2024-06-21',0],
            ['Cellotape', 35, 4, 'Transparent adhesive tape for sealing and mounting.', '2024-06-22',0],
            ['Stapler & pins', 25, 10, 'Handheld stapler with a pack of pins for securing documents.', '2024-06-23',0],
            ['Cartridge', 30, 18, 'Printer cartridge for high-quality printing.', '2024-06-24',0],
            ['Highlighters', 40, 5, 'Set of bright highlighter markers for emphasizing text.', '2024-06-25',0],
            ['Scissors', 35, 6, 'Sharp scissors for cutting paper and other materials.', '2024-06-26',0],
            ['Toilet cleaner', 25, 10, 'Effective toilet cleaner for maintaining hygiene.', '2024-06-27',0],
            ['Tissue paper', 160, 4, 'Soft tissue paper for personal hygiene and cleaning.', '2024-06-28',0],
            ['Liquid soap', 35, 7, 'Liquid hand soap for gentle and effective cleansing.', '2024-06-29',0],
            ['Furniture polish', 30, 12, 'Furniture polish for maintaining a clean and shiny surface.', '2024-06-30',0],
            ['Mop', 25, 15, 'Durable mop for cleaning floors and other surfaces.', '2024-07-01',0],
            ['Brooms', 25, 12, 'Sturdy brooms for sweeping dirt and debris.', '2024-07-02',0],
            ['Air fresheners', 25, 10, 'Air fresheners for maintaining a pleasant environment.', '2024-07-03',0],
            ['Cleaning gloves', 35, 6, 'Protective cleaning gloves for hand hygiene and safety.', '2024-07-04',0],
            ['Hand wash', 45, 8, 'Antibacterial hand wash for thorough cleaning and protection.', '2024-07-05',0],
            ['Toilet brush', 25, 10, 'Durable toilet brush for effective cleaning.', '2024-07-06',0],
            ['Bin plastics', 80, 5, 'Strong bin plastics for waste disposal and organization.', '2024-07-07',0],
            ['Fuel', 80, 6, 'Fuel for powering equipment and vehicles.', '2024-07-08',0]
        ];
    
        foreach ($items as $item) {
            Requisition::create([
                'title' => $item[0],
                'quantity' => $item[1],
                'unit_price' => $item[2], // Assigning the unit price from the array
                'user_id' => 7, // Assuming this is the user ID for the requisition
                'description' => $item[3], // Assigning the description from the array
                'delivery_date' => $item[4], // Assigning the delivery date from the array
                // Assuming other fields need to be set as well
                'approved'=>$item[5]
            ]);
        }
    }
}
