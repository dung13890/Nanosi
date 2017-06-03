<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\ProductRepository;
use App\Contracts\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Jobs\Product\StoreJob;
use App\Jobs\Product\UpdateJob;
use App\Jobs\Product\DeleteJob;
use App\Jobs\Media\ImageStoreJob;

class ProductController extends BackendController
{
    protected $dataSelect = ['id', 'name', 'code', 'price', 'image', 'featured', 'locked'];

    protected $categorySelect = ['id', 'name', 'parent_id'];

    protected $categoryRepository;
    
    public function __construct(ProductRepository $product, CategoryRepository $category)
    {
        parent::__construct($product);

        $this->categoryRepository = $category;
    }

    public function index(Request $request)
    {
        parent::index($request);
        $this->compacts['categories'] = $this->categoryRepository->getDataBytype('product', $this->categorySelect)->pluck('name', 'id')->prepend('All', 0);

        if ($request->ajax() && $request->has('datatables')) {
            $params = $request->all();
            $datatables = \Datatables::of($this->repository->datatables($this->dataSelect));
            $this->filterDatatable($datatables, $params, function ($query, $params) {
                if (array_has($params, 'category_id') && $params['category_id']) {
                    $query->byCategory($params['category_id']);
                }
            });

            $datatables->editColumn('price', function ($item) {
                return number_format($item->price);
            })->editColumn('image', function ($item) {
                return $item->image_thumbnail;
            });
                
            return $this->columnDatatable($datatables)->make(true);
        }

        return $this->viewRender();
    }

    public function create()
    {
        parent::create();
        $this->compacts['rootCategories'] = $this->categoryRepository->getRootByType('product', $this->categorySelect);

        return $this->viewRender();
    }

    public function store(Request $request)
    {
        $request->merge(['price' => str_replace(',', '', $request->price)]);
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
        $this->compacts['images'] = $this->compacts['item']->images;
        $this->compacts['rootCategories'] = $this->categoryRepository->getRootByType('product', $this->categorySelect);
        
        return $this->viewRender();
    }

    public function update(Request $request, $id)
    {
        $item = $this->repository->findOrFail($id);
        $request->merge(['price' => str_replace(',', '', $request->price)]);
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

    public function imageStore(Request $request)
    {
        $this->validate($request, $this->repository->validation('imageStore'));
        $data = $request->only('name', 'src', 'size', 'type');

        try {
            $result = $this->dispatch(new ImageStoreJob($data));
        } catch (\Exception $e) {
            return response()->json(__("repositories.unsuccessfully"), 402);
        }

        return $result;
    }
}
