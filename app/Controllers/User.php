<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AddressModel;
use App\Models\OrderModel;
use App\Models\OrderItemsModel;
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
        $orderItemModel = new OrderItemsModel();
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
            return redirect()->to(base_url('auth/login'));
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
        $session = session();
        $userID = $session->get('user_id');

        if (!$userID) {
            return redirect()->to(base_url('auth/login'));
        }

        $model = new AddressModel();

        $addressID = $this->request->getPost('addressID');

        $data = [
            'userID'   => $userID,
            'street'   => $this->request->getPost('street'),
            'barangay' => $this->request->getPost('barangay'),
            'city'     => $this->request->getPost('city'),
            'state'    => $this->request->getPost('province'),
            'zip'      => $this->request->getPost('postal'),
            'Label'    => $this->request->getPost('label'),
            'full_address' => $this->request->getPost('address')
        ];

        if ($addressID) {
        $data['addressID'] = $addressID;

        } else {
            $addressCount = $model->where('userID', $userID)->countAllResults();

            if ($addressCount >= 3) {
                return redirect()->to('profile')->with('error', 'You can only save up to 3 addresses.');
        }
    }

    $model->save($data);

        return redirect()->to('profile')->with('success', 'Address saved!');
    }

    public function deleteAddress($id)
    {
        $addressModel = new AddressModel();
        $userId = session()->get('user_id');

        $address = $addressModel->where('addressID', $id)
            ->where('userID', $userId)
            ->first();

        if ($address) {
            $addressModel->delete($id);
            return redirect()->to('/profile')->with('success', 'Address removed.');
        }

        return redirect()->to('/profile')->with('error', 'Address not found or unauthorized.');
    }
}
