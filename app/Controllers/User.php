<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AddressModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\ProductModel;

class User extends BaseController
{
    public function profile()
    {
        $userID = session()->get('user_id');

        if (!$userID) {
            return redirect()->to(base_url('login'));
        }

        $userModel = new UserModel();
        $addressModel = new AddressModel();
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();
        $productModel = new ProductModel();

        $user = $userModel->find($userID);
        $addresses = $addressModel->where('userID', $userID)->findAll();

        $orders = $orderModel->where('userID', $userID)
                             ->orderBy('orderID', 'DESC')
                             ->findAll();

        foreach ($orders as &$order) {
            $items = $orderItemModel->where('orderID', $order['orderID'])->findAll();

            foreach ($items as &$item) {
                $product = $productModel->find($item['productID']);
                $item['product'] = $product;
            }

            $order['items'] = $items;
        }

        return view('user-profile', [
            'user' => $user,
            'addresses' => $addresses,
            'orders' => $orders
        ]);
    }

    public function updateProfile()
    {
        $userID = session()->get('user_id');

        if (!$userID) {
            return redirect()->to(base_url('login'));
        }

        $userModel = new UserModel();

        $userModel->update($userID, [
            'first_name'   => $this->request->getPost('first_name'),
            'middle_name'  => $this->request->getPost('middle_name'),
            'last_name'    => $this->request->getPost('last_name'),
            'suffix'       => $this->request->getPost('suffix'),
            'phone_number' => $this->request->getPost('phone_number'),
            'birthdate'    => $this->request->getPost('birthdate'),
        ]);

        return redirect()->to(base_url('profile'))->with('success', 'Profile updated successfully.');
    }

    public function updatePassword()
    {
        $userID = session()->get('user_id');

        if (!$userID) {
            return redirect()->to(base_url('login'));
        }

        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        $userModel = new UserModel();
        $user = $userModel->find($userID);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        if (!password_verify($currentPassword, $user['password'])) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        if ($newPassword !== $confirmPassword) {
            return redirect()->back()->with('error', 'Passwords do not match.');
        }

        $userModel->update($userID, [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT)
        ]);

        return redirect()->to(base_url('profile'))->with('success', 'Password updated successfully.');
    }

    public function updateAddress()
    {
        $userID = session()->get('user_id');

        if (!$userID) {
            return redirect()->to(base_url('login'));
        }

        $addressModel = new AddressModel();

        $data = [
            'userID' => $userID,
            'street' => $this->request->getPost('street'),
            'city'   => $this->request->getPost('city'),
            'state'  => $this->request->getPost('state'),
            'zip'    => $this->request->getPost('zip'),
        ];

        $existingAddress = $addressModel->where('userID', $userID)->first();

        if ($existingAddress) {
            $addressModel->update($existingAddress['addressID'], $data);
            return redirect()->to(base_url('profile'))->with('success', 'Address updated successfully.');
        }

        $addressModel->insert($data);
        return redirect()->to(base_url('profile'))->with('success', 'Address added successfully.');
    }

    public function deleteAddress($addressID)
    {
        $userID = session()->get('user_id');

        if (!$userID) {
            return redirect()->to(base_url('login'));
        }

        $addressModel = new AddressModel();

        $address = $addressModel
            ->where('addressID', $addressID)
            ->where('userID', $userID)
            ->first();

        if (!$address) {
            return redirect()->back()->with('error', 'Address not found.');
        }

        $addressModel->delete($addressID);

        return redirect()->to(base_url('profile'))->with('success', 'Address deleted successfully.');
    }
}