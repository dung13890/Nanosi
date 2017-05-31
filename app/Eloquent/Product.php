<?php

namespace App\Eloquent;

use App\Traits\GetImageTrait;

class Product extends Abstracts\Sluggable
{
    use GetImageTrait;

    protected $fillable = [
        'name',
        'code',
        'slug',
        'size',
        'material',
        'origin',
        'price',
        'image',
        'content',
        'description',
        'properties',
        'guide',
        'featured',
        'locked',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function scopeByKeyword($query, $keyword)
    {
        return $query->where('name', 'LIKE', "{$keyword}%")
            ->orWhere('code', 'LIKE', "{$keyword}%")
            ->orWhere('material', 'LIKE', "{$keyword}%")
            ->orWhere('origin', 'LIKE', "{$keyword}%")
            ->orWhere('properties', 'LIKE', "{$keyword}%")
            ->orWhere('guide', 'LIKE', "{$keyword}%")
            ->orWhere('description', 'LIKE', "{$keyword}%")
            ->orWhere('content', 'LIKE', "{$keyword}%");
    }

    public function scopeByCategory($query, $category)
    {
        return $query->whereHas('categories', function ($query) use ($category) {
            return $query->where('id', $category);
        });
    }
}
