<?php

namespace App\Jobs\Slide;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Contracts\Repositories\SlideRepository;
use App\Traits\Jobs\UploadableTrait;

class StoreJob
{
    use Dispatchable, Queueable, UploadableTrait;

    protected $attributes;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SlideRepository $repository)
    {
        $path = strtolower(class_basename($repository->model()));
        $data = array_only($this->attributes, $repository->getFillable());

        if (array_has($data, 'image')) {
            $data['image'] = $this->uploadFile($data['image'], $path);
        }

        $page = $repository->create($data);
    }
}
