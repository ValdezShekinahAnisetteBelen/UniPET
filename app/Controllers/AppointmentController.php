<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RestFul\ResourceController;
use App\Models\AppointmentModel;

class AppointmentController extends ResourceController
{
    public function getPetIdsByCustomerId($customer_id)
    {
        $model = new AppointmentModel();
        $petIds = $model->getPetIdsByCustomerId($customer_id);

        return $this->response->setJSON($petIds);
    }

    public function getAll()
    {
        $main = new AppointmentModel();
        $data = $main->findAll();
        return $this->respond($data, 200);
    }

//     public function saveAppointment()
// {
//     // Get the uploaded image file from the request
//     $imageFile = $this->request->getFile('image');

//     // Check if an image file was uploaded
//     if ($imageFile && $imageFile->isValid()) {
//         // Get the original filename
//         $imageName = $imageFile->getClientName();

//         // Move the uploaded image file to a designated folder
//         $imageFile->move(ROOTPATH . 'public/uploads', $imageName);

//         // Set the image field in the data array to the uploaded image filename with "User/images/"
//         $data['image'] = 'User/images/' . $imageName;
//     }

//     // Get the rest of the data from the request
//     $data['pet_name'] = $this->request->getPost('pet_name');
//     $data['breed'] = $this->request->getPost('breed');
//     $data['date_of_birth'] = $this->request->getPost('date_of_birth');
//     $data['weight'] = $this->request->getPost('weight');
//     $data['color'] = $this->request->getPost('color');
//     $data['temperature'] = $this->request->getPost('temperature');
//     $data['full_name'] = $this->request->getPost('full_name');
//     $data['area'] = $this->request->getPost('area');
//     $data['city'] = $this->request->getPost('city');
//     $data['postal_code'] = $this->request->getPost('postal_code');
//     $data['contact_no'] = $this->request->getPost('contact_no');
//     $data['email_address'] = $this->request->getPost('email_address');
//     $data['appointment_date'] = $this->request->getPost('appointment_date');
//     $data['appointment_time'] = $this->request->getPost('appointment_time');
//     $data['appointment_type'] = $this->request->getPost('appointment_type');
//     $data['grooming_type'] = $this->request->getPost('grooming_type');
//     $data['grooming_shampoo'] = $this->request->getPost('grooming_shampoo');
//     $data['customer_id'] = $this->request->getPost('customer_id');
//     $data['status'] = $this->request->getPost('status');
//     $data['Year'] = $this->request->getPost('Year');

//     // Validate input data if needed

//     // Save the appointment to the database
//     $result = $this->model->insert($data);

//     if ($result) {
//         return $this->respond(['status' => 'success', 'message' => 'Appointment saved successfully'], 200);
//     } else {
//         return $this->failServerError('Failed to save appointment');
//     }
// }

public function getTableHeaders()
{
    try {
        $model = new AppointmentModel();
        $headers = $model->getTableHeaders();

        return $this->respond(['headers' => $headers]);
    } catch (\Exception $e) {
        return $this->failServerError('Error fetching table headers: ' . $e->getMessage());
    }
}
public function editStatus3()
{
    try {
        // Receive the updated status and pet ID from the frontend
        $status = $this->request->getVar('status');
        $petId = $this->request->getVar('petId');

        // Check if parameters are not empty
        if (empty($status) || empty($petId)) {
            throw new \Exception('Invalid parameters');
        }

        // Log received data for debugging
        log_message('debug', 'Received petId: ' . $petId . ', status: ' . $status);

        // Update the status in the database
        $appointmentModel = new AppointmentModel();
        $appointmentModel->where('pet_id', $petId)->set(['status' => $status])->update();

        // Return a success response with a 200 status code
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode([
            'status' => true,
            'message' => 'Status updated successfully',
            'data' => [
                'petId' => $petId,
                'newStatus' => $status,
            ],
        ]);
        exit;
    } catch (\Exception $e) {
        // Log the exception or print the error message for debugging
        error_log($e->getMessage());

        // Return a response indicating failure with a 500 status code
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode([
            'status' => false,
            'message' => 'Internal Server Error',
        ]);
        exit;
    }
}

    



    public function getPetDataById($petId)
    {
        $model = new AppointmentModel();
        $petData = $model->getPetDataById($petId); // Add this method to your model

        return $this->response->setJSON($petData);
    }
    

    public function getAppointmentDistributionByArea(string $Year) {
        $model = new AppointmentModel();
        $data = $model->getAppointmentDistributionByArea($Year);
        
        return $this->respond($data);
    }
    
    public function index()
    {
        //
    }

    public function getData1($id)
    {
        // Assuming $id is the parameter from the URL
        $app = new AppointmentModel();
        $new = $app->where('customer_id', $id)->findAll(); // Adjust the field based on your database structure
    
        if ($new) {
            return $this->respond($new, 200);
        } else {
            return $this->failNotFound('Data not found.');
        }
    }
    public function save()
    {
        $json = $this->request->getJSON();
    
        // Extract the selected values from the request
        $appointment_type = $json->appointment_type;
        $grooming_type = $json->grooming_type;
        $grooming_shampoo = $json->grooming_shampoo;
    
        $data = [
            'customer_id' => $json->customer_id,
            'pet_name' => $json->pet_name,
            'breed' => $json->breed,
            'date_of_birth' => $json->date_of_birth,
            'weight' => $json->weight,
            'color' => $json->color,
            'temperature' => $json->temperature,
            'full_name' => $json->full_name,
            'area' => $json->area,
            'city' => $json->city,
            'postal_code' => $json->postal_code,
            'contact_no' => $json->contact_no,
            'email_address' => $json->email_address,
            'appointment_date' => $json->appointment_date,
            'appointment_time' => $json->appointment_time,
            'appointment_type' => implode(',', $appointment_type), // Convert array to comma-separated string
            'grooming_type' => implode(',', $grooming_type), // Convert array to comma-separated string
            'grooming_shampoo' => implode(',', $grooming_shampoo), // Convert array to comma-separated string
            'image' => $json->image,
        ];
    
        $app = new AppointmentModel();
        $app->save($data); // Save the data to the database
    
        return $this->respond(['status' => 'Data saved successfully']);
    }

    public function updateUserDataAndPetData($pet_id)
{
    $json = $this->request->getJSON();

    log_message('debug', 'Received JSON data: ' . json_encode($json));

    // Combine user and pet data
    $updatedData = [
        'full_name' => $json->full_name,
        'area' => $json->area,
        'city' => $json->city,
        'postal_code' => $json->postal_code,
        'contact_no' => $json->contact_no,
        'email_address' => $json->email_address,
        'pet_name' => $json->pet_name,
        'breed' => $json->breed,
        'date_of_birth' => $json->date_of_birth,
        'weight' => $json->weight,
        'color' => $json->color,
        'temperature' => $json->temperature,
        'image' => $json->image,
        // Add other fields as needed
    ];

    try {
        // Update data using the model method
        $app = new AppointmentModel();
        $app->updateUserDataAndPetData($pet_id, $updatedData);

        // return a response when the data is updated
        return $this->respond(['status' => 200, 'message' => 'User and pet data updated successfully']);
    } catch (\Exception $e) {
        // Handle exceptions if necessary
        log_message('error', 'Error updating user and pet data: ' . $e->getMessage());
        return $this->respond(['status' => 500, 'message' => 'Error updating user and pet data'], 500);
    }
}

    // public function api_get_appointments($params)
    // {
    //     $app = new AppointmentModel();
    //     $appointments = $app->where('customer_id', $params)->findAll(); 
    //     return $this->respond($appointments);
    // }
    

}
