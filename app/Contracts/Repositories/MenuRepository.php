<?php

namespace App\Contracts\Repositories;

use App\Contracts\Traits\ValidatableInterface;

interface MenuRepository extends ValidatableInterface
{
    public function getByRoot($columns = ['*']);
}
