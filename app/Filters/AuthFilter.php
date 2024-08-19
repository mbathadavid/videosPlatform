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
         //Ensure is Authenticated
        if (!auth()->loggedIn()) {
            return redirect()->to('login'); // Redirect to your login page.
        }

    
        //Ensure user only accsses routes realted to their Group
       $uri = service('uri');
       helper('url');
       $groupSegment = $uri->getSegment(1);
       $model = new GeneralModel();
       $usergroup = $model->user_group(auth()->user()->id)->group;
       $userpermissions = $model->user_permissions(auth()->user()->id);
       $currentURI = $request->uri->getPath(); // Get the current URI
       $router = service('router');

        // Get the current controller and method being accessed
        $controllerName = $router->controllerName();
        $methodName = $router->methodName();
        $actualControllerName = explode("\\",$controllerName);
        $thecontrollerName = $actualControllerName[3];
        
        $thepermission = strtolower($thecontrollerName.'.'.$methodName);
        $allmoduleperms = $thecontrollerName.".*";

        // echo "<pre>";
        //     print_r($usergroup);
        // echo "</pre>";
        // // echo "<pre>";
        // //     print_r(base_url('admin'));
        // // echo "</pre>";
        // die;

    //    Check whether User is allowed to proceed
    //    if (!in_array($thepermission,$userpermissions) || !in_array($allmoduleperms,$userpermissions) || current_url() !== base_url('admin') && $usergroup !== "superadmin") {
    //         return redirect()->to($this->getDashboardRoute($usergroup));
    //    }
       
       if ($groupSegment !== $usergroup && $usergroup !== "superadmin") {
            return redirect()->to($this->getDashboardRoute($usergroup));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // This method is not used in this example.
    }

    private function getDashboardRoute($userRole)
    {
        // echo $userRole;
        // die;

        // if ($userRole === 'admin' || $userRole === "superadmin") {
        //     return 'admin';
        // } else {
        //     return '/';
        // }
        

        switch ($userRole) {
            case 'admin':
                return 'admin';
            case 'superadmin':
                return 'admin';
            default:
                return '/';
        }
    }
}

?>