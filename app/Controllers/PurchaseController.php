<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PurchaseModel;

class PurchaseController extends BaseController
{
    public function index()
    {
        //
    }
   public function getData3($customer_id)
{
    $main = new PurchaseModel();
    
    // Assuming you have a column named 'customer_id' and 'created_at' in your table
    $today = date('Y-m-d'); // Get today's date in the format 'YYYY-MM-DD'

    // Fetch data based on customer_id and created_at being today
    $data = $main->where('customer_id', $customer_id)
                
                 ->findAll();

    // Return a JSON response
    return $this->response->setJSON($data)->setStatusCode(200);
}
    

    public function purchase() 
    {
        // Ensure that the request has the required data.
    $requestData = $this->request->getJSON();
        $name = $this->request->getVar('name');
        $total_price = $this->request->getVar('total_price');
        $image = $this->request->getVar('image');
        $productgroup = $this->request->getVar('productgroup');
        $unit_price = $this->request->getVar('unit_price');
        $quantity = $this->request->getVar('quantity');
        $product_id = $this->request->getVar('product_id');
        $customer_id = $this->request->getVar('customer_id');

        // Validate and sanitize the data as needed.

        // Save the product details to the cart using a model.
        $PurchaseModel = new PurchaseModel();

        $data = [
            'product_id' => $product_id,
            'name' => $name,
            'total_price' => $total_price,
            'unit_price' => $unit_price,
            'quantity' => $quantity,
            'image' => $image,
            'productgroup' => $productgroup,
            'customer_id' => $customer_id,
            // Add other fields as needed.
        ];

        // Validate and sanitize data as needed.

        // Save to the database.
        $PurchaseModel->insert($data);

        // Return a response to the front-end (e.g., success message).
        return $this->response->setJSON(['message' => 'Product added to the cart']);
    }



    }
