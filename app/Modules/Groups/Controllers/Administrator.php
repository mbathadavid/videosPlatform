<?php

namespace App\Modules\Groups\Controllers;

use App\Controllers\AdministratorController;
use App\Modules\Groups\Models\Groups_m;
use CodeIgniter\Shield\Entities\User;

use CodeIgniter\API\ResponseTrait;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use App\Models\GeneralModel;

class Administrator extends AdministratorController
{
    use ResponseTrait;

    //Function to Create
    function create()
    {
        helper(['form']);

        $data = [];

        $model = new Groups_m();
      

        if($this->request->getPost())
        {
            // $validation = \Config\Services::validation();

             
                $post = (object) $this->request->getPost();

             
            
 
                $form_data = array(
                    'name' => strtolower($post->group),
                    'title' => $post->title,
                    'description' => $post->description,
                    'created_by' => auth()->user()->id,
                    'created_at' => time()
                );

                $ok = $model->insert_data('groups',$form_data);

                if ($ok) 
                {
                    return redirect()->to('admin/groups/add')->with('success', 'Successfully Edited!');
                }
                else
                {
                    return redirect()->to('admin/groups/add')->with('error', 'Something went wrong!');
                }
             
        }
    
        $data['groups'] = $model->findAll();
        $data['pagetitle'] = 'User Groups';

        return view('App\Modules\Groups\Views\Admin\index', $data);
    }
   
}
