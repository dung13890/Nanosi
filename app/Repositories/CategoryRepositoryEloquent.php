<?php

namespace App\Repositories;

use App\Contracts\Repositories\CategoryRepository;
use App\Traits\ValidatableTrait;
use App\Eloquent\Category;

class CategoryRepositoryEloquent extends AbstractRepositoryEloquent implements CategoryRepository
{
    use ValidatableTrait;

    protected $rules = [
        'store' => [
            'name' => "required|min:2|max:255",
            'locked' => 'sometimes|boolean',
            'banner'=> 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            'type' => "required|in:product,post",
        ],
        'update' => [
            'name' => "required|min:2|max:255",
            'locked' => 'sometimes|boolean',
            'banner'=> 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200', 
        ],
    ];
    
    public function model()
    {
        return new Category;
    }

    public function getDataByType($type, $columns = ['*'])
    {
        return $this->model()->where('type', $type)->get($columns);
    }

    public function getRootByType($type, $columns = ['*'])
    {
        return $this->model()->with(['children' => function ($query) use ($columns) {
            $query->select($columns);
        }])->where('parent_id', 0)->where('type', $type)->get($columns);
    }
}
