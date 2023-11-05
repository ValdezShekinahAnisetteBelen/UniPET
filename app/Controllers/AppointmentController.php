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

    public function getData1()
    {
        $app = new AppointmentModel();
        $new = $app->findAll();
        return $this->respond($new, 200);
    }

    public function save()
    {
        $json = $this->request->getJSON();
    
        // Extract the selected values from the request
        $appointment_type = $json->appointment_type;
        $grooming_type = $json->grooming_type;
        $grooming_shampoo = $json->grooming_shampoo;
    
        $data = [
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
            'appointment_type' => implode(',', $appointment_type), // Convert array to comma-separated string
            'grooming_type' => implode(',', $grooming_type), // Convert array to comma-separated string
            'grooming_shampoo' => implode(',', $grooming_shampoo), // Convert array to comma-separated string
            'image' => $json->image,
        ];
    
        $app = new AppointmentModel();
        $app->save($data); // Save the data to the database
    
        return $this->respond(['status' => 'Data saved successfully']);
    }
    

}
