<?php

namespace App\Contracts\Repositories;

use App\Contracts\Traits\ValidatableInterface;

interface PageRepository extends ValidatableInterface
{
    public function getData($columns = ['*']);
}
