<?php

namespace App\Jobs\Product;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Traits\Jobs\UploadableTrait;
use App\Eloquent\Image;
use Illuminate\Support\Str;

class ImageStoreJob
{
    use Dispatchable, Queueable, UploadableTrait;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = strtolower(class_basename(app(Image::class)));
        $this->attributes['name'] = Str::ascii($this->attributes['src']->getClientOriginalName());
        $this->attributes['size'] = $this->attributes['src']->getSize();
        $this->attributes['type'] = $this->attributes['src']->getMimeType();
        $this->attributes['src'] = $this->uploadFile($this->attributes['src'], $path);

        return app(Image::class)->create($this->attributes);
    }
}
