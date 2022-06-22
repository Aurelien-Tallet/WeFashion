<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Picture;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()
            ->count(80)->create()->each(function ($product) {
                $category = Category::inRandomOrder()->first();
                $product->category()->associate($category);
                $picture = Picture::create([
                    'name' => 'https://picsum.photos/200/30',
                ]);
                $picture->save();
                $product->picture()->associate($picture);
                // $product->size()->associate(Size::all()->random(5));
                $product->save();
            });

        Product::destroy(1);
    }
}
