<?php

namespace App\Jobs\Category;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Traits\Jobs\UploadableTrait;
use App\Eloquent\Category;

class DeleteJob
{
    use Dispatchable, Queueable, UploadableTrait;

    protected $item;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Category $item)
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
        if ($this->item->id == 1 || $this->item->id == 2 || $this->item->children->count()) {
            return false;
        }
        if (!empty($this->item->image)) {
            $this->destroyFile($this->item->image);
        }

        $this->item->delete();

        return true;
    }
}
