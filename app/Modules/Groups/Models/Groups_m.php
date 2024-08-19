<?php

namespace App\Modules\Groups\Models;

use CodeIgniter\Model;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use App\Models\SchoolsModel;

class Groups_m extends Model
{

    protected $DBGroup          = 'default';
    protected $table            = 'groups';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'desciption', 'title', 'created_by', 'modified_by', 'created_at', 'updated_at'];

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

    function insert_data($table, $data)
    {
        $sql = $this->db->table($table); // Replace 'your_table' with your actual table name
        $sql->insert($data);

        return $this->db->insertID();
    }

    //Function to get group permissions
    function get_group_permissions($id) {
        $list = $this->db->table('group_permissions')->where('group_id',$id)->get()->getResult();

        $perms = [];

        foreach ($list as $key => $l) {
            $p = (object) $l;

            $perms[] = $p->permission;
        }

        return $perms;
    }

    //Function to remove Permisions

    function unassign_perm($userid,$perm) {

        return $this->db->table('auth_permissions_users')

                        ->where('user_id', $userid)

                        ->where('permission', $perm)

                        ->delete();

    }

    function unassign_group_perm($group,$perm) {

        return $this->db->table('group_permissions')

                        ->where('group_id', $group)

                        ->where('permission', $perm)

                        ->delete();

    }
}