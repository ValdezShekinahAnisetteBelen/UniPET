<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use App\Models\PurchaseModel;
use App\Models\TransactionModel;

class OrderController extends Controller
{
    use ResponseTrait;

    protected $purchaseModel;
    protected $transactionModel;

    public function __construct(PurchaseModel $purchaseModel, TransactionModel $transactionModel)
    {
        $this->purchaseModel = $purchaseModel;
        $this->transactionModel = $transactionModel;
    }

    public function cancelOrder($customer_id, $transaction_no)
    {
        try {
            // Create an instance of PurchaseController
            $purchaseController = new PurchaseController();

            // Call the delete method in PurchaseController to delete records for the specific customer_id
            $response = $purchaseController->delete($customer_id);

            // Delete the last inserted record in 'transactions' based on customer_id
            $lastTransaction = $this->transactionModel
                ->where('customer_id', $customer_id)
                ->orderBy('transaction_no', 'DESC')
                ->first();

            $deletedTransaction = false;

            if ($lastTransaction) {
                // Delete the transaction based on customer_id and transaction_no
                $deletedTransaction = $this->transactionModel
                    ->where('customer_id', $customer_id)
                    ->where('transaction_no', $lastTransaction['transaction_no'])
                    ->delete();
            }

            // Optionally, you can return a response to indicate success
            return $this->respond([
                'message' => 'Order cancelled successfully',
                'deletedTransaction' => $deletedTransaction,
                'deleteResponse' => $response,
            ], 200);
        } catch (\Exception $e) {
            // Handle any exceptions that might occur during cancellation
            return $this->respond([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        // Your index method logic goes here
    }
}
