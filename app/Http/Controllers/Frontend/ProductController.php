<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Repositories\ProductRepository;
use App\Contracts\Repositories\CategoryRepository;

class ProductController extends FrontendController
{
    protected $dataCategory = ['id', 'slug','name'];
    protected $categoryRepository;

    public function __construct(ProductRepository $product, CategoryRepository $category)
    {
        parent::__construct($product);

        $this->categoryRepository = $category;
    }

    public function show($slug)
    {
        $this->compacts['item'] = $this->repository->findBySlug($slug);

        if ($this->compacts['item']->seo) {
    		$this->compacts['description'] = str_limit($this->compacts['item']->seo->description, 120);
    		$this->compacts['keywords'] = $this->compacts['item']->seo->keywords;
    	}

    	$this->compacts['categories'] = $this->categoryRepository->getRootByType('product',  $this->dataCategory);

    	$this->view = 'shop.product';

    	return $this->viewRender();
    }
}
