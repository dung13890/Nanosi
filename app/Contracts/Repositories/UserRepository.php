<?php

namespace App\Contracts\Repositories;

use App\Contracts\Traits\ValidatableInterface;

interface UserRepository extends ValidatableInterface
{
    public function getData($columns = ['*']);

    public function random($columns = ['*']);
}
