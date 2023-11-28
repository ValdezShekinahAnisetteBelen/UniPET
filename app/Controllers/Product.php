<?php
namespace App\Controllers;

use App\Models\AppointmentModel;
use CodeIgniter\RestFul\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;
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
            $image = $this->request->getVar('image');
            $productgroup = $this->request->getVar('productgroup');
            $status = $this->request->getVar('status');
        
            // Update the product in the database based on the $orderId
            $modelName = new ProductModel();
            $data = [
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'stock' => $stock,
                'image' => $image,
                'productgroup' => $productgroup,
                'status' => $status,
            ];
    
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
