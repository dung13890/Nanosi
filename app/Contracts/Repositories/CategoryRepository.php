<?php

namespace App\Contracts\Repositories;

use App\Contracts\Traits\ValidatableInterface;

interface CategoryRepository extends ValidatableInterface
{
    public function getDataByType($type, $columns = ['*']);

    public function getRootByType($type, $columns = ['*']);
}
