<?php

namespace App\Repositories;

use App\Contracts\Repositories\PageRepository;
use App\Traits\ValidatableTrait;
use App\Eloquent\Page;

class PageRepositoryEloquent extends AbstractRepositoryEloquent implements PageRepository
{
    use ValidatableTrait;

    protected $rules = [
        'store' => [
            'name' => "required|min:4|max:255",
            'image'=> 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            'locked' => 'boolean',
            'seo_title' => "min:2|max:60",
            'seo_description' => "min:2|max:200"
        ],
        'update' => [
            'name' => "required|min:4|max:255",
            'image'=> 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            'locked' => 'boolean',
            'seo_title' => "min:2|max:60",
            'seo_description' => "min:2|max:200"
        ],
    ];
    
    public function model()
    {
        return new Page;
    }

    public function getData($params = [], $columns = ['*'])
    {
        return $this->model()->all($columns);
    }
}
