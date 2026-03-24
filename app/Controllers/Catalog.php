<?php

namespace App\Controllers;

use App\Models\CatalogModel as CatalogModel;

class Catalog extends BaseController
{
    public function index()
    {
        helper('form');
        $model = new CatalogModel();

        $searchTerm = $this->request->getVar('search');
        $selectedCats = $this->request->getVar('category');
        $minPrice = $this->request->getVar('min_price');
        $maxPrice = $this->request->getVar('max_price');

        if ($searchTerm) {
            $model->like('productName', $searchTerm);
        }

        if (!empty($selectedCats)) {
            $model->whereIn('productCategory', $selectedCats);
        }

        if ($minPrice) {
            $model->where('productPrice >=', $minPrice);
        }

        if ($maxPrice) {
            $model->where('productPrice <=', $maxPrice);
        }

        $data = [
            'products'    => $model->findAll(),
            'categories'  => ["Bedroom", "Living Room", "Dining Room", "Home Office", "Kitchen"],
            'types'       => ["Chairs", "Beds", "Shelving", "Desks", "Wardrobes"],
            'active_tags' => (array)$selectedCats 
        ];

        return view('catalog', $data);
    }
}
