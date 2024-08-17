<?php

namespace App\Modules\Users\Controllers;

use App\Controllers\AdministratorController;
use App\Modules\Users\Models\Users_m;
use CodeIgniter\Shield\Entities\User;

use CodeIgniter\API\ResponseTrait;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use App\Models\GeneralModel;

class Administrator extends AdministratorController
{
    use ResponseTrait;


    //Index Function 
    public function index()
    {
        $data = [];
        helper(['form']);

        $model = new Users_m();
        $data['admins'] = $model->get_admin_users();
        $data['pagetitle'] = 'Users';

        return view('App\Modules\Users\Views\Admin\index', $data);
    }

    //Index Function 
    public function add()
    {
        $data = [];
        helper(['form']);

        $model = new Users_m();

        $validation = \Config\Services::validation();

        $modules = $model->get_modules();

        $perms = [];

        //Receive User Data Here
        if ($this->request->getPost()) {
            $validation = service('validation');

            //Check Validation
            if (!$validation->run($this->request->getPost(),'uservalidation')) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            } 

            $post = (object) $this->request->getPost();

            // echo "<pre>";
            //     print_r($this->request->getPost());
            // echo "</pre>";
            // die;
            

            $users = auth()->getProvider();

            $user = new User([
                'first_name' => $post->first_name,
                'last_name' => $post->last_name,
                'phone' => $post->phone,
                'username' => $post->username,
                'email'    => $post->email,
                'password' => $post->password,
            ]);

            // $users->save($user);
            if ($users->save($user)) {
                $user = $users->findById($users->getInsertID());

                //Add to Group
                $user->addGroup($post->group);

                //Assign User Permissions
                
                /* $perms = $post->perms;

                foreach ($perms as $key => $p) {
                    $user->addPermission($p);
                } */

                $user->activate();

                return redirect()->to('admin/users')->with('success', 'Successfully Edited!');
            } else {
                return redirect()->to('admin/users/add')->with('error', 'Something went wrong!');
            }

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
                $controllerMethodNames = [];

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

        $data['admins'] = $model->get_admin_users();
        $data['groups'] = $model->populate('groups','name','name');
        $data['perms'] = $perms;
        $data['pagetitle'] = 'Users';

        return view('App\Modules\Users\Views\Admin\add', $data);
    }
}
