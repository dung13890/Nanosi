<?php

namespace App\Jobs\Page;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Contracts\Repositories\PageRepository;
use App\Traits\Jobs\UploadableTrait;

class StoreJob
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
    public function handle(PageRepository $repository)
    {
        $path = strtolower(class_basename($repository->model()));
        $data = array_only($this->attributes, $repository->getFillable());

        if (array_has($data, 'image')) {
            $data['image'] = $this->uploadFile($data['image'], $path);
        }

        $page = $repository->create($data);

        $page->seo()->create([
            'title' => $this->attributes['seo_title'] ?: $data['name'],
            'description' => $this->attributes['seo_description'] ?: $data['description'],
            'keywords' => $this->attributes['seo_keywords'] ?: null
        ]);
    }
}
