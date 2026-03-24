<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AddressModel;

class User extends BaseController
{
    public function profile()
    {
        $session = session();
        $userModel = new UserModel();
        $addressModel = new AddressModel();

        $userID = $session->get('user_id');

        if (!$userID) {
            return redirect()->to('/login');
        }

        $data['user'] = $userModel->find($userID);
        $data['addresses'] = $addressModel->where('userID', $userID)->findAll();

        return view('user-profile', $data);
    }

    public function updateProfile()
    {
        $session = session();
        $model = new UserModel();

        $userID = $session->get('user_id');

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'birthdate'  => $this->request->getPost('birthdate'),
            'country'    => $this->request->getPost('country'),
        ];

        $model->update($userID, $data);

        return redirect()->to('profile')->with('success', 'Profile updated!');
    }

    public function updatePassword()
    {
        $session = session();
        $model = new UserModel();
        $userID = $session->get('user_id');

        $user = $model->find($userID);
        $currentPasswordInput = $this->request->getPost('current_password');

        if (!password_verify($currentPasswordInput, $user['password'])) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        $validationRules = [
            'password'         => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $hashedPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $model->update($userID, ['password' => $hashedPassword]);

        return redirect()->to('profile')->with('success', 'Password updated successfully!');
    }

    public function updateAddress()
    {
        $session = session();
        $userID = $session->get('user_id');

        if (!$userID) {
            return redirect()->to('/login');
        }

        $model = new AddressModel();

        $addressCount = $model->where('userID', $userID)->countAllResults();

        if ($addressCount >= 3) {
            return redirect()->to('profile')->with('error', 'You can only save up to 3 addresses.');
        }

        $data = [
            'userID'   => $userID,
            'street'   => $this->request->getPost('street'),
            'barangay' => $this->request->getPost('barangay'),
            'city'     => $this->request->getPost('city'),
            'state'    => $this->request->getPost('province'),
            'zip'      => $this->request->getPost('postal'),
            'Label'    => $this->request->getPost('label'), 
        ];

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
