<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\PageRepository;
use App\Contracts\Repositories\CategoryRepository;
use App\Contracts\Repositories\MenuRepository;
use App\Jobs\Menu\StoreJob;
use App\Jobs\Menu\UpdateJob;
use App\Jobs\Menu\SerializeJob;
use App\Jobs\Menu\DeleteJob;
use Illuminate\Http\Request;

class MenuController extends BackendController
{
    protected $dataSelect = ['id', 'name', 'parent_id', 'sort', 'url'];

    protected $categorySelect = ['id', 'name', 'type'];

    protected $pageSelect = ['id', 'name'];

    protected $pageRepository;

    protected $categoryRepository;

    public function __construct(MenuRepository $menu, CategoryRepository $category, PageRepository $page)
    {
        parent::__construct($menu);
        $this->categoryRepository = $category;
        $this->pageRepository = $page;
    }

    public function index(Request $request)
    {
        parent::index($request);
        $relate = $this->categoryRepository->getDataByType(null, $this->categorySelect);
        $this->compacts['categoryProduct'] = $relate->filter(function ($value) {
            return $value->type == 'product';
        })->pluck('name', 'id');
        $this->compacts['categoryPost'] = $relate->filter(function ($value) {
            return $value->type == 'post';
        })->pluck('name', 'id');
        $this->compacts['pages'] = $this->pageRepository->getData($this->pageSelect)->pluck('name', 'id');
        $this->compacts['items'] = $this->repository->getByRoot($this->dataSelect);

        return $this->viewRender();
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->repository->validation('store'));
        $data = $request->only('value', 'type');
        try {
            $this->e['message'] = __("repositories.successfully");
            $this->dispatch(new StoreJob($data));
            $result = $this->repository->getByRoot($this->dataSelect);
        } catch (\Exception $e) {
            $this->e['code'] = 100;
            $this->e['message'] = __("repositories.unsuccessfully");
            return response()->json($this->e, 402);
        }

        return [
            'status' => $this->e,
            'result' => $result
        ];
    }

    public function serialize(Request $request)
    {
        $data = $request->only('serialize');
        try {
            $this->e['message'] = __("repositories.successfully");
            $this->dispatch(new SerializeJob($data));
            $result = $this->repository->getByRoot($this->dataSelect);
        } catch (\Exception $e) {
            $this->e['code'] = 100;
            $this->e['message'] = __("repositories.unsuccessfully");
            return response()->json($this->e, 402);
        }

        return [
            'status' => $this->e,
            'result' => $result
        ];
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
            $status = $this->dispatch(new DeleteJob($item));
            if (!$this->dispatch(new DeleteJob($item))) {
                $this->e['code'] = 100;
                $this->e['message'] = __("repositories.permissions");
            }
        });
    }
}
