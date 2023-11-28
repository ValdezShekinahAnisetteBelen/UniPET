<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use Firebase\JWT\JWT;

class UserController extends ResourceController
{
    use ResponseTrait;
    private function getUserFromSession()
    {
        $userId = session()->get('customer_id');

        if ($userId) {
            $userModel = new UserModel();
            return $userModel->getUserById($userId);
        }

        return null;
    }
    public function getCustomerDetails($customerId)
    {
        $customerModel = new UserModel();
        $customerDetails = $customerModel->find($customerId);

        return $this->response->setJSON($customerDetails);
    }

    public function register()
    {
        $user = new UserModel();
        $token = $this->verification(50);

        // Get form input
        $username = $this->request->getVar('username');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Set validation rules
        $validationRules = [
            'username' => 'required|min_length[5]|max_length[255]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
        ];

        if (!$this->validate($validationRules)) {
            // Set flash message for validation errors
            session()->setFlashdata('error', 'Validation errors. Please check your input.');
    
            // Check if there is a specific error for the username field
            if ($this->validator->hasError('username')) {
                // Customize the flash message for the username validation error
                session()->setFlashdata('username_error', 'Username must be between 5 and 255 characters.');
            }
    
            // Check if there is a specific error for the email field
            if ($this->validator->hasError('email')) {
                // Customize the flash message for the email validation error
                session()->setFlashdata('email_error', 'Invalid email format.');
            }
    
            // Check if there is a specific error for the password field
            if ($this->validator->hasError('password')) {
                // Customize the flash message for the password validation error
                session()->setFlashdata('password_error', 'Password must be at least 8 characters.');
            }
    
            return $this->respond([
                'msg' => 'validationError',
                'errors' => $this->validator->getErrors(),
                'flash' => [
                    'username_error' => session()->getFlashdata('username_error'),
                    'email_error' => session()->getFlashdata('email_error'),
                    'password_error' => session()->getFlashdata('password_error'),
                    'success' => session()->getFlashdata('success'),
                    'error' => session()->getFlashdata('error'),
                ],
            ], 400);
        }
        // Prepare data for saving
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'token' => $token,
            'status' => 'active',
            'role' => 'user',
        ];

        // Save the data
        $u = $user->save($data);

        // Check for validation errors after save
        if ($user->errors()) {
            // Set flash message for validation errors after save
            session()->setFlashdata('error', 'Validation errors. Please check your input.');
            return $this->respond(['msg' => 'validationError', 'errors' => $user->errors()], 400);
        }

        if ($u) {
            // Set flash message for successful registration
            session()->setFlashdata('success', 'Registration successful');
            return $this->respond(['msg' => 'okay', 'token' => $token]);
        } else {
            // Set flash message for registration failure
            session()->setFlashdata('error', 'Registration failed. Please try again later.');
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
    // Validate input
    $validationRules = [
        'username' => 'required',
        'password' => 'required'
    ];

    if (!$this->validate($validationRules)) {
        return $this->respond(['msg' => 'validationError', 'errors' => $this->validator->getErrors()], 400);
    }

    $username = $this->request->getVar("username");
    $password = $this->request->getVar("password");

    $user = new UserModel();
    $data = $user->where('username', $username)->first();

    // Clear existing flash data
    session()->setFlashdata('success', '');
    session()->setFlashdata('error', '');

    if ($data) {
        $pass = $data['password'];
        $authenticatedPassword = password_verify($password, $pass);

        if ($authenticatedPassword) {
            // Generate JWT
            $key = 'your-secret-key'; // Replace with your secret key
            $tokenData = [
                'customer_id' => $data['customer_id'],
                'role' => $data['role'],
                // Add other claims as needed
            ];
            $algorithm = 'HS256';
            $key = env('JWT_SECRET_KEY');
            $token = JWT::encode($tokenData, $key, $algorithm);

            // Save the token to the user's record (you need to implement this in your database)
            $user->update($data['customer_id'], ['token' => $token]);

            // Return JWT and success message
            return $this->respond(['msg' => 'okay', 'token' => $token, 'flashMessages' => session()->getFlashdata()]);
        } else {
            // Incorrect password
            session()->setFlashdata('error', 'Invalid password');
            return $this->respond(['msg' => 'Invalid Password', 'flashMessages' => session()->getFlashdata()]);
        }
    } else {
        // User not found
        session()->setFlashdata('error', 'User not found');
        return $this->respond(['msg' => 'User not found', 'flashMessages' => session()->getFlashdata()]);
    }
}
    
public function homepage()
    {
        // Check if the user is logged in
        if (!$this->isLoggedIn()) {
            // Redirect or respond with an error if the user is not logged in
            return redirect()->to('/login'); // Redirect to the login page or another appropriate action
        }

        // Load the user dashboard view
        $userData = $this->getUserFromSession();

        // Load the user dashboard view with user data
        return view('Online_Store', ['userData' => $userData]);
    }
    public function shop()
    {
        // Check if the user is logged in
        if (!$this->isLoggedIn()) {
            // Redirect or respond with an error if the user is not logged in
            return redirect()->to('/login'); // Redirect to the login page or another appropriate action
        }

        // Load the user dashboard view
        return view('Shop'); // Replace 'user_dashboard' with your actual view file
    }
    // public function petinfo()
    // {
    //     // Check if the user is logged in
    //     if (!$this->isLoggedIn()) {
    //         // Redirect or respond with an error if the user is not logged in
    //         return redirect()->to('/login'); // Redirect to the login page or another appropriate action
    //     }

    //     $userData = $this->getUserFromSession();

    //     // Load the user dashboard view with user data
    //     return view('PetInfo', ['userData' => $userData]);
    // }
    public function appointmenthistory()
    {
        // Check if the user is logged in
        if (!$this->isLoggedIn()) {
            // Redirect or respond with an error if the user is not logged in
            return redirect()->to('/login'); // Redirect to the login page or another appropriate action
        }

        // Load the user dashboard view
        return view('AppointmentHistory'); // Replace 'user_dashboard' with your actual view file
    }
    public function myPurchases()
    {
        // Check if the user is logged in
        if (!$this->isLoggedIn()) {
            // Redirect or respond with an error if the user is not logged in
            return redirect()->to('/login'); // Redirect to the login page or another appropriate action
        }

        // Load the user purchases view
        return view('OrderHistory'); // Replace 'my_purchases' with your actual view file
    }

    private function isLoggedIn()
{
    $token = session()->get('token');

    if ($token) {
        $userModel = new UserModel();
        $userData = $userModel->getUserByToken($token);

        log_message('debug', 'Session Token: ' . $token);
        log_message('debug', 'Database Token: ' . ($userData ? $userData['token'] : 'Not found'));

        if ($userData) {
            session()->set('customer_id', $userData['customer_id']);
            return true;
        }
    }

    return false;
}

}