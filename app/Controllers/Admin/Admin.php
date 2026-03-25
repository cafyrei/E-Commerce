<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\CatalogModel;
use App\Models\OrderModel;
use App\Models\OrderItemsModel;

class Admin extends BaseController
{
    public function authenticate()
    {
        helper(['form']);

        if ($this->request->getMethod() === 'post') {
            $adminInput = $this->request->getPost('admin');
            $passwordInput = $this->request->getPost('password');

            $db = \Config\Database::connect();
            $builder = $db->table('admin');
            $adminData = $builder->where('admin', $adminInput)->get()->getRow();

            if ($adminData && $passwordInput === $adminData->password) {
                session()->set('isAdminLoggedIn', true);
                return redirect()->to('/admin/dashboard');
            }

            return view('admin/admin-login', ['error' => 'Invalid credentials']);
        }

        return view('admin/admin-login');
    }

    public function index()
    {
        // just to be safe
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        $userModel = new UserModel();
        $catalogModel = new CatalogModel();

        $searchUser = $this->request->getGet('search_user');
        $searchProduct = $this->request->getGet('search_product');

        $data['users'] = $searchUser
            ? $userModel->groupStart()
            ->like('first_name', $searchUser)
            ->orLike('last_name', $searchUser)
            ->orLike('email', $searchUser)
            ->groupEnd()
            ->findAll()
            : $userModel->findAll();

        $data['products'] = $searchProduct
            ? $catalogModel->groupStart()
            ->like('productName', $searchProduct)
            ->orLike('productCategory', $searchProduct)
            ->groupEnd()
            ->findAll()
            : $catalogModel->findAll();

        $db = \Config\Database::connect();
        $totalSoldQuery = $db->table('order_items')->selectSum('quantity', 'total_sold')->get()->getRowArray();
        $totalRevenueQuery = $db->table('orders')->selectSum('totalAmount', 'total_revenue')->get()->getRowArray();

        $data['salesStats'] = [
            'total_sold' => $totalSoldQuery['total_sold'] ?? 0,
            'total_revenue' => $totalRevenueQuery['total_revenue'] ?? 0
        ];

        return view('admin/admin', $data);
    }

    public function deleteUser($id)
    {
        $db = \Config\Database::connect();

        $db->table('cart')->where('userID', $id)->delete();

        (new UserModel())->delete($id);

        return redirect()->to('/admin/dashboard');
    }

    public function deleteProduct($id)
    {
        (new CatalogModel())->delete($id);
        return redirect()->to('/admin/dashboard');
    }

    public function addProduct()
    {
        $productModel = new \App\Models\ProductModel();

        $data = [
            'productName' => $this->request->getPost('productName'),
            'productCategory' => $this->request->getPost('productCategory'),
            'productStock' => $this->request->getPost('productStock'),
            'productPrice' => $this->request->getPost('productPrice'),
            'productDescription' => $this->request->getPost('productDescription'),
            'productImage' => $this->request->getPost('productImage'),
            'productMaterial' => $this->request->getPost('productMaterial') ?? '',
            'productDimension' => $this->request->getPost('productDimension') ?? '',
            'productWeightCapacity' => $this->request->getPost('productWeightCapacity') ?? ''
        ];

        $productModel->insert($data);

        return redirect()->to('/admin/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin');
    }
}
