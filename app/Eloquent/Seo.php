<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $fillable = [
        'title', 'description', 'keywords'
    ];

    public function seoable()
    {
        return $this->morphTo();
    }
}
