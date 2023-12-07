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

    public function setsales($orderID)
{
    $orderModel = new OrderHModel();
    $productModel = new ProductModel();
    $auditModel = new AuditModel();

    // Fetch products associated with the order
    $orderDetails = $orderModel->where('orderID', $orderID)->findAll();

    foreach ($orderDetails as $orderDetail) {
        $productID = $orderDetail['product_id'];
        $quantity = $orderDetail['quantity'];

        // Fetch product details
        $product = $productModel->where('id', $productID)->first();

        // Ensure stock is not negative
        $updatedQuantity = max(0, $product['stock'] - $quantity);

        // Update product quantity
        $productModel->set('stock', $updatedQuantity)->where('id', $productID)->update();

        // Log the transaction in the audit table
        $auditData = [
            'product_id' => $productID,
            'oldQuantity' => $product['stock'],
            'stock' => $quantity,
            'type' => 'sales'
        ];
        $auditModel->save($auditData);
    }

    // Update order status to 'transacted'
    $orderModel->set('status', 'sales')->where('orderID', $orderID)->update();
}

    public function audit($upc)
    {
        $audit = new AuditModel();
        $data = $audit
            ->select('products.upc as upc, products.name as name, products.description as description, audit.oldQuantity as oldQuantity, audit.stock as stock, audit.type as type')
            ->join('products', 'audit.product_id = products.id', 'left')
            ->where('products.upc', $upc)
            ->findAll();
    
        return $this->respond($data, 200);
    }
    

    public function updateQuantity()
    {
      $upc = $this->request->getVar('upc');
      $stock = $this->request->getVar('stock');
      $product = new ProductModel();
      $audit = new AuditModel();
      $pr = $product->where('upc', $upc)->first();
      if($pr){
        $nq = $pr['stock'] + $stock;
        $product->set('stock', $nq)->where('upc', $upc)->update();
        $data = [
          'product_id' =>$pr['id'],
          'oldQuantity' =>$pr['stock'],
          'stock' => $stock,
          'type' => 'inbound'
        ];
        $audit->save($data);
      }

    }

    // Inside your controller, add a method to mark the order as transacted
    public function markAsTransacted($orderID)
    {
        $purchase_product = new OrderHModel();
    
        // Update the status to 'transacted' for all 'added' entries with the given orderID
        $purchase_product->set('status', 'transacted')->where('orderID', $orderID)->where('status', 'added')->update();
    
        // Return a success response
        return $this->respond(['success' => true, 'orderID' => $orderID], 200);
    }
    
    

    public function isales()
    {
        try {
            $upc = $this->request->getVar('upc');
            $qty = $this->request->getVar('quantity');
            $orderID = $this->request->getVar('orderID');
            $product = new ProductModel();
            $purchase_product = new OrderHModel();
            $auditModel = new AuditModel();
    
            // Check if orderID is received
            if (!$orderID) {
                // If not received, generate a new orderID
                $orderID = 'ORD' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            }
    
            // Find product by UPC
            $pr = $product->where('upc', $upc)->first();
    
            if ($pr) {
                // Check if the order with the given orderID is already transacted
                $lastOrder = $purchase_product->where('orderID', $orderID)->orderBy('id', 'desc')->first();
    
                if ($lastOrder && $lastOrder['status'] === 'transacted') {
                    // If the last order is transacted, generate a new orderID
                    $orderID = 'ORD' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
                }
    
                // Ensure there's enough stock for the sale
                if ($pr['stock'] >= $qty) {
                    // Start a transaction
                    $db = \Config\Database::connect();
                    $db->transStart();
    
                    // Prepare data for insertion into purchase_product table
                    $data = [
                        'orderID' => $orderID,
                        'product_id' => $pr['id'],
                        'price' => $pr['price'],
                        'quantity' => $qty,
                        'status' => 'added'
                    ];
    
                    // Insert data into the purchase_product table
                    $purchase_product->insert($data);
    
                    // Subtract sold quantity from the current stock
                    $updatedStock = max(0, $pr['stock'] - $qty);
    
                    // Update product stock
                    $product->set('stock', $updatedStock)->where('id', $pr['id'])->update();
    
                    // Prepare data for insertion into audit table
                    $auditData = [
                        'product_id' => $pr['id'],
                        'oldQuantity' => $pr['stock'],
                        'stock' => $qty,
                        'type' => 'sales'
                    ];
    
                    // Insert data into the audit table
                    $auditModel->save($auditData);
    
                    // Commit the transaction
                    $db->transComplete();
    
                    // Check if the transaction was successful
                    if ($db->transStatus() === false) {
                        // If not, throw an exception
                        throw new \Exception('Transaction failed.');
                    }
    
                    // Return the response
                    return $this->respond(['success' => true, 'message' => 'added'], 200);
                } else {
                    // Not enough stock for the sale
                    $message = "Not enough stock for the sale";
    
                    // Return the response
                    return $this->respond(['success' => false, 'message' => $message], 200);
                }
            }
        } catch (\Exception $e) {
            // Handle exceptions
            return $this->respond(['success' => false, 'message' => $e->getMessage()], 500);
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
