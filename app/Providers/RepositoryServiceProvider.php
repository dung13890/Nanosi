<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected static $repositories = [
        'user' => [
            \App\Contracts\Repositories\UserRepository::class,
            \App\Repositories\UserRepositoryEloquent::class,
        ],

        'page' => [
            \App\Contracts\Repositories\PageRepository::class,
            \App\Repositories\PageRepositoryEloquent::class,
        ],

        'post' => [
            \App\Contracts\Repositories\PostRepository::class,
            \App\Repositories\PostRepositoryEloquent::class,
        ],

        'category' => [
            \App\Contracts\Repositories\CategoryRepository::class,
            \App\Repositories\CategoryRepositoryEloquent::class,
        ],
    ];
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        foreach (static::$repositories as $repository) {
            $this->app->singleton(
                $repository[0],
                $repository[1]
            );
        }
    }
}
