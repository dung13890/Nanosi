<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Services\MediaInterface;

class DashboardController extends Controller
{
    public function index()
    {
        $this->view = 'dashboard.index';
        $this->compacts['heading'] = $this->trans('dashboard');

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
