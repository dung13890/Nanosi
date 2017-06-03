<?php

namespace App\Jobs\Menu;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Contracts\Repositories\MenuRepository;

class SerializeJob
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
    public function handle(MenuRepository $repository)
    {
        $this->recursive($repository, json_decode($this->attributes['serialize']));
    }

    public function recursive(MenuRepository $repository, array $data, $parent = 0, $order = 0)
    {
        foreach ($data as $value) {
            $order++;
            if (isset($value->children)) {
                $this->recursive($repository, $value->children, $value->id, $orderChildren = 0);
            }
            $repository->findOrFail($value->id)->update([
                'sort' => $order,
                'parent_id' => $parent
            ]);
        }
    }
}
