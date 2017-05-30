<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\PostRepository;
use App\Contracts\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Jobs\Post\StoreJob;
use App\Jobs\Post\UpdateJob;
use App\Jobs\Post\DeleteJob;

class PostController extends BackendController
{
    protected $dataSelect = ['id', 'name', 'description', 'featured', 'locked'];

    protected $categorySelect = ['id', 'name', 'parent_id'];

    protected $categoryRepository;
    
    public function __construct(PostRepository $post, CategoryRepository $category)
    {
        parent::__construct($post);

        $this->categoryRepository = $category;
    }

    public function index(Request $request)
    {
        parent::index($request);
        $this->compacts['categories'] = $this->categoryRepository->getDataBytype('post', $this->categorySelect)->pluck('name', 'id')->prepend('All', 0);

        if ($request->ajax() && $request->has('datatables')) {
            $params = $request->all();
            $datatables = \Datatables::of($this->repository->datatables($this->dataSelect));
            $this->filterDatatable($datatables, $params, function ($query, $params) {
                if (array_has($params, 'category_id') && $params['category_id']) {
                    $query->byCategory($params['category_id']);
                }
            });
                
            return $this->columnDatatable($datatables)->make(true);
        }

        return $this->viewRender();
    }

    public function create()
    {
        parent::create();
        $this->compacts['rootCategories'] = $this->categoryRepository->getRootByType('post', $this->categorySelect);

        return $this->viewRender();
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->repository->validation('store'));
        $data = $request->all();
        $data['user_id'] = $this->user->id;

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
        $this->compacts['rootCategories'] = $this->categoryRepository->getRootByType('post', $this->categorySelect);
        
        return $this->viewRender();
    }

    public function update(Request $request, $id)
    {
        $item = $this->repository->findOrFail($id);

        $this->validate($request, $this->repository->validation('update', $item));
        $data = $request->all();
        $data['user_id'] = $this->user->id;

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
