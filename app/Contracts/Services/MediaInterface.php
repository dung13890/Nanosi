<?php

namespace App\Contracts\Services;

interface MediaInterface
{
    public function getReponseImage($path, $params);

    public function summernote(array $attributes);
}
