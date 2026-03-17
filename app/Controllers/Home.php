<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('index');
    }
    
    public function login(): string
    {
        return view('pages/login');
    }

    public function signup(): string
    {
        return view('pages/signup');
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

    public function signin(): string
   {
    return view('signin'); // client
   }

    public function adminSignin(): string
   {
    return view('admin_signin'); // admin
   }

    public function productDetails(): string
   {
        return view("product-details");
   }
}
