<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\PageRepository;
use Illuminate\Http\Request;
use App\Jobs\Page\StoreJob;
use App\Jobs\Page\UpdateJob;
use App\Jobs\Page\DeleteJob;

class PageController extends BackendController
{
    protected $dataSelect = ['id', 'name', 'description', 'locked'];

    public function __construct(PageRepository $page)
    {
        parent::__construct($page);
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

    public function show($id)
    {
        parent::show($id);

        return $this->viewRender();
    }

    public function edit($id)
    {
        parent::edit($id);
        $this->compacts['seo'] = $this->compacts['item']->seo;

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
