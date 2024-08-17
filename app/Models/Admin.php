<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'admins';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

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

    //Function  to get Admin Users
    function get_admin_users() {
        $admins = $this->db
                        ->table('users')
                        ->select('users.*, auth_identities.secret,auth_groups_users.group')
                        ->join('auth_identities', 'auth_identities.user_id = users.id', 'left')
                        ->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left')
                        ->where('users.id !=',auth()->user()->id)
                        ->orderBy('users.id', 'DESC')
                        ->get()
                        ->getResult();

        return $admins;
    }

    //Function to get users permissions
    function user_permissions($id) {
        $list = $this->db->table('auth_permissions_users')->where('user_id', $id)->get()->getResult();

        $user_perms = [];

        foreach ($list as $key => $l) {
            array_push($user_perms,$l->permission);
        }

        return $user_perms;
    }

    //Function to get one Admin User
    function get_admin($id) {
        $admin = $this->db
                      ->table('users')
                      ->where('id', $id)
                      ->get()
                      ->getRow();

        $admin2 = $this->db
                        ->table('auth_identities')
                        ->where('user_id', $id)
                        ->get()
                        ->getRow();

        return [
            'admin' => $admin,
            'admin2' => $admin2
        ];
    }

    //Function to check company email 
    function check_email($email) {
        return $this->db->table('auth_identities')->where('secret', $email)->get()->getResult();
    }

    //Function to check company email 
    function check_username($username) {
        return $this->db->table('users')->where('username', $username)->get()->getResult();
    }
}
