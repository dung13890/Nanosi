<?php

namespace App\Repositories;

use App\Contracts\Repositories\SlideRepository;
use App\Traits\ValidatableTrait;
use App\Eloquent\Slide;

class SlideRepositoryEloquent extends AbstractRepositoryEloquent implements SlideRepository
{
    use ValidatableTrait;

    protected $rules = [
        'store' => [
            'name' => "required|min:2|max:50",
            'image'=> 'required|image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            'introduce' => "required",
            'locked' => 'boolean',
        ],
        'update' => [
            'name' => "required|min:2|max:50",
            'image'=> 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            'introduce' => "required",
            'locked' => 'boolean',
        ],
    ];
    
    public function model()
    {
        return new Slide;
    }

    public function getData($columns = ['*'])
    {
        return $this->model()->get($columns);
    }
}
