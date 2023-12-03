<?php
namespace App\Controllers;

use App\Models\AppointmentModel;
use CodeIgniter\RestFul\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;
use App\Models\OrderHModel;
use App\Models\AuditModel;

class Product extends ResourceController
{
    protected $modelName = 'App\Models\ProductModel';
    protected $format    = 'json';

    public function getProductDetails2($productId)
    {
        $modelName = new ProductModel();
        $productDetails = $modelName->find($productId);

        return $this->response->setJSON($productDetails);
    }

    public function getSales($id)
    {
      $purchase_product = new OrderHModel();
      $data = $purchase_product->select('name as name, purchase_product.price as price, purchase_product.quantity as quantity')->join('products', 'purchase_product.product_id=products.id')->where('orderID', $id)->findAll();
      return $this->respond($data, 200);
    }
    public function getProducts()
    {
      $product  = new ProductModel();
      $data = $product->findAll();
      return   $this->respond($data, 200);
    }

    public function setsales($id)
    {
      $purchase_product =new OrderHModel();
      $product  = new ProductModel();
      $audit = new AuditModel();
    //   $purchase_product->set('status', 'transacted')->where('orderID', $id)->update();
      $d = $purchase_product->where('orderID', $id)->findAll();

      foreach ($d as $v) {
        $pid = $v['product_id'];
        $quantity = $v['quantity'];
        $h = $product->where('id', $pid)->first();
        $sets = [
          'quantity' => $h['quantity'] - $quantity
        ];
        $data = [
          'product_id' => $pid,
          'oldQuantity' => $h['quantity'],
          'quantity' => $quantity,
          'type' =>'purchase_product'
        ];
        $product->set($sets)->where('id', $pid)->update();
        $audit->save($data);
      }
      $purchase_product->set('status', 'transacted')->where('orderID', $id)->update();
    }

    public function audit($id)
    {
      $audit = new AuditModel();
      $data = $audit->select('products.upc as upc, products.name as name, products.description as description, audit.oldQuantity as oldQuantity, audit.quantity as quantity, audit.type as type')->join('products', 'audit.product_id=products.id')->where('products.upc', $id)->findAll();
      return $this->respond($data,200);
    }

    public function updateQuantity()
    {
      $upc = $this->request->getVar('upc');
      $quantity = $this->request->getVar('quantity');
      $product = new ProductModel();
      $audit = new AuditModel();
      $pr = $product->where('upc', $upc)->first();
      if($pr){
        $nq = $pr['quantity'] + $quantity;
        $product->set('quantity', $nq)->where('upc', $upc)->update();
        $data = [
          'productID' =>$pr['id'],
          'oldQuantity' =>$pr['quantity'],
          'quantity' => $quantity,
          'type' => 'inbound'
        ];
        $audit->save($data);
      }

    }

    public function isales()
{
    $upc = $this->request->getVar('upc');
    $qty = $this->request->getVar('quantity');
    $orderID = $this->request->getVar('orderID');
    $product = new ProductModel();
    $purchase_product = new OrderHModel();

    // Check if orderID is received
    if (!$orderID) {
        // If not received, generate a new orderID
        $orderID = 'ORD' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    }

    // Find product by UPC
    $pr = $product->where('upc', $upc)->first();

    if ($pr) {
        // Prepare data for insertion
        $data = [
            'orderID' => $orderID,
            'product_id' => $pr['id'],
            'price' => $pr['price'],
            'quantity' => $qty,
            'status' => 'added'
        ];

        // Insert data into the database
        $d = $purchase_product->insert($data);

        if ($d) {
            // Insertion successful
            $message = "added";

            // Update the status to "transacted" after successful sales transaction
            $purchase_product->set('status', 'transacted')->where('orderID', $orderID)->update();
        } else {
            // Insertion failed
            $message = "Failed to add";
        }

        // Return the response
        return $this->respond($message, 200);
    }
}

    
    public function saveProduct()
    {
        // Get the uploaded image file from the request
        $imageFile = $this->request->getFile('image');
    
        // Check if an image file was uploaded
        if ($imageFile && $imageFile->isValid()) {
            // Get the original filename
            $imageName = $imageFile->getClientName();
    
            // Move the uploaded image file to a designated folder
            $imageFile->move(ROOTPATH . 'public/uploads', $imageName);
    
            // Set the image field in the data array to the uploaded image filename with "User/images/"
            $data['image'] = 'User/images/' . $imageName;
        }
    
        // Get the rest of the data from the request
        $data['name'] = $this->request->getPost('name');
        $data['description'] = $this->request->getPost('description');
        $data['price'] = $this->request->getPost('price');
        $data['stock'] = $this->request->getPost('stock');
        $data['productgroup'] = $this->request->getPost('productgroup');
        $data['status'] = $this->request->getPost('status');
    
        // Validate input data if needed
    
        // Save the product to the database
        $result = $this->model->insert($data);
    
        if ($result) {
            return $this->respond(['status' => 'success', 'message' => 'Product saved successfully'], 200);
        } else {
            return $this->failServerError('Failed to save product');
        }
    }
    
    // public function editStatus2()
    // {
    //     $orderId = $this->request->getPost('orderId');
    //     // Get the rest of the fields from the request
    //     $name = $this->request->getPost('name');
    //     $description = $this->request->getPost('description');
    //     $price = $this->request->getPost('price');
    //     $stock = $this->request->getPost('stock');
    //     $image = $this->request->getPost('image');
    //     $productgroup = $this->request->getPost('productgroup');
    //     $status = $this->request->getPost('status');
    
    //     // Update the product in the database based on the $orderId
    //     $productModel = new ProductModel();
    //     $data = [
    //         'name' => $name,
    //         'description' => $description,
    //         'price' => $price,
    //         'stock' => $stock,
    //         'image' => $image,
    //         'productgroup' => $productgroup,
    //         'status' => $status,
    //     ];
    
    //     // Perform the update
    //     $productModel->update($orderId, $data);
    
    //     // Send a response indicating success
    //     return $this->response
    //         ->setStatusCode(200)
    //         ->setJSON([
    //             'success' => true,
    //             'message' => 'Product updated successfully',
    //         ]);
    // }
    
    
 
            public function editStatus2()
    {
        try {
            $orderId = $this->request->getVar('orderId');
            $name = $this->request->getVar('name');
            $description = $this->request->getVar('description');
            $price = $this->request->getVar('price');
            $stock = $this->request->getVar('stock');
            $productgroup = $this->request->getVar('productgroup');
            $status = $this->request->getVar('status');
            
            // Get the existing image filename from the database
            $modelName = new ProductModel();
            $existingProduct = $modelName->find($orderId);
            $existingImage = $existingProduct['image'];

            // Check if a new image file was uploaded
            $imageName = $this->request->getVar('image');
            if ($imageName) {
                // Update the image field in the data array to the new uploaded image filename
                $data['image'] = $imageName;

                // Delete the old image file
                if ($existingImage && file_exists(ROOTPATH . 'public/uploads/' . $existingImage)) {
                    unlink(ROOTPATH . 'public/uploads/' . $existingImage);
                }
            } else {
                // No new image filename provided, keep the existing image filename
                $data['image'] = $existingImage;
            }

            // Update the other fields in the data array
            $data['name'] = $name;
            $data['description'] = $description;
            $data['price'] = $price;
            $data['stock'] = $stock;
            $data['productgroup'] = $productgroup;
            $data['status'] = $status;

            // Update the product in the database based on the $orderId
            $modelName->update($orderId, $data);

            // Send a response indicating success
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Product updated successfully',
            ]);
        } catch (\Exception $e) {
            // Log the exception or print the error message for debugging
            error_log($e->getMessage());

            // Send a response indicating failure
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Internal Server Error',
            ]);
        }
    }

    // Helper function to get the request
    private function getRequest()
    {
        return service('request');
    }

    public function index()
    {

    }

    public function getData()
    {
        $main = new ProductModel();
        $data = $main->findAll();
        return $this->respond($data, 200);
    }

    public function getProductDetails($productName)
    {
        $product = $this->model->where('name', urldecode($productName))->first();

        if(!$product){
            return $this->failNotFound('No product found');
        }

        return $this->respond($product);
    }

//     use ResponseTrait;

//     public function create()
//     {
//         $json = $this->request->getJSON();

//         $data = [
//             'name' => $json->name,
//             'description' => $json->description,
//             'price' => $json->price,
//             'stock' => $json->stock,
//             'image' => $json->image,
//             'productgroup' => $json->productgroup,
//         ];

//         $model = new ProductModel();
//         $product = $model->insert($data);

//         if (!$product) {
//             return $this->fail('Failed to Save', 400);
//         }

//         return $this->respondCreated($product);
//     }
// public function index()
// {
//     $model = new ProductModel();
//     $data = $model->findAll();
//     if(!$data) return $this->failNotFound('No Data Found');
//     return $this->respond($data);
//     echo view('frontend');
// }

// public function show($id = null)
// {
//     $model = new ProductModel();
//     $data = $model->find(['id' => $id]);
//     if(!$data) return $this->failNotFound('No Data Found');
//     return $this->respond($data[0]);
//     }
  
//     public function update($id = null)
//     {
//         $json = $this->request->getJSON();
//         $data = [
//             'name' => $json->name,
//             'description' => $json->description,
//             'price' => $json->price,
//             'stock' => $json->stock,
//             'image' => $json->image,
//             'productgroup' => $json->productgroup, 
//         ];
    
//         $model = new ProductModel();
//         $findById = $model->find($id);
    
//         if (!$findById) {
//             return $this->fail('No Data Found', 404);
//         }
    
//         $product = $model->update($id, $data);
    
//         if (!$product) {
//             return $this->fail('Update failed', 400);
//         }
    
//         return $this->respond($product);
//     }
    

// public function delete($id = null)
// {
//     $model = new ProductModel();
//     $findById = $model->find(['id' => $id]);
//     if(!$findById) return $this->fail('No Data Found', 404);
//     $product = $model->delete($id);
//     if(!$product) return $this->fail('Failed Deleted', 400);
//     return $this->respondDeleted('Deleted Successful');
// }
}
