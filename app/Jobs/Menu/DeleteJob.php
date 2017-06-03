<?php

namespace App\Jobs\Menu;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Eloquent\Menu;

class DeleteJob
{
    use Dispatchable, Queueable;

    protected $item;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Menu $item)
    {
        $this->item = $item;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->item->children->count()) {
            return false;
        }

        $this->item->delete();

        return true;
    }
}
