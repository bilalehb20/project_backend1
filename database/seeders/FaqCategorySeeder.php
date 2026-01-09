<?php

namespace Database\Seeders;

use App\Models\FaqCategory;
use Illuminate\Database\Seeder;

class FaqCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Bestellingen',
            'Verzending & Bezorging',
            'Garantie & Retourneren',
            'Producten',
            'Account & Betalingen',
        ];

        foreach ($categories as $category) {
            FaqCategory::create(['name' => $category]);
        }
    }
}
