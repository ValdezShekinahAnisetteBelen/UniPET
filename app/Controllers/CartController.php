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
        $product_id = $this->request->getVar('product_id');
        $productgroup = $this->request->getVar('productgroup');
        $customer_id = $this->request->getVar('customer_id');
    
        // Save the product details to the cart using a model.
        $cartModel = new CartModel();
        $cartModel->insert([
            'product_id' => $product_id,
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'productgroup' => $productgroup,
            'customer_id' => $customer_id,
        ]);
    
        // Return a response to the front-end (e.g., success message).
        return $this->response->setJSON(['message' => 'Product added to the cart']);
    }
    
    public function updateItem($id)
    {
        // Retrieve the new quantity and price from the request.
        $quantity = $this->request->getVar('quantity');
        $price = $this->request->getVar('price');

        // Save the updated quantity and price to the cart using the model.
        $cartModel = new \App\Models\CartModel(); // Adjust namespace if needed
        $cartItem = $cartModel->find($id);

        if (!$cartItem) {
            return $this->fail('Cart item not found', 404);
        }

        $cartModel->update($id, [
            'quantity' => $quantity,
            'price' => $price,
        ]);

        // Return a JSON response to the front-end (e.g., success message).
        return $this->respond(['message' => 'Cart item updated successfully']);
    }


    public function del($id) {
        $model = new CartModel();
        $product = $model->where('id', $id)->delete();
    
        if ($product) {
          return $this->respondDeleted($product);
        } else {
          return $this->failNotFound('No product found for id ' . $id);
        }
    }

    
    

    

}
