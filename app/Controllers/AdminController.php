<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
class AdminController extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);

        
        // $data['permissions'] = $admin->generate_permissions();
        

        return  view('admin\index', []);
    }

    function users()
    {
        echo 'users';
    }

    function modules()
    {
        $admin = new AdminModel();

        // List of controllers that are not modules
        $nonmodules = ['AdminController', 'BaseController', 'Home'];

        // Define the path to the modules directory
        $modulesPath = APPPATH . 'Modules';

        // Initialize variable to count modules updated
        $modulesUpdated = 0;

        // Iterate through each module directory
        $moduleDirectories = new \DirectoryIterator($modulesPath);

        foreach ($moduleDirectories as $moduleDirectory) {
            // Skip . and .. directories
            if ($moduleDirectory->isDot()) {
                continue;
            }

            // Get module name from directory name
            $moduleName = $moduleDirectory->getBasename();

            // Define the path to the controllers directory within the module
            $controllersPath = $moduleDirectory->getPathname() . '/Controllers';

            // Iterate through the controllers directory of the module
            $controllers = new \DirectoryIterator($controllersPath);

            foreach ($controllers as $controller) {
                if ($controller->isFile() && $controller->getExtension() === 'php') {
                    // Extract the controller class name from the file
                    $controllerFileName = $controller->getBasename('.php');

                    if ($controllerFileName !== "Administrator") {
                        continue;
                    }
                    
                    $controllerClass = "\\App\\Modules\\$moduleName\\Controllers\\$controllerFileName";

                    // Check if the class exists and is not in nonmodules

                    if (class_exists($controllerClass) && !in_array($controllerFileName, $nonmodules)) {
                    // if (!in_array($controllerFileName, $nonmodules)) {
                        // Check if the module exists in the database
                        $moduleExists = $admin->find_module($moduleName, $controllerClass);
                        if (!$moduleExists) {
                            // If the module doesn't exist, insert it into the database
                            $data = [
                                'module_name' => $moduleName,
                                'module_path' => $controllerClass,
                                'created_on' => time(),
                                'created_by' => auth()->user()->id
                            ];

                            $ok = $admin->create_module($data);

                            if ($ok) {
                                $modulesUpdated++;
                            }
                        }
                    }
                }
            }

        }

        return redirect()->to('admin')->with('success', $modulesUpdated . ' Modules Updated successfully');
    }


}
