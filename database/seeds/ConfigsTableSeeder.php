<?php

use Illuminate\Database\Seeder;
use App\Eloquent\Config;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app(Config::class)->create([
            'key' => 'name',
            'value' => 'Nanosi',
        ]);
        app(Config::class)->create([
            'key' => 'keywords',
            'value' => 'keywords',
        ]);
        app(Config::class)->create([
            'key' => 'description',
            'value' => 'description',
        ]);
        app(Config::class)->create([
            'key' => 'facebook',
            'value' => 'facebook',
        ]);
        app(Config::class)->create([
            'key' => 'youtube',
            'value' => 'youtube',
        ]);
        app(Config::class)->create([
            'key' => 'email',
            'value' => 'Nangluongnanosi@gmail.com',
        ]);
        app(Config::class)->create([
            'key' => 'phone',
            'value' => '0968706888',
        ]);
        app(Config::class)->create([
            'key' => 'address',
            'value' => 'Golden Palace, Lê Văn Lương',
        ]);
        app(Config::class)->create([
            'key' => 'slogan',
            'value' => 'Nanosi mang tầm cao mới cho ngôi nhà của bạn!',
        ]);
        app(Config::class)->create([
            'key' => 'introduce',
            'value' => 'introduce',
        ]);
        app(Config::class)->create([
            'key' => 'logo',
            'value' => '',
        ]);
    }
}
