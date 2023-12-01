<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Request;
use CodeIgniter\RestFul\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CartModel;

class CartController extends ResourceController
{
    // In your CartController.php

    public function addToCart()
    {
        try {
            $name = $this->request->getVar('name');
            $price = $this->request->getVar('price');
            $image = $this->request->getVar('image');
            $product_id = $this->request->getVar('product_id');
            $productgroup = $this->request->getVar('productgroup');
            $customer_id = $this->request->getVar('customer_id');

            // Check if the product already exists in the cart for the customer
            $cartModel = new \App\Models\CartModel(); // Adjust the namespace based on your actual model location
            $existingCartItem = $cartModel->where([
                'product_id' => $product_id,
                'customer_id' => $customer_id,
            ])->first();

            if ($existingCartItem) {
                // Update the quantity if the product already exists
                $existingCartItem->quantity += 1;
                $cartModel->update($existingCartItem->id, $existingCartItem);
            } else {
                // Insert a new item into the cart if it doesn't exist
                $cartModel->insert([
                    'product_id' => $product_id,
                    'name' => $name,
                    'price' => $price,
                    'image' => $image,
                    'productgroup' => $productgroup,
                    'customer_id' => $customer_id,
                ]);
            }

            return $this->respond(['message' => 'Product added to the cart'], 200);
        } catch (\Exception $e) {
            return $this->failServerError('Error adding to the cart: ' . $e->getMessage());
        }
    }

    public function getCartByCustomerId($customer_id)
    {
        try {
            // Retrieve the cart items for the specified customer_id
            $cartModel = new \App\Models\CartModel(); // Adjust the namespace based on your actual model location
            $cartItems = $cartModel->where('customer_id', $customer_id)->findAll();

            return $this->respond(['cartItems' => $cartItems], 200);
        } catch (\Exception $e) {
            return $this->failServerError('Error fetching cart data: ' . $e->getMessage());
        }
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
    public function del($id)
    {
        $model = new CartModel();
    
        try {
            // Use the 'delete' method to delete a single record based on the provided ID
            $model->delete($id);
    
            return $this->respond(['status' => 200, 'id' => $id], 200);
        } catch (\Exception $e) {
            return $this->respond(['status' => 500, 'error' => 'Error deleting record: ' . $e->getMessage()], 500);
        }
    }
    

    

}
