<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Exception;

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
    public function createUser($role = 'user')
    {
        // Extract user data from the request
        $username = $this->request->getVar('username');
        $email = $this->request->getVar('email');
    
        // Additional validation if needed
        // Example: Check if required fields are present
        if (empty($username) || empty($email) || empty($this->request->getVar('password'))) {
            return $this->respond(['msg' => 'Missing required fields'], 400); // 400 Bad Request
        }
    
        // Hash the password securely
        $hashedPassword = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
    
        // Create a new user record or update an existing user
        $userModel = new UserModel(); // Make sure to adjust the model class based on your implementation
    
        // Check if the user already exists by email
        $existingUser = $userModel->where('email', $email)->first();
    
        if ($existingUser) {
            // Update the existing user's role to the specified role
            $result = $userModel->update($existingUser['customer_id'], [
                'role' => $role,
                // You can update other fields as needed
            ]);
        } else {
            // Save user data for a new user
            $result = $userModel->save([
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword,
                'status' => 'active', // Set default status or adjust as needed
                'role' => $role, // Set the role based on the parameter (default is 'user')
            ]);
        }
    
        if ($result) {
            // Registration or update successful
            return $this->respond(['msg' => 'User created/updated successfully'], 200);
        } else {
            // Log the error details for debugging
            log_message('error', 'Failed to create/update user. ' . $userModel->errors());
            return $this->respond(['msg' => 'Failed to create/update user'], 500); // 500 Internal Server Error
        }
    }

    public function getUserProfile($userId)
    {
        $this->model = new \App\Models\UserModel(); 
        // Fetch user profile data based on $userId
        $user = $this->model->find($userId);

        return $this->respond($user);
    }

  // UserController.php

public function saveUserProfile($userId)
{
    try {
        $json = $this->request->getJSON();
        log_message('debug', 'Received JSON data: ' . json_encode($json));

        // Example validation: Check if 'customer_id' is provided
        $customerID = $json->customer_id;

        if (empty($customerID)) {
            return $this->respond(['status' => 400, 'message' => 'Invalid request. User ID not provided.']);
        }

        // Assuming you have a UserModel or a database table named 'customer'
        $userModel = new \App\Models\UserModel();
        $existingUser = $userModel->find($userId);

        if ($existingUser) {
            // Combine user data for update
            $userData = [
                'first_name' => $json->first_name,
                'last_name' => $json->last_name,
                'email' => $json->email,
                'phone_number' => $json->phone_number,
                'username' => $json->username,
                'image' => $json->image,
                // Add other fields as needed
            ];

            // Update existing user profile
            $result = $userModel->update($userId, $userData);

            if ($result) {
                return $this->respond(['status' => 200, 'message' => 'Profile updated successfully']);
            } else {
                return $this->respond(['status' => 500, 'message' => 'Error updating user profile']);
            }
        } else {
            return $this->respond(['status' => 404, 'message' => 'User not found']);
        }
    } catch (\Exception $e) {
        // Handle exceptions and log the error message
        log_message('error', 'Error updating user profile: ' . $e->getMessage());

        return $this->respond(['status' => 500, 'message' => 'Internal Server Error']);
    }
}

    public function updateUserRoleController($customerId)
    {
        try {
            // Assuming you have dependency injection for the request object
            $input = json_decode($this->request->getBody(), true);
    
            // Retrieve role from input
            $role = $input['role'];
    
            log_message('debug', 'updateUserRoleController - Received request. Customer ID: ' . $customerId . ', Role: ' . $role);
    
            // Assuming updateUserRole returns a boolean indicating success
            $model = new UserModel(); // Replace with dependency injection if possible
            $success = $model->updateUserRole($customerId, $role);
    
            if ($success) {
                // Respond with JSON 200 status
                return $this->respond(['status' => 200, 'msg' => 'Role updated successfully']);
            } else {
                // Respond with JSON 500 status in case of failure
                return $this->respond(['status' => 500, 'msg' => 'Failed to update role'], 500);
            }
        } catch (\Exception $e) {
            // Log the exception for debugging
            log_message('error', 'updateUserRoleController - Exception: ' . $e->getMessage());
            log_message('error', 'updateUserRoleController - File: ' . $e->getFile() . ', Line: ' . $e->getLine());
    
            // Respond with JSON 500 status in case of exception
            return $this->respond(['status' => 500, 'msg' => 'Internal Server Error: ' . $e->getMessage()], 500);
        }
    }    
    
    public function registerAdmin()
    {
        // Assuming $this->createUser is accessible in this controller
        $this->createUser('admin');
        
        // Additional logic or response handling as needed
    }

    public function registerUser()
    {
        // Assuming $this->createUser is accessible in this controller
        $this->createUser('user');
        
        // Additional logic or response handling as needed
    }
    public function delete2($customerId)
    {
        $model = new UserModel(); // Adjust the model class based on your implementation

        // Perform deletion
        try {
            $model->delete($customerId);
            return $this->response->setStatusCode(200)->setJSON(['success' => 'Customer deleted successfully']);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Error deleting customer']);
        }
    }

    public function editCustomer($customerId)
    {
        // You can perform validation and additional logic here
        
        $model = new UserModel();

        // Fetch the customer data by customer_id
        $customer = $model->find($customerId);

        if (!$customer) {
            // Customer not found
            return $this->failNotFound('Customer not found');
        }

        // Return the customer data as JSON response
        return $this->respond($customer);
    }

    public function updateCustomer($customerId)
    {
        // You can perform validation and additional logic here
        
        $model = new UserModel();

        // Fetch the customer data by customer_id
        $customer = $model->find($customerId);

        if (!$customer) {
            // Customer not found
            return $this->failNotFound('Customer not found');
        }

        // Get the updated data from the request
        $updatedData = $this->request->getJSON(true);

        // Update the customer data
        $model->update($customerId, $updatedData);

        // Return a success message as JSON response
        return $this->respond(['message' => 'Customer updated successfully']);
    }

    public function getAll2()
    {
        $main = new UserModel();
        
        // Adjust the following line to filter based on the 'role' column
        $data = $main->where('role', 'user')->findAll();
    
        return $this->respond($data, 200);
    }
    public function getAll3()
    {
        $main = new UserModel();
        
        // Adjust the following line to filter based on the 'role' column
        $data = $main->where('role', 'admin')->findAll();
    
        return $this->respond($data, 200);
    }
    
    public function getTableHeaders2()
{
    try {
        $model = new UserModel();
        $headers = $model->getTableHeaders();

        return $this->respond(['headers' => $headers]);
    } catch (\Exception $e) {
        return $this->failServerError('Error fetching table headers: ' . $e->getMessage());
    }
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

    public function register2()
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
            'role' => 'admin',
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