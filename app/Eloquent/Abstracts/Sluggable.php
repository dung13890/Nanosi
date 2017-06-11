<?php

namespace App\Eloquent\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable as SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

abstract class Sluggable extends Model
{
    use SluggableTrait, SluggableScopeHelpers;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
