<?php

namespace App\Controllers;

use App\Models\UserModel;

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

    public function signup()
    {
        helper(['form']);
        $model = new UserModel();

        if ($this->request->getPost()) {
            echo "POST Received";
            $validationRules = [
                'first_name' => 'required|min_length[2]',
                'last_name'  => 'required|min_length[2]',
                'email'      => 'required|valid_email|is_unique[user_account.email]',
                'password'   => 'required|min_length[6]',
                'confirm_password' => 'matches[password]',
            ];

            if (!$this->validate($validationRules)) {
                return view('pages/signup', ['validation' => $this->validator]);
            }

            $data = [
                'first_name'   => $this->request->getPost('first_name'),
                'middle_name'  => $this->request->getPost('middle_name'),
                'last_name'    => $this->request->getPost('last_name'),
                'suffix'       => $this->request->getPost('suffix'),
                'email'        => $this->request->getPost('email'),
                'phone_number' => $this->request->getPost('phone_number'),
                'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];
            echo "Went Through Data Save";
            $model->save($data);

            return redirect()->to('/login');
        }

        return view('pages/signup');
    }
}
