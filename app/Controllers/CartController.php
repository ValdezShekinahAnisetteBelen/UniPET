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
        // Retrieve the product details from the request.
        $name = $this->request->getVar('name');
        $price = $this->request->getVar('price');
        $image = $this->request->getVar('image');
        $productgroup = $this->request->getVar('productgroup');

        // Save the product details to the cart using a model.
        $cartModel = new CartModel();
        $cartModel->insert([
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'productgroup' => $productgroup,
        ]);

        // Return a response to the front-end (e.g., success message).
        return $this->response->setJSON(['message' => 'Product added to the cart']);
    }

    public function deleteCartItem()
    {
        // Retrieve the item ID from the request
        $itemId = $this->request->getVar('id');
    
        // Delete the item from the database using the ID
        $cartModel = new CartModel();
        $cartModel->where('id', $itemId)->delete();
    
        // Return a response, e.g., success message
        return $this->response->setJSON(['message' => 'Item deleted successfully']);
    }
    

}
