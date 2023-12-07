<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'customer';
    protected $primaryKey = 'customer_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['first_name', 'last_name', 'email', 'phone_number', 'username', 'password', 'token', 'status', 'role'];
    public function updateUserRole($customerId, $newRole)
    {
        try {
            $data = [
                'role' => $newRole,
            ];
    
            $updatedRows = $this->where('customer_id', $customerId)->update($data);
    
            if ($updatedRows > 0) {
                // Role updated successfully
                log_message('debug', 'updateUserRole - Role updated successfully. Customer ID: ' . $customerId . ', New Role: ' . $newRole);
                return true;
            } else {
                // No rows were updated, log a warning
                log_message('warning', 'updateUserRole - No rows updated. Customer ID: ' . $customerId . ', New Role: ' . $newRole);
                return false;
            }
        } catch (\Exception $e) {
            // Log the exception for debugging
            log_message('error', 'updateUserRole - Exception: ' . $e->getMessage());
            log_message('error', 'updateUserRole - File: ' . $e->getFile() . ', Line: ' . $e->getLine());
    
            return false;
        }
    }
    
    public function getTableHeaders2()
    {
        // Assuming 'pet' is the table name
        $fields = $this->db->getFieldNames('customer');
    
        return $fields;
    }
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getUserByToken($token)
    {
        return $this->where('token', $token)->first();
    }

    public function getUserById($customerId)
    {
        return $this->find($customerId);
    }
}
