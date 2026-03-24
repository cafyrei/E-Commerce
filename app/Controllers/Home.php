<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\UserModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('index');
    }

    public function home2(): string
    {
        return view('home2');
    }

    public function about(): string
    {
        return view('about');
    }

    public function contact(): string
    {
        return view('contact');
    }

    public function adminSignin(): string
    {
        return view('admin_signin'); // admin
    }

    public function productDetails($id): string
    {
         $model = new ProductModel();

        $product = $model->find($id);

        // dd($product['productName']);

        return view("product-details", ['product' => $product]);
    }

    public function productCatalog(): string
    {
        return view('catalog');
    }

    public function checkout(): string
    {
        return view('checkout');
    }
}
