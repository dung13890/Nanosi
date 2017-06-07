<?php

namespace App\Repositories;

use App\Contracts\Repositories\ConfigRepository;
use App\Traits\ValidatableTrait;
use App\Eloquent\Config;

class ConfigRepositoryEloquent extends AbstractRepositoryEloquent implements ConfigRepository
{
    use ValidatableTrait;

    protected $rules = [
        'store' => [
            'name' => 'required|min:4|max:255',
            'keywords' => 'required|min:4|max:255',
            'description' => 'required|min:4|max:255',
            'email' => 'required|email|min:4|max:255',
            'phone' => 'required|min:4|max:255',
            'address' => 'required|min:4|max:255',
            'logo'=> 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
        ],
    ];
    
    public function model()
    {
        return new Config;
    }

    public function getData($columns = ['*'])
    {
        return $this->model()->get($columns);
    }
}
