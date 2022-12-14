<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Product::factory()->count(10)->create();
        Product::create([
            'name' => 'iPhone 12 Pro Max',
            'price' => 12500000,
            'description' => 'iPhone 12 Pro Max is the best phone in the world',
            'image' => 'Apple iPhone 12.jpg',
            'year' => 2020,
            'UserID' => 1,
        ]);
        Product::create([
            'name' => 'iPhone 11 ',
            'price' => 9200000,
            'description' => 'iPhone 11 is the best phone in the world',
            'image' => 'Apple iPhone 11.jpg',
            'year' => 2019,
            'UserID' => 2,
        ]);
        Product::create([
            'name' => 'Google Pixel 4',
            'price' => 7000000,
            'description' => 'Google Pixel 4 is the best phone in the world',
            'image' => 'Google Pixel 4.jpg',
            'year' => 2018,
            'UserID' => 3,
        ]);
        Product::create([
            'name' => 'Oppo Find X2',
            'price' => 23200000,
            'description' => 'Oppo Find X2 is the best phone in the world',
            'image' => 'Oppo Find X2.jpg',
            'year' => 2020,
            'UserID' => 4,
        ]);
        Product::create([
            'name' => 'Redmi Note 10 5G',
            'price' => 12300000,
            'description' => 'Redmi Note 10 5G is the best phone in the world',
            'image' => 'Redmi Note 10 5G.jpg',
            'year' => 2022,
            'UserID' => 5,
        ]);
        Product::create([
            'name' => 'Samsung Galaxy Note 10',
            'price' => 7200000,
            'description' => 'Samsung Galaxy Note 10 is the best phone in the world',
            'image' => 'Samsung Galaxy Note 10.jpg',
            'year' => 2022,
            'UserID' => 6,
        ]);
        Product::create([
            'name' => 'Samsung Galaxy S22 Ultra 5G',
            'price' => 18900000,
            'description' => 'Samsung Galaxy S22 Ultra 5G is the best phone in the world',
            'image' => 'Samsung Galaxy S22 Ultra 5G.jpg',
            'year' => 2022,
            'UserID' => 7,
        ]);
        Product::create([
            'name' => 'Samsung M52 5G',
            'price' => 4355000,
            'description' => 'Samsung M52 5G is the best phone in the world',
            'image' => 'Samsung M52 5G.jpg',
            'year' => 2022,
            'UserID' => 8,
        ]);
    }
}
