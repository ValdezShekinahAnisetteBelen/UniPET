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
    

    public function getOrders()
    {
        $transactionNo = new OrderHModel();
        $orders = $transactionNo->findAll();

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
