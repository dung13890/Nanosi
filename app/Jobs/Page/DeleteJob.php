<?php

namespace App\Jobs\Page;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Traits\Jobs\UploadableTrait;
use App\Eloquent\Page;

class DeleteJob
{
    use Dispatchable, Queueable, UploadableTrait;

    protected $item;

    public function __construct(Page $item)
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
        if (!empty($this->item->image)) {
            $this->destroyFile($this->item->image);
        }
        
        $this->item->seo()->delete();

        $this->item->delete();
    }
}
