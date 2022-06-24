<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Picture;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     public $sizes = [
        1,
        2,
        3,
        4,
        5,
    ];

    public function run()
    {
        Product::factory()
            ->count(80)->create()->each(function ($product) {

                // associate product with a random category
                $category = Category::inRandomOrder()->first();
                $product->category()->associate($category);

                shuffle($this->sizes);
                $size = rand(2, count($this->sizes) - 1);
                for($i = 0; $i <= $size; $i++) {
                    DB::table('product_size')->insert([
                        'product_id' => $product->id,
                        'size_id' => $this->sizes[$i],
                        ]);
                }
                // asociate a picture to each product and persist `new Pictures` to database
                $picture = Picture::create([
                    'name' => 'https://picsum.photos/200/30',
                ]);
                $picture->save();
                $product->picture()->associate($picture);

                // Persist `new Product` to database
                $product->save();
            });
    }
}
