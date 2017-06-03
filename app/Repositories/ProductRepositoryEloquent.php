<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProductRepository;
use App\Traits\ValidatableTrait;
use App\Eloquent\Product;

class ProductRepositoryEloquent extends AbstractRepositoryEloquent implements ProductRepository
{
    use ValidatableTrait;

    protected $rules = [
        'store' => [
            'name' => "required|min:4|max:150",
            'code' => "required|alpha_dash|min:2|max:50|unique:products",
            'image'=> 'required|image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            'category_ids' => "required",
            'featured' => 'boolean',
            'locked' => 'boolean',
            'price' => 'integer',
            'seo_title' => "min:2|max:60",
            'seo_description' => "min:2|max:200"
        ],
        'update' => [
            'name' => "required|min:4|max:150",
            'image'=> 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            'code' => "required|alpha_dash|min:2|max:50|unique:users,username,{id}",
            'category_ids' => "required",
            'featured' => 'boolean',
            'locked' => 'boolean',
            'price' => 'integer',
            'seo_title' => "min:2|max:60",
            'seo_description' => "min:2|max:200"
        ],
        'imageStore' => [
            'src'=> 'required|image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
        ],
    ];
    
    public function model()
    {
        return new Product;
    }

    public function getData($columns = ['*'])
    {
        return $this->model()->where('locked', true)->get($columns);
    }
}
