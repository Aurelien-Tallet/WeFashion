<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    const CATEGORIES = [
        'femme',
        'homme',
    ];
    public function run()
    {
        //
        foreach (self::CATEGORIES as $category) {
            Category::create([
                'name' => $category,
            ]);
        }
    }
}
