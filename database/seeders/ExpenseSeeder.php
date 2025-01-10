<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\Category;
use Illuminate\Database\Seeder;
class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = Category::all();

        // Crear 20 gastos de prueba
        for ($i = 0; $i < 20; $i++) {
            Expense::create([
                'description' => "Gasto de prueba #" . ($i + 1),
                'amount' => rand(10000, 1000000), // Valores en COP
                'date' => now()->subDays(rand(0, 30)),
                'category_id' => $categories->random()->id
            ]);
        }
    }
}
