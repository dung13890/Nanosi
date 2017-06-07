<?php

namespace App\Contracts\Repositories;

use App\Contracts\Traits\ValidatableInterface;

interface SlideRepository extends ValidatableInterface
{
    public function getData($columns = ['*']);
}
