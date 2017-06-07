<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\SlideRepository;
use Illuminate\Http\Request;
use App\Jobs\Slide\StoreJob;
use App\Jobs\Slide\UpdateJob;
use App\Jobs\Slide\DeleteJob;

class SlideController extends BackendController
{
    protected $dataSelect = ['id', 'name', 'introduce', 'image', 'locked'];

    public function __construct(SlideRepository $slide)
    {
        parent::__construct($slide);
    }

    public function index(Request $request)
    {
        parent::index($request);

        if ($request->ajax() && $request->has('datatables')) {
            $params = $request->all();
            $datatables = \Datatables::of($this->repository->datatables($this->dataSelect));
            $this->filterDatatable($datatables, $params);
            $datatables->editColumn('image', function ($item) {
                return $item->image_thumbnail;
            });
                
            return $this->columnDatatable($datatables)->make(true);
        }

        return $this->viewRender();
    }

    public function create()
    {
        parent::create();

        return $this->viewRender();
    }

    public function show($id)
    {
        parent::show($id);

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
