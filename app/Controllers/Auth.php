<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        helper(['form']);
        $model = new UserModel();

        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $validation = \Config\Services::validation();

            $user = $model->where('email', $email)->first();

            if (!$user) {
                $validation->setError('email', 'This email is not registered.');
                return view('auth/login', ['validation' => $validation]);
            }

            if (!password_verify($password, $user['password'])) {
                $validation->setError('password', 'Incorrect password. Please try again.');
                return view('auth/login', ['validation' => $validation]);
            }

            // If successful
            session()->set([
                'user_id' => $user['userID'],
                'email'   => $user['email'],
                'logged_in' => true
            ]);

            return redirect()->to('/');
        }

        return view('auth/login');
    }

    public function signup()
    {
        helper(['form']);
        $model = new UserModel();

        if ($this->request->getMethod() === 'post') {
            log_message('debug', 'Signup POST received');
            $validationRules = [
                'first_name' => 'required|min_length[2]',
                'last_name'  => 'required|min_length[2]',
                'email'      => 'required|valid_email|is_unique[user_account.email]',
                'password'   => 'required|min_length[6]',
                'confirm_password' => [
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => 'Please confirm your password',
                        'matches' => 'Password did not match'
                    ]
                ]
            ];

            if (!$this->validate($validationRules)) {
                return view('auth/signup', ['validation' => $this->validator]);
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
            $model->save($data);

            return redirect()->to('/login');
        }

        return view('auth/signup');
    }

    public function logout()
    {
        $session = session();

        $session->destroy();

        return redirect()->to('login');
    }
}
