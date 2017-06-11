<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Repositories\CategoryRepository;

class CategoryController extends FrontendController
{
    protected $dataProduct = ['id', 'slug','name', 'image', 'price'];

    public function __construct(CategoryRepository $category)
    {
        parent::__construct($category);
    }

    public function show($slug)
    {
        $this->compacts['item'] = $this->repository->findBySlug($slug);
        $this->compacts['heading'] = $this->compacts['item']->name;
        $this->compacts['description'] = str_limit($this->compacts['item']->description, 156);

        $this->compacts['products'] = $this->compacts['item']->products()->paginate(12, $this->dataProduct);

        $this->view = 'shop.category';

        return $this->viewRender();
    }
}
