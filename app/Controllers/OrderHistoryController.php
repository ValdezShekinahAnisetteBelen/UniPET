<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\OrderHModel;
use App\Models\PurchaseModel;

class OrderHistoryController extends BaseController
{
    public function editStatus()
    {
        // Receive the updated status and order ID from the frontend
        $status = $this->request->getVar('status');
        $orderId = $this->request->getVar('orderId');
    
        // Update the status in the database
        $orderModel = new OrderHModel();
        $orderModel->update($orderId, ['status' => $status]);
    
        // Return a success response
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Status updated successfully',
            'data' => [
                'orderId' => $orderId,
                'newStatus' => $status,
            ],
        ]);
    }
    
    public function getOrders2()
    {
        $transactionNoModel = new OrderHModel();
    
        // Add your filters here
        $orders = $transactionNoModel
            ->whereIn('status', ['added', 'transacted'])
            ->findAll();
    
        return $this->response->setJSON($orders);
    }
    
    
    public function getOrders()
    {
        $transactionNoModel = new OrderHModel();
    
        // Add your filters here
        $orders = $transactionNoModel
            ->where('status !=', 'added')
            ->where('product_id IS NOT NULL')
            ->where('customer_id IS NOT NULL')
            ->where('transaction_no IS NOT NULL')
            ->findAll();
    
        return $this->response->setJSON($orders);
    }
    

    public function getBestSellingProductsByYear(string $year)
    {
        $transactionNo = new OrderHModel();
        $data = $transactionNo->getBestSellingProductsByYear($year);
    
        // Check if data is not empty before including it in the response
        if (!empty($data)) {
            return $this->response->setJSON(['year' => $year, 'data' => $data]);
        } else {
            return $this->response->setJSON(['status' => 'No data found']);
        }
    }
    public function index()
    {
        //
    }
       public function delete($customer_id)
    {
        
        try {
            $purchaseModel = new PurchaseModel();

            // Delete all records for the specific customer_id
            $purchaseModel->where('customer_id', $customer_id)->delete();

            // Optionally, you can return a response to indicate success
            return $this->response->setJSON(['message' => 'Records deleted successfully']);
        } catch (\Exception $e) {
            // Handle any exceptions that might occur during deletion
            return $this->response->setJSON(['error' => $e->getMessage()])->setStatusCode(500);
        }
    }

    public function deleteOrdersByCustomer($customer_id)
    {
        try {
            $orderModel = new PurchaseModel(); // Use PurchaseModel here
    
            // Delete all orders for the specific customer_id
            $orderModel->where('customer_id', $customer_id)->delete();
    
            // Optionally, you can return a response to indicate success
            return $this->response->setJSON(['message' => 'Orders deleted successfully']);
        } catch (\Exception $e) {
            // Handle any exceptions that might occur during deletion
            return $this->response->setJSON(['error' => $e->getMessage()])->setStatusCode(500);
        }
    }
    

    public function saveOrder()
{
    // Retrieve JSON data from the request
    $json = $this->request->getJSON();

    // Extract the selected values from the request
    $orderID = $this->request->getVar('orderID');
    $transactionNo = $json->transactions->transaction_no;
    $products = $json->products;

    // Check if orderID is received
    if (!$orderID) {
        // Check if an orderID is already generated for this transaction_no
        $orderID = $this->getOrderID($transactionNo);

        if (!$orderID) {
            // If not exists, generate a new orderID
            $orderID = 'ORD' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

            // Save the generated orderID for the transaction_no in the database
            $this->saveOrderID($transactionNo, $orderID);
        }
    }

    // Load the database using the new Database service outside of the loop
    $db = \Config\Database::connect();

    // Loop through each product and save it to the database
    foreach ($products as $product) {
        // Check if all specified columns are NULL
        if ($product->product_id === null && $product->customer_id === null && $product->price === null && $product->quantity === null) {
            // Skip insertion if all columns are NULL
            continue;
        }

        // Create an associative array with the extracted values
        $data = [
            'transaction_no' => $transactionNo,
            'product_id' => $product->product_id,
            'orderID' => $orderID, // Use the same orderID for each product in the loop
            'customer_id' => $product->customer_id,
            'price' => $product->price,
            'quantity' => $product->quantity,
        ];

        // Save the data to the database using CodeIgniter 4 Query Builder
        $db->table('purchase_product')->insert($data);
    }

    // Return a response if needed
    return $this->response->setJSON(['status' => 'Data saved successfully']);
}

private function getOrderID($transactionNo)
{
    // Replace 'your_table_name' with the actual table name where you store the mapping
    $db = \Config\Database::connect();
    $builder = $db->table('purchase_product');

    $result = $builder
        ->select('orderID')
        ->where('transaction_no', $transactionNo)
        ->get();

    $row = $result->getRow();

    return $row ? $row->orderID : null;
}

private function saveOrderID($transactionNo, $orderID)
{
    // Replace 'your_table_name' with the actual table name where you store the mapping
    $db = \Config\Database::connect();
    $builder = $db->table('purchase_product');

    $data = [
        'transaction_no' => $transactionNo,
        'orderID' => $orderID,
    ];

    $builder->insert($data);
}
}