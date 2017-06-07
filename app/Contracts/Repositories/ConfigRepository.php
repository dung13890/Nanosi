<?php

namespace App\Contracts\Repositories;

use App\Contracts\Traits\ValidatableInterface;

interface ConfigRepository extends ValidatableInterface
{
    public function getData($columns = ['*']);
}
