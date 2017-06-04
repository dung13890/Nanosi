<?php

namespace App\Traits\Jobs;

use Auth;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait UploadableTrait
{
    public function uploadableTimestamp()
    {
        return 'Y/m';
    }

    public function uploadFile(UploadedFile $file, $path = 'other', $uploadDisk = 'image')
    {
        $storage = \Storage::disk($uploadDisk);
        $target = $this->getTarget($path);
        $fileName = $this->getFileName($file);
        $destinationTarget = $target . '/' . $fileName;
        $count = 0;
        while ($storage->has($destinationTarget)) {
            $count++;
            $destinationTarget = $target . '/' . $count . '-' . $fileName;
        }
        $saved = $storage->put($destinationTarget, file_get_contents($file));
        if (!$saved) {
            return false;
        }

        return $destinationTarget;

    }

    public function destroyFile($destinationTarget, $uploadDisk = 'image')
    {
        $storage = \Storage::disk($uploadDisk);
        if ($storage->has($destinationTarget)) {
            return $storage->delete($destinationTarget);
        } else {
            return;
        }
    }

    public function getTarget($path)
    {
        if (!property_exists($this, 'ableAuthGuard') || !$this->ableAuthGuard) {
            $this->ableAuthGuard = 'backend';
        }
        if ($user = Auth::guard($this->ableAuthGuard)->user()) {
            $path = $this->ableAuthGuard.'/'.$user->id.'/'.$path;
        }
        if (method_exists($this, 'uploadableTimestamp') && is_string($this->uploadableTimestamp())) {
            $path = Carbon::now()->format($this->uploadableTimestamp()).'/'.$path;
        }

        return $path;
    }

    public function getFileName(UploadedFile $file)
    {
        $fileName = $file->getClientOriginalName();
        $name = str_slug(pathinfo($fileName, PATHINFO_FILENAME));
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);

        return $name . '.' . $ext;
    }
}
