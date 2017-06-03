<?php

use Illuminate\Http\Request;
use App\Contracts\Services\MediaInterface;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('image/{path}', ['as' => 'image' , function (Request $request, MediaInterface $service, $path) {
    $params = $request->all();

    return $service->getReponseImage($path, $params);
}])->where('path', '(.*?)');

Route::group(['prefix' => '/', 'namespace' => 'Frontend'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('category/{slug}', 'CategoryController@show')->name('category.show');
    Route::get('page/{slug}', 'PageController@show')->name('page.show');
});

Route::group(['namespace' => 'Backend'], function () {
    Auth::routes();
    Route::group(['prefix' => 'backend', 'as' => 'backend.', 'middleware' => ['auth']], function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::post('summernote/image', 'DashboardController@summernoteImage')->name('summernote.image');
        
        Route::resource('user', 'UserController');
        Route::resource('page', 'PageController');
        Route::resource('post', 'PostController');
        Route::resource('product', 'ProductController');
        Route::post('product/image/store', 'ProductController@imageStore')->name('product.image.store');
        Route::resource('category', 'CategoryController', [
            'except' => ['index', 'create', 'show', 'create']
        ]);
        Route::get('category/type/{type}', 'CategoryController@type')->name('category.type');
        Route::resource('menu', 'MenuController', [
            'execpt' => ['create', 'edit', 'show', 'create']
        ]);
        Route::POST('menu/serialize', 'MenuController@serialize')->name('menu.serialize');
    });
});
