<?php

namespace App\Repositories;

use App\Contracts\Repositories\PostRepository;
use App\Traits\ValidatableTrait;
use App\Eloquent\Post;

class PostRepositoryEloquent extends AbstractRepositoryEloquent implements PostRepository
{
    use ValidatableTrait;

    protected $rules = [
        'store' => [
            'name' => "required|min:4|max:150",
            'image'=> 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            'category_ids' => "required",
            'featured' => 'boolean',
            'locked' => 'boolean',
            'seo_title' => "min:2|max:60",
            'seo_description' => "min:2|max:200"
        ],
        'update' => [
            'name' => "required|min:4|max:150",
            'image'=> 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            'locked' => 'boolean',
            'featured' => 'boolean',
            'category_ids' => "required",
            'seo_title' => "min:2|max:60",
            'seo_description' => "min:2|max:200"
        ],
    ];
    
    public function model()
    {
        return new Post;
    }

    public function getData($columns = ['*'])
    {
        return $this->model()->where('locked', true)->get($columns);
    }
}
