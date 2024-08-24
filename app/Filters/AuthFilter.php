<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\GeneralModel;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Ensure the user is authenticated
        if (!auth()->loggedIn()) {
            return redirect()->to('login'); // Redirect to login page if not authenticated
        }

        $uri = service('uri');
        helper('url');
        $groupSegment = $uri->getSegment(1); // Get the first segment of the URI
        $model = new GeneralModel();
        $usergroup = $model->user_group(auth()->user()->id)->group; // Get user group
        $userpermissions = $model->user_permissions(auth()->user()->id); // Get user permissions
        $router = service('router');

        // Get the current controller and method being accessed
        $controllerName = $router->controllerName();
        $methodName = $router->methodName();
        $actualControllerName = explode("\\", $controllerName);
        $thecontrollerName = $actualControllerName[3];

        $thepermission = strtolower($thecontrollerName . '.' . $methodName);
        $allmoduleperms = strtolower($thecontrollerName . ".*");

     
        // Permission check: uncomment if needed
        // if (!in_array($thepermission, $userpermissions)) 
        // {
        //     return redirect()->to($this->getDashboardRoute($usergroup))->with('error', 'Access denied');
        // }


        if (current_url() === base_url('admin')) 
        {
            return;
        }

        // ALLOW ALL AJAX CALLS
        if($groupSegment == 'AjaxDataSources')
        {
            return ;
        }


        // Check group segment
        if ($usergroup == 'superadmin') 
        {
            // Allow access to admin routes
            return;
        } 
        else 
        {
            if (!in_array($thepermission, $userpermissions) && !in_array($allmoduleperms, $userpermissions)) 
            {
                return redirect()->to($this->getDashboardRoute($usergroup))->with('error', 'Access denied');
            }
            // Redirect to the appropriate dashboard based on user group
            // return redirect()->to($this->getDashboardRoute($usergroup))->with('error', 'Access denied');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // This method is not used in this example.
    }

    private function getDashboardRoute($userRole)
    {
        switch ($userRole) {
            case 'admin':
            case 'superadmin':
                return 'admin';
            case 'client':
                return 'client-area';
            default:
                return '/'; // Default route, can be adjusted as needed
        }
    }
}
