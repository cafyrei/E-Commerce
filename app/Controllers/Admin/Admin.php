<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\CatalogModel;
use App\Models\OrderModel;
use App\Models\OrderItemsModel;

class Admin extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $catalogModel = new CatalogModel();

        $searchUser = $this->request->getGet('search_user');
        $searchProduct = $this->request->getGet('search_product');

        if ($searchUser) {
            $data['users'] = $userModel
                ->groupStart()
                ->like('first_name', $searchUser)
                ->orLike('last_name', $searchUser)
                ->orLike('email', $searchUser)
                ->groupEnd()
                ->findAll();
        } else {
            $data['users'] = $userModel->findAll();
        }

        if ($searchProduct) {
            $data['products'] = $catalogModel
                ->groupStart()
                ->like('productName', $searchProduct)
                ->orLike('productCategory', $searchProduct)
                ->groupEnd()
                ->findAll();
        } else {
            $data['products'] = $catalogModel->findAll();
        }

        $db = \Config\Database::connect();

        $totalSoldQuery = $db->table('order_items')
            ->selectSum('quantity', 'total_sold')
            ->get()
            ->getRowArray();

        $totalRevenueQuery = $db->table('orders')
            ->selectSum('totalAmount', 'total_revenue')
            ->get()
            ->getRowArray();

        $data['salesStats'] = [
            'total_sold' => $totalSoldQuery['total_sold'] ?? 0,
            'total_revenue' => $totalRevenueQuery['total_revenue'] ?? 0
        ];

        return view('admin/admin', $data);
    }

    public function deleteUser($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        return redirect()->to('/admin');
    }

    public function deleteProduct($id)
    {
        $catalogModel = new CatalogModel();
        $catalogModel->delete($id);
        return redirect()->to('/admin');
    }
}
