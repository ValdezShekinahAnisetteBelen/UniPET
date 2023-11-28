<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderHModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'purchase_product';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['product_id', 'customer_id', 'transaction_no', 'status'];
    public function getBestSellingProductsByYear($Year)
    {
        $query = "SELECT pp.product_id, p.name, p.image, COUNT(*) as total_sales
                  FROM purchase_product pp
                  JOIN products p ON pp.product_id = p.id
                  WHERE pp.status = 'Delivered' AND YEAR(pp.created_at) = ?
                  GROUP BY pp.product_id
                  ORDER BY total_sales DESC
                  LIMIT 5";
    
        return $this->db->query($query, [$Year])->getResultArray();
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
}
