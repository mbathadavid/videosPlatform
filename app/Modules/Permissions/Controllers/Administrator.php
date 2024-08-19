<?php

namespace App\Modules\Permissions\Controllers;

use App\Controllers\AdministratorController;
use App\Modules\Permissions\Models\Permissions_m;
use App\Modules\Groups\Models\Groups_m;
use App\Modules\Users\Models\Users_m;
use App\Models\AdminModel;

use CodeIgniter\API\ResponseTrait;

class Administrator extends AdministratorController
{
    use ResponseTrait;

    //Index Function 
    public function index()
    {
        $data = [];
        helper(['form']);
        $model = new Groups_m();
        
        $data['groups'] = $model->findAll();
        $data['pagetitle'] = 'Permissions Assign';

        return view('App\Modules\Permissions\Views\Admin\index', $data);
    }

    //Function to Assign Permissions
    public function assign($id) {
        helper(['form']);
        $usermodel = new Users_m();
        $model = new Groups_m();
        $group = (object) $model->find($id);
        $assignegroupperms = $model->get_group_permissions($id);
        
        $data['group'] = $group;
        $data['assigned'] = $assignegroupperms;

        $modules = $usermodel->get_modules();

        $perms = [];

        if ($this->request->getPost()) {
            $post = (object) $this->request->getPost();
            $permissions = $post->perms;

            $newperms = array_diff($permissions,$assignegroupperms);
            $removeperms = array_diff($assignegroupperms,$permissions);

            // echo "<pre>";
            //         print_r($permissions);
            //         print_r($assignegroupperms);
            //         print_r($newperms);
            //         print_r($removeperms);
            // echo "</pre>";
            // die;
            //Get Users in a Group
            $groupusers = $usermodel->get_group_users($group->title);

            if (count($groupusers) == 0) {
                return redirect()->to('admin/permissions/assign/'.$id)->with('error', 'There are no users assigned to this group!');
            }

            //Assign Permissions per Users
            foreach ($groupusers as $usr) {
                $users = auth()->getProvider();
                $user = $users->findById($usr->user_id);

                //Assign new Pemissions
                foreach ($newperms as $key => $p) {
                    $user->addPermission($p);
                }
                //Remove Permisions
                foreach ($removeperms as $keey => $rmv) {
                    $model->unassign_perm($usr->user_id,$rmv);
                }
            }

            //Assign Group Permissions
            // foreach ($permissions as $p) {
                // $formdata = array(
                //     'group_id' => $id,
                //     'permission' => $p,
                //     'created_on' => time(),
                //     'created_by' => auth()->user()->id
                // );

                //Assign new Pemissions
                foreach ($newperms as $key => $p) {
                    $formdata = array(
                        'group_id' => $id,
                        'permission' => $p,
                        'created_on' => time(),
                        'created_by' => auth()->user()->id
                    );
                    $addperm = $this->gen->insert_data('group_permissions',$formdata);
                }
                //Remove Permisions
                foreach ($removeperms as $keey => $rmv) {
                    $model->unassign_group_perm($id,$rmv);
                }

                
            // }

            return redirect()->to('admin/permissions/assign/'.$id)->with('success', 'You have successfully assigned permissions to '.$group->name);
        }

        foreach ($modules as $key => $module) {
            $controllerName = $module->module_path;
            $moduleName = $module->module_name;
            $newmoduleName = str_replace('Controller', '', $moduleName);

            // Check if the class exists
            if (class_exists($controllerName)) {
                // Create a reflection class for the controller
                $controllerReflection = new \ReflectionClass($controllerName);

                // Get all public methods of the controller
                $methods = $controllerReflection->getMethods(\ReflectionMethod::IS_PUBLIC);

                // Initialize an array to store method names
                $controllerMethodNames = ['*'];

                // Loop through the methods and add their names to the array
                foreach ($methods as $method) {
                    // Exclude magic methods and constructor
                    if (!$method->isConstructor() && !$method->isDestructor() && !$method->isAbstract() && !$method->isStatic()) {
                        if ($method->getName() == 'initController') {
                            continue;
                        }
                        $controllerMethodNames[] = $method->getName();
                    }
                }

                $perms[$newmoduleName] = $controllerMethodNames;
            }
        }


        $data['pagetitle'] = 'Permissions Assign';
        $data['perms'] = $perms;
        $data['modules'] = $modules;

        return view('App\Modules\Permissions\Views\Admin\assign', $data);
    }

    //Check Permissions
    public function check() {
        $model = new AdminModel();

        $permissions = $model->generate_permissions();
        $groups = $model->generate_groups();
        $groupperms = $model->group_permissions();

        echo "<pre>";
                // print_r($permissions);
                // print_r($groups);
                print_r($groupperms);
        echo "</pre>";
    }
}