<?php

namespace App\Jobs\Media;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Traits\Jobs\UploadableTrait;

class Summernote
{
    use Dispatchable, Queueable, UploadableTrait;

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
        $path = 'summernote';
        if (isset($this->attributes['image'])) {
            return $this->uploadFile($this->attributes['image'], $path);
        }
    }
}
