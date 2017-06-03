<?php

namespace App\Jobs\Menu;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Eloquent\Menu;

class UpdateJob
{
    use Dispatchable, Queueable;

    protected $attributes;

    protected $item;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Menu $item, array $attributes)
    {
        $this->attributes = $attributes;
        $this->item = $item;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = array_only($this->attributes, $this->item->getFillable());

        $this->item->update($data);
    }
}
