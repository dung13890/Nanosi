<?php

namespace App\Jobs\User;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Eloquent\User;

class DeleteJob
{
    use Dispatchable, Queueable;

    protected $item;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $item)
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
        $this->item->delete();
    }
}
