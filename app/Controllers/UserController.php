<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait; 
use App\Models\UserModel;


class UserController extends ResourceController
{
    use ResponseTrait;

    public function register()
    {
        $user = new UserModel();
        $token = $this->verification(50);

        $username = $this->request->getVar('username');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->respond(['msg' => 'invalidEmail'], 400);
        }

        $data = [
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'token' => $token,
            'status' => 'active',
            'role' => 'user',
        ];

        $u = $user->save($data);

        // Check for validation errors
        if ($user->errors()) {
            return $this->respond(['msg' => 'validationError', 'errors' => $user->errors()], 400);
        }

        if ($u) {
            return $this->respond(['msg' => 'okay', 'token' => $token]);
        } else {
            return $this->respond(['msg' => 'failed'], 500);
        }
    }

    public function verification($length)
    {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result), 0, $length);
    }
    public function login() 
    {
        $username = $this->request->getVar("username");
        $password = $this->request->getVar("password");

        $user = new UserModel();
        $data = $user->where('username', $username)->first();
        if($data){
            $pass = $data['password'];
            $authenticatedPassword = password_verify($password, $pass);
            if($authenticatedPassword)
            {
                return $this->respond(['msg' => 'okay', 'token' => $data['token']], 200);
            }
        else{
            return $this->respond(['msg' => 'invalid password'], 200);
        }
    }else {
        return $this->respond(['msg' => 'no user found'], 200);
    }
}
    

    public function index()
    {
        //
    }
}
