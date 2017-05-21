<?php

namespace App\Contracts\Repositories;

use App\Eloquent\User;
use App\Contracts\Traits\ValidatableInterface;

interface UserRepository extends ValidatableInterface
{
    public function getData($params = [], $columns = ['*']);

    public function random($columns = ['*']);
}
