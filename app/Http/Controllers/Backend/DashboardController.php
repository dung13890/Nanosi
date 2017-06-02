<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Contracts\Services\MediaInterface;

class DashboardController extends BackendController
{
    public function index(Request $request)
    {
        $this->view = 'dashboard.index';
        $this->compacts['heading'] = __('repositories.dashboard');

        return $this->viewRender();
    }

    public function summernoteImage(Request $request, MediaInterface $service)
    {
        $path = $service->summernote($request->all());

        return [
            'url' => route('image', app()['glide.builder']->getUrl($path))
        ];
    }
}
