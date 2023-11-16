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
    
    

    public function deleteCartItem($id)
    {
        
        // Retrieve the item ID from the route parameter
        $itemId = $id;
    
        // Log the received ID for debugging
        log_message('info', 'Item ID received: ' . $itemId);
    
        // Delete the item from the database using the ID
        $cartModel = new CartModel();
        $deleted = $cartModel->where('id', $itemId)->delete();
    
        // Log the success or failure of the delete operation
        if ($deleted) {
            log_message('info', 'Item deleted successfully');
        } else {
            log_message('error', 'Failed to delete item');
        }


        
    
        // Return a response, e.g., success message
        return $this->response->setJSON(['message' => $deleted ? 'Item deleted successfully' : 'Failed to delete item']);
    }
    

}
