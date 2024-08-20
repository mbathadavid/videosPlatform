<?php

namespace App\Modules\Platforms\Controllers;

use App\Controllers\AdministratorController;
use App\Modules\Platforms\Models\Platforms_m;

use CodeIgniter\API\ResponseTrait;

class Administrator extends AdministratorController
{
    use ResponseTrait;

    


    public function index()
    {
        helper('url');

        $data = [];

        $model =  new Platforms_m();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|is_unique[platforms.name]'
        ]);

        if ($this->request->getPost() && $validation->withRequest($this->request)->run()) {
            $post = (object) $this->request->getPost();

            $formd = [
                'name' => $post->name,
                'description' => $post->description,
                'created_by' => auth()->user()->id,
                'created_on' => time()
            ];

            $ok =  $model->save($formd);

            if ($ok) {
                return redirect()->to('admin/platforms/manage')->with('success', 'Successfully added');
            }
        }
        $data['payload'] = $model->get_all_platforms();

        return view('App\Modules\Platforms\Views\Admin\index', $data);
    }


    function updatePlatform($id)
    {
        $model = new Platforms_m();


        $rw = (object) $model->find($id);



        if ($this->request->getPost()) {

            $post =  (object) $this->request->getPost();

            $validation = \Config\Services::validation();
            $validation->setRules([
                'name' => 'required|is_unique[platforms.name,id,' . $id . ']',
            ]);

            if ($validation->withRequest($this->request)->run()) {
                // Update data
                $rw->name = $post->name;
                $rw->description = $post->description;
                $rw->updated_at = time();
                $rw->modified_by =  auth()->user()->id;


                if ($model->save($rw)) {
                    return redirect()->to('admin/platforms/manage')->with('success', 'Record updated successfully.');
                } else {
                    return redirect()->back()->withInput()->with('error', 'Failed to update record.');
                }
            } else {
                session()->setFlashdata('validation_errors', $validation->getErrors());
                return redirect()->back()->withInput()->with('validation_errors', $validation->getErrors());
            }
        }

        $data['row'] = $rw;
        return view('App\Modules\platforms\Views\Admin\update', $data);
    }
}