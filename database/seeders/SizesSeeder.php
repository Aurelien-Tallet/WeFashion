<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    const SIZES = [
        'XS',
        'S',
        'M',
        'L',
        'XL',
    ];
    public function run()
    {
        foreach (self::SIZES as $size) {
            Size::create([
                'name' => $size,
            ]);
        }
    }
}
