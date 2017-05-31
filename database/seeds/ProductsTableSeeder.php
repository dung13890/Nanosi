<?php

use Illuminate\Database\Seeder;
use App\Eloquent\Product;
use App\Eloquent\Category;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = app(Category::class)->where('type', 'product');
        factory(Product::class, 20)->create()->each(function($product) use ($categories) {
            $product->categories()->attach($categories->pluck('id')->random(4)->all());
        });
    }
}
