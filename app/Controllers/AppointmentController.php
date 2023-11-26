<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RestFul\ResourceController;
use App\Models\AppointmentModel;

class AppointmentController extends ResourceController
{
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
