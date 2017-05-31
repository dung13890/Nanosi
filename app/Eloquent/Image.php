<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetImageTrait;

class Image extends Model
{
    use GetImageTrait;

    protected $fillable = [
        'name', 'src', 'size', 'type'
    ];

    protected $appends = ['image_thumbnail'];

    public function getImageAttribute()
    {
        return $this->src;
    }
    
    public function imageable()
    {
        return $this->morphTo();
    }
}
