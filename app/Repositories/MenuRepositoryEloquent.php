<?php

namespace App\Repositories;

use App\Contracts\Repositories\MenuRepository;
use App\Traits\ValidatableTrait;
use App\Eloquent\Menu;

class MenuRepositoryEloquent extends AbstractRepositoryEloquent implements MenuRepository
{
    use ValidatableTrait;

    protected $rules = [
        'store' => [
            'value.*.name' => 'required|min:2|max:50',
        ],
        'update' => [
            'name' => 'required|min:2|max:50',
        ],
    ];
    
    public function model()
    {
        return new Menu;
    }

    public function getByRoot($columns = ['*'])
    {
        return $this->model()->with(['children' => function ($query) use ($columns) {
            $query->select($columns);
        }])->where('parent_id', 0)->orderBy('sort')->get($columns);
    }
}
