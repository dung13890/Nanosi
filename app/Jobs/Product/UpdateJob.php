<?php

namespace App\Jobs\Product;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Traits\Jobs\UploadableTrait;
use App\Eloquent\Product;
use App\Eloquent\Image;

class UpdateJob
{
    use Dispatchable, Queueable, UploadableTrait;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $item;

    protected $attributes;

    public function __construct(Product $item, array $attributes)
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
        $data['featured'] = $data['featured'] ?? false;
        if (array_has($data, 'image')) {
            if (!empty($this->item->image)) {
                $this->destroyFile($this->item->image);
            }
            $data['image'] = $this->uploadFile($data['image'], $path);
        }

        $this->item->update($data);

        if (isset($this->attributes['category_ids'])) {
            $this->item->categories()->sync($this->attributes['category_ids']);
        }

        if ($this->attributes['image_ids'] != $this->item->images->pluck('id')->toArray()) {
            $this->item->images()->whereNotIn('id', $this->attributes['image_ids'])->delete();
            $this->item->images()->saveMany(app(Image::class)->find($this->attributes['image_ids']));
        }

        $this->item->seo()->update([
            'title' => $this->attributes['seo_title'] ?: $data['name'],
            'description' => $this->attributes['seo_description'] ?: $data['description'],
            'keywords' => $this->attributes['seo_keywords'] ?: null,
        ]);
    }
}
