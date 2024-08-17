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
       $groupSegment = $uri->getSegment(1);
       $model = new GeneralModel();
       $usergroup = $model->user_group(auth()->user()->id)->group;
       
       if ($groupSegment !== $usergroup) {
            return redirect()->to($this->getDashboardRoute($usergroup));
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
                return 'admin';
            // case 'techie':
            //     return 'techie';
            default:
                return '/';
        }
    }
}

?>