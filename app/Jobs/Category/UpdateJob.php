<?php

namespace App\Jobs\Category;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Eloquent\Category;
use App\Traits\Jobs\UploadableTrait;

class UpdateJob
{
    use Dispatchable, Queueable, UploadableTrait;

    protected $item;

    protected $attributes;

    public function __construct(Category $item, array $attributes)
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

        if ($this->item->id == 1 || $this->item->id == 2) {
            $data['parent_id'] = 0;
        }

        $this->item->update($data);
    }
}
