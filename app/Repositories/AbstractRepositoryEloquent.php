<?php

namespace App\Repositories;

abstract class AbstractRepositoryEloquent
{    
    protected $userId;

    abstract public function model();

    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->model(), $method], $parameters);
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    public function datatables($columns = ['*'], $with = [])
    {
        return $this->model()->select($columns)->with($with);
    }
}
