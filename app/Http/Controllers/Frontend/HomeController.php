<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Repositories\UserRepository;

class HomeController extends FrontendController
{
    public function __construct(UserRepository $user)
    {
        parent::__construct($user);
    }

    public function index()
    {
        $this->view = 'home.index';
        $this->compacts['heading'] = __('repositores.home');
        $this->compacts['item'] = $this->repository->random();

        return $this->viewRender();
    }
}
