<?php

namespace App\Traits;

trait GetImageTrait
{
    public function getImageDefaultAttribute($value)
    {
        return app()['glide.builder']->getUrl($this->image);
    }

    public function getImageThumbnailAttribute($value)
    {
        return app()['glide.builder']->getUrl($this->image, ['p' => 'thumbnail']);
    }

    public function getImageSmallAttribute($value)
    {
        return app()['glide.builder']->getUrl($this->image, ['p' => 'small']);
    }

    public function getImageMediumAttribute($value)
    {
        return app()['glide.builder']->getUrl($this->image, ['p' => 'medium']);
    }

    public function getImageLargeAttribute($value)
    {
        return app()['glide.builder']->getUrl($this->image, ['p' => 'large']);
    }
}
