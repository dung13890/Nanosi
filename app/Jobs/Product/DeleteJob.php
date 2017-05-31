<?php

namespace App\Jobs\Product;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Traits\Jobs\UploadableTrait;
use App\Eloquent\Product;

class DeleteJob
{
    use Dispatchable, Queueable, UploadableTrait;

    protected $item;
    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct(Product $item)
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
        $this->item->images()->delete();
        $this->item->delete();
    }
}
