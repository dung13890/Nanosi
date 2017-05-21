<?php

namespace App\Jobs\User;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Contracts\Repositories\UserRepository;

class StoreJob
{
    use Dispatchable, Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UserRepository $repository)
    {
        $data = array_only($this->attributes, $repository->getFillable());
        if (isset($this->attributes['password'])) {
            $data['password'] = $this->attributes['password'];
        }
        
        $item = $repository->create($data);
    }
}
