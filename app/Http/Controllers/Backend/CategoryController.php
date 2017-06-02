<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Jobs\Category\StoreJob;
use App\Jobs\Category\UpdateJob;
use App\Jobs\Category\DeleteJob;

class CategoryController extends BackendController
{
    protected $dataSelect = ['id', 'name', 'type', 'parent_id', 'image', 'locked'];
    
    protected function indexRender($type, $action = 'create')
    {
        if (!in_array($type, config('settings.category_type'))) {
            abort(403);
        }
        $this->view = $this->repositoryName . '.index';
        $this->compacts['heading'] = __('repositories.category') . ' ' . __('repositories.' . $type);
        $this->compacts['action'] = ucfirst(__('repositories.' . $action));
        $this->compacts['items'] = $this->repository->getRootByType($type, $this->dataSelect);
        $this->compacts['listItems'] = (!isset($this->compacts['item'])) ? 
            $this->compacts['items']->pluck('name', 'id')->prepend('Root', 0) :
            $this->compacts['items']->pluck('name', 'id')->forget($this->compacts['item']->id)->prepend('Root', 0);

        return $this->viewRender();
    }

    public function __construct(CategoryRepository $category)
    {
        parent::__construct($category);
    }

    public function type($type)
    {
        $this->compacts['type'] = $type;
        $this->compacts['resource'] = $this->repositoryName;

        return $this->indexRender($type);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->repository->validation('store'));
        $data = $request->all();

        return $this->doRequest(function () use ($data) {
            return $this->dispatch(new StoreJob($data));
        }, url()->previous());
    }

    public function edit($id)
    {
        parent::edit($id);

        return $this->indexRender($this->compacts['item']->type, 'edit');
    }

    public function update(Request $request, $id)
    {
        $item = $this->repository->findOrFail($id);
        $this->validate($request, $this->repository->validation('update', $item));
        $data = $request->all();

        return $this->doRequest(function () use ($item, $data) {
            return $this->dispatch(new UpdateJob($item, $data));
        }, route($this->prefix . 'category.type', $item->type));
    }

    public function destroy($id)
    {
        $item = $this->repository->findOrFail($id);

        return $this->doRequest(function () use ($item) {
            $status = $this->dispatch(new DeleteJob($item));
            if (!$this->dispatch(new DeleteJob($item))) {
                $this->e['code'] = 100;
                $this->e['message'] = __("repositories.permissions");
            }
        });
    }
}
