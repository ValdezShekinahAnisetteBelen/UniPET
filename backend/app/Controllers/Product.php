<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;
class Product extends ResourceController
{
    use ResponseTrait;

    public function create()
    {
        $json = $this->request->getJSON();

        $data = [
            'name' => $json->name,
            'description' => $json->description,
            'price' => $json->price,
            'stock' => $json->stock,
            'image' => $json->image,
            'productgroup' => $json->productgroup,
        ];

        $model = new ProductModel();
        $product = $model->insert($data);

        if (!$product) {
            return $this->fail('Failed to Save', 400);
        }

        return $this->respondCreated($product);
    }
public function index()
{
    $model = new ProductModel();
    $data = $model->findAll();
    if(!$data) return $this->failNotFound('No Data Found');
    return $this->respond($data);
    echo view('frontend');
}

public function show($id = null)
{
    $model = new ProductModel();
    $data = $model->find(['id' => $id]);
    if(!$data) return $this->failNotFound('No Data Found');
    return $this->respond($data[0]);
    }
  
    public function update($id = null)
    {
        $json = $this->request->getJSON();
        $data = [
            'name' => $json->name,
            'description' => $json->description,
            'price' => $json->price,
            'stock' => $json->stock,
            'image' => $json->image,
            'productgroup' => $json->productgroup, 
        ];
    
        $model = new ProductModel();
        $findById = $model->find($id);
    
        if (!$findById) {
            return $this->fail('No Data Found', 404);
        }
    
        $product = $model->update($id, $data);
    
        if (!$product) {
            return $this->fail('Update failed', 400);
        }
    
        return $this->respond($product);
    }
    

public function delete($id = null)
{
    $model = new ProductModel();
    $findById = $model->find(['id' => $id]);
    if(!$findById) return $this->fail('No Data Found', 404);
    $product = $model->delete($id);
    if(!$product) return $this->fail('Failed Deleted', 400);
    return $this->respondDeleted('Deleted Successful');
}
}
