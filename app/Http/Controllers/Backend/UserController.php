<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Jobs\User\StoreJob;
use App\Jobs\User\UpdateJob;
use App\Jobs\User\DeleteJob;

class UserController extends BackendController
{
    protected $dataSelect = ['id', 'name', 'username', 'email', 'locked'];

    public function __construct(UserRepository $user)
    {
        parent::__construct($user);
    }

    public function index(Request $request)
    {
        parent::index($request);

        if ($request->ajax() && $request->has('datatables')) {
            $params = $request->all();
            $datatables = \Datatables::of($this->repository->datatables($this->dataSelect));
            $this->filterDatatable($datatables, $params);
                
            return $this->columnDatatable($datatables)->make(true);
        }

        return $this->viewRender();
    }

    public function create()
    {
        parent::create();

        return $this->viewRender();
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->repository->validation('store'));
        $data = $request->all();

        return $this->doRequest(function () use ($data) {
            return $this->dispatch(new StoreJob($data));
        });
    }

    public function edit($id)
    {
        parent::edit($id);

        return $this->viewRender();
    }

    public function update(Request $request, $id)
    {
        $item = $this->repository->findOrFail($id);

        if (!$request->has('password')) {
            $request->replace($request->except(['password', 'password_confirmation']));
        }

        $this->validate($request, $this->repository->validation('update', $item));
        $data = $request->all();

        return $this->doRequest(function () use ($item, $data) {
            return $this->dispatch(new UpdateJob($item, $data));
        });
    }

    public function destroy($id)
    {
        $item = $this->repository->findOrFail($id);

        return $this->doRequest(function () use ($item) {
            return $this->dispatch(new DeleteJob($item));
        });
    }
}
