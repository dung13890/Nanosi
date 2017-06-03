<?php

namespace App\Jobs\Menu;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Contracts\Repositories\MenuRepository;
use App\Contracts\Repositories\AbstractRepository;
use App\Contracts\Repositories\CategoryRepository;
use App\Contracts\Repositories\PageRepository;

class StoreJob
{
    use Dispatchable, Queueable;

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
    public function handle(MenuRepository $repository, PageRepository $pageRepository, CategoryRepository $categoryRepository)
    {
        switch ($this->attributes['type']) {
            case 'link':
                $params = array_only($this->attributes['value'][0], $repository->getFillable());
                $repository->create($params);
                break;
            case 'page':
                $this->type($pageRepository, $this->attributes['value']);
                break;
            case 'post':
            case 'product':
                $this->type($categoryRepository, $this->attributes['value']);
                break;
        }
    }

    public function type($repository, array $data)
    {
        $params = [];
        foreach ($data as $value) {
            $type = $repository->findOrFail($value['id']);
            $typeName = strtolower(class_basename($type));
            $params[] = [
                'name' => $value['name'],
                'url' => parse_url(route("{$typeName}.show", $type->slug), PHP_URL_PATH),
                'menuable_id' => $type->id,
                'menuable_type' => get_class($type),
            ];
        }

        app(MenuRepository::class)->insert($params);
    }
}
