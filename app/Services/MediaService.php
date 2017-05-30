<?php

namespace App\Services;

use App\Contracts\Services\MediaInterface;
use League\Glide\Signatures\SignatureException;
use League\Glide\Signatures\SignatureFactory;
use App\Jobs\Media\Summernote;
use Illuminate\Foundation\Bus\DispatchesJobs;

class MediaService implements MediaInterface
{
    use DispatchesJobs;
    
    public function getReponseImage($path, $params)
    {
        $server = app()['glide'];
        try {
            SignatureFactory::create(env('GLIDE_SIGNKEY'))->validateRequest($path, $params);
            
            return $server->getImageResponse($path, $params);
        } catch (SignatureException $e) {
            \Log::error($e);

            return redirect(asset('assets/images/no_image.jpg'));
        }
    }

    public function summernote(array $attributes)
    {
        return $this->dispatch(new Summernote($attributes));
    }
}
