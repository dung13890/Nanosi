<?php

namespace App\Eloquent;

use App\Traits\GetImageTrait;

class Post extends Abstracts\Sluggable
{
    use GetImageTrait;
    
    protected $fillable = [
        'name', 'image', 'content', 'description', 'featured', 'locked', 'user_id'
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

    public function scopeByKeyword($query, $keyword)
    {
        return $query->where('name', 'LIKE', "{$keyword}%")
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
