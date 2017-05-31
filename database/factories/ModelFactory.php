<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Eloquent\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'username' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = str_random(10),
        'remember_token' => str_random(10),
        'locked' => rand(0,1),
    ];
});

$factory->define(App\Eloquent\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(4, false),
        'type' => $faker->randomElement(config('settings.category_type')),
        'description' => $faker->text,
        'image' => '2017/06/backend/1/category/no_image.jpg',
        'locked' => rand(0, 1),
    ];
});

$factory->define(App\Eloquent\Post::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(5, false),
        'description' => $faker->text,
        'content' => $faker->paragraph(15, true),
        'user_id' => 1,
        'featured' => rand(0, 1),
        'locked' => rand(0, 1),
        'image' => '2017/06/backend/1/post/no_image.jpg',
    ];
});

$factory->define(App\Eloquent\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(5, false),
        'code' => $faker->ean8,
        'size' => $faker->name,
        'material' => $faker->name,
        'origin' => $faker->company,
        'price' => $faker->randomNumber(6),
        'description' => $faker->text,
        'properties' => $faker->text,
        'guide' => $faker->text,
        'content' => $faker->paragraph(15, true),
        'user_id' => 1,
        'featured' => rand(0, 1),
        'locked' => rand(0, 1),
        'image' => '2017/06/backend/1/product/no_image.jpg',
    ];
});

$factory->define(App\Eloquent\Page::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(5, false),
        'description' => $faker->text,
        'content' => $faker->paragraph(15, true),
        'locked' => rand(0, 1),
    ];
});
