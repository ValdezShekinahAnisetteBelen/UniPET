<?php

namespace App\Controllers;


use CodeIgniter\HTTP\Request;
use CodeIgniter\RestFul\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\TransactionModel;

class TransactionController extends ResourceController
{
    use ResponseTrait;
    protected $transactionModel;

public function __construct()
{
    $this->transactionModel = new TransactionModel(); // Load the model
}
public function getTransactionDetails($transactionNo)
{
    $transactionModel = new TransactionModel();
    $transactionDetails = $transactionModel->where('transaction_no', $transactionNo)->first();

    return $this->response->setJSON($transactionDetails);
}
    public function index()
    {
        //
    }

    public function saveTransaction()
    {
        $json = $this->request->getJSON();
        //return $this->respond($json,200);
        $data = [
            'address' => $json->address,
            'delivering_to' => $json->delivering_to,
            'additional_details' => $json->additional_details,
            'customer_id' => $json->customer_id,
            'driver_instructions' => $json->driver_instructions,
            'mobile_contact_number' => $json->mobile_contact_number,
            'change_for_how_much' => $json->change_for_how_much,
            'payment_method' => $json->payment_method,
           'total_price' => $json->total_price,
        ];
        //return $this->respond($json,200);

   
    
        try {
            $this->transactionModel->save($data); // Use the model instance
    
            // Log the information about the saved data
            log_message('debug', 'Data saved successfully: ' . print_r($data, true));
    
            return $this->respond(['status' => 'Data saved successfully'], 200);
        } catch (\Exception $e) {
            log_message('error', 'Error saving data: ' . $e->getMessage());
            return $this->respond(['error' => $e->getMessage()]);
        }
    }
    
    public function getData2()
    {
        $transactionModel = new TransactionModel();
        $data = $transactionModel->findAll();
        return $this->respond($data, 200);
    }




}
