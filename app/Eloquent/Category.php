<?php

namespace App\Eloquent;

class Category extends Abstracts\Sluggable
{
    protected $fillable = [
        'name', 'parent_id', 'type', 'description', 'locked', 'image'
    ];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class)->orderBy('id', 'DESC');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->orderBy('id','DESC');
    }
}
