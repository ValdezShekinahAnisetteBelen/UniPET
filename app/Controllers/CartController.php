<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Request;
use CodeIgniter\RestFul\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CartModel;

class CartController extends ResourceController
{
    public function addToCart()
    {
        // Retrieve the product details and customer_id from the request.
        
        $name = $this->request->getVar('name');
        $price = $this->request->getVar('price');
        $image = $this->request->getVar('image');
        $productgroup = $this->request->getVar('productgroup');
        $customer_id = $this->request->getVar('customer_id');
    
        // Save the product details to the cart using a model.
        $cartModel = new CartModel();
        $cartModel->insert([
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'productgroup' => $productgroup,
            'customer_id' => $customer_id,
        ]);
    
        // Return a response to the front-end (e.g., success message).
        return $this->response->setJSON(['message' => 'Product added to the cart']);
    }
    
    

    public function del($id) 
    {
        try {
            // Ensure $id is a valid integer
            if (!is_numeric($id) || $id <= 0) {
                return $this->respond(['error' => 'Invalid ID provided'], 400);
            }
    
            $cartModel = new CartModel();
    
            // Check if the record exists before deleting
            $record = $cartModel->find($id);
            if (!$record) {
                return $this->respond(['error' => 'Record not found'], 404);
            }
    
            // Log the deletion attempt with record details
            log_message('cart', 'Deleting record with ID ' . $id . ': ' . json_encode($record));
    
            // Perform the deletion
            $cartModel->delete($id);
    
            return $this->respond(['message' => 'Record deleted successfully', 'deletedId' => $id], 200);
        } catch (\Exception $e) {
            // Log the error with details
            log_message('error', 'Error deleting record with ID ' . $id . ': ' . $e->getMessage());
    
            // Return an error response
            return $this->respond(['error' => 'Failed to delete record'], 500);
        }
    }
    
    
    

    

}
