<?php

namespace App\Controllers;

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\Request;
use App\Models\CartModel;

class CartController extends Controller
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
}
