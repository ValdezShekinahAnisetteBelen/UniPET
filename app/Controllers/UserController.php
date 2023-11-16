<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Models\UserModel;
use App\Controllers\BaseController;

class UserController extends ResourceController
{
    public function register()
    {
        $user = new UserModel();
        $token = $this->verification(50);
    
        $username = $this->request->getVar('username');
        $email = $this->request->getVar('email'); // Add this line to capture the email field
        $password = $this->request->getVar('password');
    
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->respond(['msg' => 'invalidEmail']);
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
    
        if ($u) {
            return $this->respond(['msg' => 'okay', 'token' => $token]);
        } else {
            return $this->respond(['msg' => 'failed']);
        }
    }    

        public function verification($length){ 

            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 

            return substr(str_shuffle($str_result), 

            0, $length); 

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
