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

        if ($this->request->getPost()) {
            $post = (object) $this->request->getPost();

            $check = $model->find_set(1);

            $file = $this->request->getFile('filepond');

            $form_data = array(
                'name' => $post->name,
                'shortname' => $post->shortname,
                'email' => $post->email,
                'phone' => $post->phone
            );

            // echo "<pre>";
            //     print_r($post);
            //     print_r($check);
            // echo "</pre>";
            // die;

            $directoryPath = 'assets/logo';
            // Check if the directory exists
            if (!is_dir($directoryPath)) {
                // Create the directory if it does not exist
                mkdir($directoryPath, 0755, true);
            }

            $filepath = null;
            if ($file->move($directoryPath, $file->getRandomName())) {
                $filepath = $directoryPath . '/' . $file->getName(); // Get the final path
                $form_data['logopath'] = $filepath;
            }

            //Check if to Update or Create new entry
            if ($check) {
                $up = $this->gen->update_data('system',$form_data,['id' => 1]);

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

        $data['settings'] = $model->find_set(1);

        return view('App\Modules\Settings\Views\Admin\index', $data);
    }
}
