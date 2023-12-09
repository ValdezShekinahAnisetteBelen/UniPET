<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\OrderHModel;
use App\Models\PurchaseModel;
use App\Models\TransactionModel;
use App\Models\AuditModel;

class OrderHistoryController extends BaseController
{
    public function editStatus()
    {
        // Receive the updated status and order ID from the frontend
        $status = $this->request->getVar('status');
        $orderId = $this->request->getVar('orderId');
    
        // Update the status in the database
        $orderModel = new OrderHModel();
        $orderModel->update($orderId, ['status' => $status]);
    
        // Return a success response
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Status updated successfully',
            'data' => [
                'orderId' => $orderId,
                'newStatus' => $status,
            ],
        ]);
    }
    
    public function getOrders2()
    {
        $transactionNoModel = new OrderHModel();
    
        // Add your filters here
        $orders = $transactionNoModel
            ->whereIn('status', ['added', 'transacted'])
            ->findAll();
    
        return $this->response->setJSON($orders);
    }
    
    
    public function getOrders()
    {
        $transactionNoModel = new OrderHModel();
    
        // Add your filters here
        $orders = $transactionNoModel
            ->where('status !=', 'added')
            ->where('product_id IS NOT NULL')
            ->where('customer_id IS NOT NULL')
            ->where('transaction_no IS NOT NULL')
            ->findAll();
    
        return $this->response->setJSON($orders);
    }
    

    public function getBestSellingProductsByYear(string $year)
    {
        $transactionNo = new OrderHModel();
        $data = $transactionNo->getBestSellingProductsByYear($year);
    
        // Check if data is not empty before including it in the response
        if (!empty($data)) {
            return $this->response->setJSON(['year' => $year, 'data' => $data]);
        } else {
            return $this->response->setJSON(['status' => 'No data found']);
        }
    }
    public function index()
    {
        //
    }
       public function delete($customer_id)
    {
        
        try {
            $purchaseModel = new PurchaseModel();

            // Delete all records for the specific customer_id
            $purchaseModel->where('customer_id', $customer_id)->delete();

            // Optionally, you can return a response to indicate success
            return $this->response->setJSON(['message' => 'Records deleted successfully']);
        } catch (\Exception $e) {
            // Handle any exceptions that might occur during deletion
            return $this->response->setJSON(['error' => $e->getMessage()])->setStatusCode(500);
        }
    }

    public function getOrderIds($customerId)
    {
        // Validate $customerId if needed
    
        $orderModel = new OrderHModel();
    
        // Fetch order IDs based on customer ID using Query Builder
        $orderIds = $orderModel->select('orderID')
            ->distinct()
            ->where('customer_id', $customerId)
            ->get()
            ->getResultArray();
    
        return $this->response->setStatusCode(200)->setJSON(['order_ids' => $orderIds]);
    }
    
    public function getCustomerDetails($orderID)
    {
        $orderModel = new OrderHModel();
        $customerDetails = $orderModel->find($orderID);

        return $this->response->setJSON($customerDetails);
    }

    public function getOrderDetails($orderID)
    {
        $orderModel = new OrderHModel();
    
        // Fetch common order details by joining the tables
        $commonOrderDetails = $orderModel
            ->select('transactions.address, transactions.total_price, purchase_product.status, transactions.delivering_to, transactions.additional_details, transactions.driver_instructions, transactions.mobile_contact_number, transactions.change_for_how_much, transactions.payment_method, transactions.total_price')
            ->join('transactions', 'purchase_product.transaction_no = transactions.transaction_no')
            ->where('purchase_product.orderID', $orderID)
            ->first(); // Use first to get only one row
    
        // Check if the common order details are found
        if ($commonOrderDetails) {
            // Fetch individual items in the order
            $orderItems = $orderModel
                ->select('purchase_product.*, purchase_product.price, products.name, products.productgroup, products.image')
                ->join('products', 'purchase_product.product_id = products.id', 'left')
                ->where('purchase_product.orderID', $orderID)
                ->findAll(); // Use findAll to get all rows
    
            // Filter out null values and "Processing" status for each item
            $filteredItems = array_map(function ($item) use ($orderID) {
                // Check if certain fields are NULL and status is "Processing"
                if (
                    $item['product_id'] === null &&
                    $item['customer_id'] === null &&
                    $item['price'] === null &&
                    $item['quantity'] === null &&
                    $item['status'] === 'Processing'
                ) {
                    // Fetch the status from another order with the same orderID that has no NULL values
                    $otherOrderStatus = $this->getOtherOrderStatus($orderID);
                    return ['status' => $otherOrderStatus];
                }
    
                // Filter out null values for each item
                return array_filter($item, function ($value) {
                    return $value !== null;
                }) + ['status' => $item['status']];
            }, $orderItems);
    
            // Attach the array of items to common details
            $commonOrderDetails['items'] = $filteredItems;
    
            // Remove null values from the response
            $commonOrderDetails = array_filter($commonOrderDetails, function ($value) {
                return $value !== null;
            });
    
            return $this->response->setJSON($commonOrderDetails);
        } else {
            // Handle the case where the order details are not found
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Order not found']);
        }
    }
    
    public function getOrderDetails2($orderID)
    {
        $orderModel = new OrderHModel();
    
        // Fetch common order details by joining the tables
        $commonOrderDetails = $orderModel
            ->select('transactions.address, transactions.delivering_to, transactions.additional_details, transactions.driver_instructions, transactions.mobile_contact_number, transactions.change_for_how_much')
            ->join('transactions', 'purchase_product.transaction_no = transactions.transaction_no')
            ->where('purchase_product.orderID', $orderID)
            ->first(); // Use first to get only one row
    
        // Check if the common order details are found
        if ($commonOrderDetails) {
            // Fetch individual items in the order
            $orderItems = $orderModel
                ->select('purchase_product.quantity, products.name')
                ->join('products', 'purchase_product.product_id = products.id', 'left')
                ->where('purchase_product.orderID', $orderID)
                ->findAll(); // Use findAll to get all rows
    
            // Filter out null values and "Processing" status for each item
            $filteredItems = array_map(function ($item) use ($orderID) {
                // Check if certain fields are NULL and status is "Processing"
                if (
                    $item['quantity'] === null ||
                    $item['name'] === null
                ) {
                    return null;
                }
    
                return ['quantity' => $item['quantity'], 'name' => $item['name']];
            }, $orderItems);
    
            // Remove null values from the filtered items
            $filteredItems = array_filter($filteredItems);
    
            // Attach the array of items to common details
            $commonOrderDetails['items'] = $filteredItems;
    
            // Add additional text
            $additionalText = [
                'header' => 'NVP Animal Clinic (DR. NIEL V. PALINGUABA) @ Tawiran, Calapan City',
                'cash_on_hand' => 'Cash on hand: ' . $commonOrderDetails['change_for_how_much']
            ];
    
            // Remove change_for_how_much from commonOrderDetails
            unset($commonOrderDetails['change_for_how_much']);
    
            // Merge additional text with common order details
            $responseArray = array_merge($additionalText, $commonOrderDetails);
    
            return $this->response->setJSON($responseArray);
        } else {
            // Handle the case where the order details are not found
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Order not found']);
        }
    }
    
    // Function to get the status from another order with the same orderID that has no NULL values
    private function getOtherOrderStatus($orderID)
    {
        $orderModel = new OrderHModel();
    
        $otherOrder = $orderModel
            ->select('purchase_product.status')
            ->where('purchase_product.orderID', $orderID)
            ->where('purchase_product.product_id IS NOT NULL')
            ->where('purchase_product.customer_id IS NOT NULL')
            ->where('purchase_product.price IS NOT NULL')
            ->where('purchase_product.quantity IS NOT NULL')
            ->where('purchase_product.status !=', 'Processing')
            ->first(); // Use first to get only one row
    
        return $otherOrder ? $otherOrder['status'] : 'Processed';
    }
    

    public function saveOrder()
    {
        // Retrieve JSON data from the request
        $json = $this->request->getJSON();
    
        // Extract the selected values from the request
        $orderID = $this->request->getVar('orderID');
        $transactionNo = $json->transactions->transaction_no;
        $products = $json->products;
    
        // Check if orderID is received
        if (!$orderID) {
            // Check if an orderID is already generated for this transaction_no
            $orderID = $this->getOrderID($transactionNo);
    
            if (!$orderID) {
                // If not exists, generate a new orderID
                $orderID = 'ORD' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    
                // Save the generated orderID for the transaction_no in the database
                $this->saveOrderID($transactionNo, $orderID);
            }
        }
    
        // Load the database using the new Database service outside of the loop
        $db = \Config\Database::connect();
    
        // Loop through each product and save it to the database
        foreach ($products as $product) {
            // Check if all specified columns are NULL
            if ($product->product_id === null && $product->customer_id === null && $product->price === null && $product->quantity === null) {
                // Skip insertion if all columns are NULL
                continue;
            }
    
            // Find product by ID
            $productModel = new \App\Models\ProductModel(); // Correct instantiation
            $pr = $productModel->find($product->product_id);
    
            if (!$pr) {
                // Handle the case where the product is not found
                continue;
            }
    
            // Save the old quantity before updating
            $oldQuantity = $pr['stock'];
    
            // Update product stock
            $updatedStock = max(0, $oldQuantity - $product->quantity);
            $productModel->set('stock', $updatedStock)->where('id', $pr['id'])->update();
    
            // Create an associative array with the extracted values
            $data = [
                'transaction_no' => $transactionNo,
                'product_id' => $product->product_id,
                'orderID' => $orderID, // Use the same orderID for each product in the loop
                'customer_id' => $product->customer_id,
                'price' => $product->price,
                'quantity' => $product->quantity,
            ];
    
            // Save the data to the database using CodeIgniter 4 Query Builder
            $db->table('purchase_product')->insert($data);
    
            // Prepare data for insertion into audit table
            $auditData = [
                'product_id' => $product->product_id,
                'oldQuantity' => $oldQuantity,
                'stock' => $product->quantity,
                'type' => 'online-sales',
            ];
    
            // Insert data into the audit table
            $this->saveAuditData($auditData);
        }
    
        // Return a response if needed
        return $this->response->setJSON(['status' => 'Data saved successfully']);
    }
    
    // Function to save audit data
    private function saveAuditData($auditData)
    {
        $auditModel = new \App\Models\AuditModel(); // Correct instantiation
        $auditModel->save($auditData);
    }

    

private function getOrderID($transactionNo)
{
    // Replace 'your_table_name' with the actual table name where you store the mapping
    $db = \Config\Database::connect();
    $builder = $db->table('purchase_product');

    $result = $builder
        ->select('orderID')
        ->where('transaction_no', $transactionNo)
        ->get();

    $row = $result->getRow();

    return $row ? $row->orderID : null;
}

private function saveOrderID($transactionNo, $orderID)
{
    // Replace 'your_table_name' with the actual table name where you store the mapping
    $db = \Config\Database::connect();
    $builder = $db->table('purchase_product');

    $data = [
        'transaction_no' => $transactionNo,
        'orderID' => $orderID,
    ];

    $builder->insert($data);
}
}