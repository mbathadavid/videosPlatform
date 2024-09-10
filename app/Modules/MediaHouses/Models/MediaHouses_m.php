<?php

namespace App\Modules\MediaHouses\Models;

use CodeIgniter\Model;

class MediaHouses_m extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mediahouses'; // Adjusted to use the module name in lowercase
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'rate_card', 'category', 'created_by', 'modified_by', 'created_on', 'updated_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_on';
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

    function get_all_media()
    {
        return $this->db->table('mediahouses')->orderBy('name','ASC')->get()->getResult();
    }

    function get_print()
    {
        $list =  $this->db->table('mediahouses')->where(['category' => 'Print'])->get()->getResult();

        $out = [];

        foreach($list as $p)
        {
            $out[$p->id] = $p->name;
        }

        return $out;
    }

    function media_houses()
    {
        $list =  $this->db->table('mediahouses')
                            ->where(['category' => 'TV'])
                            ->orWhere(['category' => 'Radio'])
                            ->get()->getResult();

        $out = [];

        foreach ($list as $p) {
            $out[$p->id] = $p->name;
        }

        return $out;
    }
}