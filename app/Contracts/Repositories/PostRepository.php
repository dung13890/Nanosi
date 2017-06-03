<?php

namespace App\Contracts\Repositories;

use App\Contracts\Traits\ValidatableInterface;

interface PostRepository extends ValidatableInterface
{
    public function getData($columns = ['*']);
}
