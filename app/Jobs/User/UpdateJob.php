<?php

namespace App\Jobs\User;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Eloquent\User;

class UpdateJob
{
    use Dispatchable, Queueable;

    protected $item;

    protected $attributes;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $item, array $attributes)
    {
        $this->item = $item;
        $this->attributes = $attributes;
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
