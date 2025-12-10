<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Seed the product catalog with random data.
     */
    public function run(): void
    {
        Product::factory()->count(100)->create();
    }
}
