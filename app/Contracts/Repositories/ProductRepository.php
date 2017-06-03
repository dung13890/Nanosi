<?php

namespace App\Contracts\Repositories;

use App\Contracts\Traits\ValidatableInterface;

interface ProductRepository extends ValidatableInterface
{
    public function getData($columns = ['*']);
}
