<?php

namespace App\Modules\Industries\Models;

use CodeIgniter\Model;

class Industries_m extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'industries'; // Adjusted to use the module name in lowercase
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'description','status', 'created_by', 'modified_by', 'created_at', 'updated_at'];

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

    // Custom method to insert data into the table
    public function insert_data($data)
    {
        $this->insert($data);

        return $this->getInsertID();
    }

    function get_all_industries()
    {
        return $this->db->table('industries')->orderBy('name', 'ASC')->get()->getResult();
    }
}