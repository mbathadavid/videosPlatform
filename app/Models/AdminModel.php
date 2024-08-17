<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'admin';
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

    function recent_schools()
    {
        return $this->db->table('schools')->orderBy('id', 'DESC')->limit('10')->get()->getResult();
    }


    function get_recent_tx()
    {
        return $this->db->table('transactions')->orderBy('id','DESC')->limit('10')->get()->getResult();
    }

    function populate($table, $id, $text)
    {
        $pp = $this->db->table($table)->orderBy($text, 'ASC')->get()->getResult();
        $out = [];

        foreach ($pp as $p) {
            $out[$p->$id] = $p->$text;
        }


        return $out;
    }

    //Function to gettotal Clients
    function get_total_clients() {
        $clients = $this->db->table('clients')->where('status', 1)->get()->getResult();

        return count($clients);
    }

    //Function to get total Properties
    function get_total_properties() {
        $dbb = \Config\Database::connect('mis');

        $houses = $dbb->table('houses')->get()->getResult();

        return count($houses);
    }

    //Function to get total users
    function get_total_users() {
        $dbb = \Config\Database::connect('mis');

        $users = $dbb->table('users')->where('active',1)->get()->getResult();

        return count($users);
    }

    //Function to get total users
    function get_recent_logs() {
        $logs = $this->db->table('logs')->orderBy('id','DESC')->limit('10')->get()->getResult();

        return $logs;
    }

    //Function to retrieve all modules
    function get_modules() {
        $modules = $this->db->table('modules')->orderBy('id','DESC')->get()->getResult();

        return $modules;
    }

    //Function to Insert modules
    function create_module($data) {
        $this->db->table('modules')->insert($data);
        
        $insertedId = $this->db->insertID();
    
        return $insertedId;
    }

     //Function to check whether module exists
     function find_module($name,$path) {
        $module = $this->db->table('modules')->where('module_name',$name)->where('module_path',$path)->get()->getRow();

        return $module;
    }

    //Function to return permissions array
    function generate_permissions() {
        $modules = $this->db->table('modules')->orderBy('id','DESC')->get()->getResult();

        $perms = [];

            foreach ($modules as $key => $module) {
                $controllerName = $module->module_path;
                $moduleName = $module->module_name;
                $newmoduleName = str_replace('Controller', '', $moduleName);
                
                // Check if the class exists
                if (class_exists($controllerName)) {
                    // Create a reflection class for the controller
                    $controllerReflection = new \ReflectionClass($controllerName);

                    // Get all public methods of the controller
                    $methods = $controllerReflection->getMethods();

                    // Initialize an array to store method names
                    $controllerMethodNames = [];

                    // Loop through the methods and add their names to the array
                    foreach ($methods as $method) {
                        if ('\\'.$method->getDeclaringClass()->getName() === $controllerName && $method->getName() !== "__construct") {
                            $controllerMethodNames[] = $method->getName();
                        }
                    }

                    $perms[$newmoduleName] = $controllerMethodNames;
                } 
            }
            
            $permissions = [];

            function str_contains($haystack, $needle) {
                return strpos($haystack, $needle) !== false;
            } 

            foreach ($perms as $key => $perm) {
                foreach ($perm as $kkk => $val) {
                    if ($val === "index") {
                        $text = "View ".$key;
                    } else {
                        if (str_contains($val, '_')) {
                            $text = str_replace('_', ' ', $val);
                        } else {
                            $text = $val;
                        }
                    }

                    $permissions[strtolower($key).'.'.strtolower($val)] = ucwords('can '.$text);
                }
            }

            return $permissions;
    }

    //Function to return Groups
    function generate_groups() {
        $groups = $this->db->table('groups')->orderBy('id','DESC')->get()->getResult();

        $grps = [];

        foreach ($groups as $g) {
            $grps[$g->name] = array(
                'title' => $g->title,
                'description' => $g->description
            );
        }

        return $grps;
    }

    //Get users permissions
    function get_user_permissions($userid) {
        $modules = $this->db->table('auth_permissions_users')->where('user_id',$userid)->get()->getResult();

        $mods = [];

        foreach ($modules as $key => $val) {
            array_push($mods,$val->permission);
        }

        return $mods;
    }

    //Function to remove Permisions
    function unassign_perm($userid,$perm) {
        return $this->db->table('auth_permissions_users')
                        ->where('user_id', $userid)
                        ->where('permission', $perm)
                        ->delete();
    }


}
