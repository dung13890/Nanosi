<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetImageTrait;

class Slide extends Model
{
    use GetImageTrait;

    protected $fillable = [
        'name', 'introduce', 'image', 'url', 'locked'
    ];

    public function scopeByKeyword($query, $keyword)
    {
        return $query->where('name', 'LIKE', "{$keyword}%")
            ->orWhere('url', 'LIKE', "{$keyword}%")
            ->orWhere('introduce', 'LIKE', "{$keyword}%");
    }
}
