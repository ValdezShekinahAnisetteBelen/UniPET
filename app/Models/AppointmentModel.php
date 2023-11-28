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
    protected $allowedFields = ['pet_name', 'breed', 'date_of_birth', 'weight', 'color', 'temperature','full_name', 'area', 'city', 'postal_code', 'contact_no', 'email_address','appointment_date','appointment_time', 'appointment_type', 'grooming_type', 'grooming_shampoo', 'image', 'customer_id', 'status', 'Year'];
    
    public function updateUserDataAndPetData($pet_id, $combinedData)
    {
        try {
            // Log SQL query
            $this->db->transStart();
    
            print_r($pet_id); // print the pet_id
            print_r($combinedData); // print the data to be updated
    
            $this->where('pet_id', $pet_id)->set($combinedData)->update();
    
            $this->db->transComplete();
        } catch (\Exception $e) {
            log_message('error', 'Error updating data: ' . $e->getMessage());
            $this->db->transRollback();
            throw $e;
        }
    }
    public function getAppointmentDistributionByArea($Year) {
        $query = "SELECT area, COUNT(*) as count
                  FROM pet
                  WHERE YEAR(appointment_date) = ?
                  GROUP BY area";
    
        return $this->db->query($query, [$Year])->getResultArray();
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
