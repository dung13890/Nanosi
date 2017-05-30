<?php

namespace App\Eloquent;

use App\Traits\GetImageTrait;

class Page extends Abstracts\Sluggable
{
    use GetImageTrait;

    protected $fillable = [
        'name', 'slug', 'description', 'content', 'image', 'locked'
    ];

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    public function scopeByKeyword($query, $keyword)
    {
        return $query->where('name', 'LIKE', "{$keyword}%")
            ->orWhere('description', 'LIKE', "{$keyword}%")
            ->orWhere('content', 'LIKE', "{$keyword}%");
    }
}
