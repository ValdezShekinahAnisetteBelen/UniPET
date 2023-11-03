<?php

namespace App\Controllers;

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\Request;
use App\Models\CartModel;

class CartController extends Controller
{
    public function del(Request $request) // Pass the Request object as a parameter
    {
        // Use the Request object to get the JSON data
        $json = $request->getJSON();
        $id = $json->id;
        $cartModel = new CartModel();

        // Check if the item exists before attempting to delete it.
        $item = $cartModel->find($id);
        if ($item) {
            $cartModel->delete($id);
            return $this->respond(['message' => 'Item deleted successfully'], 200);
        } else {
            return $this->respond(['error' => 'Item not found'], 404);
        }
    }
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
}
