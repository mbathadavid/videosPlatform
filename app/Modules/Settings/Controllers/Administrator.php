<?php

namespace App\Modules\Settings\Controllers;

use App\Controllers\AdministratorController;
use App\Modules\Settings\Models\Settings_m;

use CodeIgniter\API\ResponseTrait;

class Administrator extends AdministratorController
{
    use ResponseTrait;

    //Index Function 
    public function index()
    {
        $data = [];
        helper(['form']);
        $model = new Settings_m();
        $rw = (object) $model->find(1);

        if ($this->request->getPost()) {
            $post = (object) $this->request->getPost();

            // $check = $model->find_set(1);
            $check = $model->where('id',1)->first();

            if($this->request->getFile('filepond'))
            {
                $file = $this->request->getFile('filepond');
                $size =  $file->getSize();
            }
            else
            {
                $file = false;
                $size = 0;
            }

         
           

            $form_data = array(
                'name' => $post->name,
                'shortname' => $post->shortname,
                'email' => $post->email,
                'phone' => $post->phone
            );

        

            $directoryPath = 'assets/logo';
            // Check if the directory exists
            if (!is_dir($directoryPath)) {
                // Create the directory if it does not exist
                mkdir($directoryPath, 0755, true);
            }

            if($size > 0)
            {
                $filepath = null;
                if ($file->move($directoryPath, $file->getRandomName())) {
                    $filepath = $directoryPath . '/' . $file->getName(); // Get the final path
                    // $form_data['logopath'] = $filepath;
                    $rw->logopath =  $filepath;
                    $model->save($rw);
                }
            }
        

            //Check if to Update or Create new entry
            if ($check) 
            {

                $rw->name =  $post->name;
                $rw->shortname =  $post->shortname;
                $rw->email =  $post->email;
                $rw->phone =  $post->phone;

               $up =  $model->save($rw);

                if ($up) {
                    return redirect()->to('admin/settings')->with('success', 'Settings Updated Successfully!');
                } else {
                    return redirect()->to('admin/settings')->with('error', 'Something went wrong!');
                }
                
            } else {
                $ok = $this->gen->insert_data('system',$form_data);

                if ($ok) {
                    return redirect()->to('admin/settings')->with('success', 'Settings Created Successfully!');
                } else {
                    return redirect()->to('admin/settings')->with('error', 'Something went wrong!');
                }
            }
        }

        $data['settings'] = (object) $model->where('id',1)->first();

        return view('App\Modules\Settings\Views\Admin\index', $data);
    }
}
