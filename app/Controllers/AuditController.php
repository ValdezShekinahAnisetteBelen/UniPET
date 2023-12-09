<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\AuditModel;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class AuditController extends ResourceController
{
    use ResponseTrait;
    public function index()
    {
        //
    }
    public function generateReport()
    {
        // Fetch data from the database using your model
        $auditModel = new AuditModel();
        $data = $auditModel->select('type, 
            SUM(CASE WHEN type = "walk_in_sales" THEN audit.stock * products.price ELSE 0 END) AS walk_in_sales_total_price, 
            SUM(CASE WHEN type = "online-sales" THEN audit.stock * products.price ELSE 0 END) AS online_sales_total_price, 
            SUM(CASE WHEN type = "walk_in_sales" THEN 1 ELSE 0 END) AS walk_in_sales_items, 
            SUM(CASE WHEN type = "online-sales" THEN 1 ELSE 0 END) AS online_sales_items')
            ->join('products', 'audit.product_id = products.id')
            ->groupBy('type')
            ->findAll();
    
        // Set the response headers for downloading the CSV file
        $this->response->setHeader('Content-Type', 'text/csv');
        $this->response->setHeader('Content-Disposition', 'attachment;filename="report.csv"');
        $this->response->setHeader('Cache-Control', 'max-age=0');
    
        // Open a PHP output stream to write CSV data
        $output = fopen('php://output', 'w');
    
        // Write headers to the CSV file
        fputcsv($output, ['Type', 'Walk-in Sales Total Price', 'Online Sales Total Price', 'Walk-in Sales Items', 'Online Sales Items']);
    
        // Write data to the CSV file
        foreach ($data as $row_data) {
            fputcsv($output, [
                $row_data['type'],
                $row_data['walk_in_sales_total_price'],
                $row_data['online_sales_total_price'],
                $row_data['walk_in_sales_items'],
                $row_data['online_sales_items']
            ]);
        }
    
        // Close the output stream
        fclose($output);
    
        // End the response
        return $this->response->setStatusCode(200);
    }
    
    public function audit1()
    {
        $auditModel = new AuditModel();
        $data = $auditModel->findAll(); // Fetch all data from the 'audit' table

        return $this->respond($data); // Respond with the fetched data
    }
}
