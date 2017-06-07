<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\ConfigRepository;
use Illuminate\Http\Request;

class ConfigController extends BackendController
{
    protected $dataSelect = ['key', 'value'];

    public function __construct(ConfigRepository $config)
    {
        parent::__construct($config);
    }

    public function index(Request $request)
    {
        parent::index($request);
        $this->compacts['item'] = $this->repository->getData($this->dataSelect);
        $this->view = $this->repositoryName . '.create';

        return $this->viewRender();
    }
}
