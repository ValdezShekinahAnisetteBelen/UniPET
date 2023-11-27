<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class OrderHistoryController extends BaseController
{
    public function index()
    {
        //
    }

    public function saveOrder()
    {
        // Retrieve JSON data from the request
        $json = $this->request->getJSON();
    
        // Extract the selected values from the request
        $transactionNo = $json->transactions->transaction_no;
        $products = $json->products;
    
        // Loop through each product and save it to the database
        foreach ($products as $product) {
            $productId = $product->product_id;
            $customerId = $product->customer_id;
    
            // Create an associative array with the extracted values
            $data = [
                'transaction_no' => $transactionNo,
                'product_id' => $productId,
                'customer_id' => $customerId,
            ];
    
            // Save the data to the database using the model
            $orderModel = new \App\Models\OrderHModel(); // Adjust the namespace if needed
            $orderModel->save($data);
        }
    
        // Return a response if needed
        return $this->response->setJSON(['status' => 'Data saved successfully']);
    }
    
    
}
