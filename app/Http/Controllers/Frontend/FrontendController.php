<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\AbstractController;

abstract class FrontendController extends AbstractController
{
    protected $prefix = 'frontend.';

    public function viewRender($view = null)
    {
        $view = $view ?: $this->view;

        return view($this->prefix . $view, $this->compacts);
    }
}
