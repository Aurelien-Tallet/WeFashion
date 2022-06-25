<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Picture;
use App\Models\Product;
use App\Models\Size;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private function microseconds()
    {
        $mt = explode(' ', microtime());
        return ((int)$mt[1]) * 1000000 + ((int)round($mt[0] * 1000000));
    }

    public function run()
    {
        Product::factory()
            ->count(80)->create()->each(function ($product) {

                // associate product with a random category
                $category = Category::inRandomOrder()->first();
                $product->category()->associate($category);

                $sizes = Size::pluck('id')->shuffle()->slice(0, rand(1, 4))->toArray();
                $product->sizes()->sync($sizes);
                // asociate a picture to each product and persist `new Pictures` to database
                $files = Storage::Files('public/images/' . $category->name);
                $randomFile = $files[rand(0, count($files) - 1)];

                // Get just Extension
                $extension = pathinfo(
                    parse_url($randomFile, PHP_URL_PATH),
                    PATHINFO_EXTENSION
                );
                // Get Filename
                $filename = basename($randomFile, ".{$extension}");

                // Filename To store
                $fileNameToStore = $filename . '_' . $this->microseconds() . ".{$extension}";
                Storage::copy($randomFile, 'public/image/' . $fileNameToStore);
                $picture = Picture::create([
                    'name' => $fileNameToStore,
                ]);
                $picture->save();
                $product->picture()->associate($picture);

                // Persist `new Product` to database
                $product->save();
            });
    }
}
