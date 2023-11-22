<?php

namespace App\Models;

use CodeIgniter\Model;

class AppointmentModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pet';
    protected $primaryKey       = 'pet_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['pet_name', 'breed', 'date_of_birth', 'weight', 'color', 'temperature','full_name', 'area', 'city', 'postal_code', 'contact_no', 'email_address','appointment_date','appointment_time', 'appointment_type', 'grooming_type', 'grooming_shampoo', 'image', 'customer_id'];
    
    public function updateUserData($petId, $data)
    {
        // Log the SQL query
        $queries = $this->db->getLastQuery();
        log_message('error', $queries);
    
        // Rest of your code...
        
        $this->update(['pet_id' => $petId], $data);
    }
    
    
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [];
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
