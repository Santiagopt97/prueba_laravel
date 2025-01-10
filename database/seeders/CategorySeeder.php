<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = ['Comida', 'Transporte', 'Ocio', 'Servicios', 'Otros'];
        
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
