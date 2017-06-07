<?php

namespace App\Jobs\Slide;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Traits\Jobs\UploadableTrait;
use App\Eloquent\Slide;

class UpdateJob
{
    use Dispatchable, Queueable, UploadableTrait;

    protected $item;

    protected $attributes;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Slide $item, array $attributes)
    {
        $this->item = $item;
        $this->attributes = $attributes;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = strtolower(class_basename($this->item->getModel()));
        $data = array_only($this->attributes, $this->item->getFillable());
        $data['locked'] = $data['locked'] ?? false;

        if (array_has($data, 'image')) {
            if (!empty($this->item->image)) {
                $this->destroyFile($this->item->image);
            }
            $data['image'] = $this->uploadFile($data['image'], $path);
        }

        $this->item->update($data);
    }
}
