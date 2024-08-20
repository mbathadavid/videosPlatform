<?php

namespace App\Modules\Slots\Controllers;

use App\Controllers\AdministratorController;
use App\Modules\Slots\Models\Slots_m;

use CodeIgniter\API\ResponseTrait;

class Administrator extends AdministratorController
{
    use ResponseTrait;

    //Index Function 



    public function index()
    {
        helper('url');

        $data = [];

        $model =  new Slots_m();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|is_unique[slots.name]'
        ]);

        if ($this->request->getPost() && $validation->withRequest($this->request)->run()) {
            $post = (object) $this->request->getPost();

            $formd = [
                'name' => $post->name,
                'description' => $post->description,
                'status' => 1,
                'created_by' => auth()->user()->id,
                'created_on' => time()
            ];

            $ok =  $model->save($formd);

            if ($ok) {
                return redirect()->to('admin/slots/manage')->with('success', 'Successfully added');
            }
        }
        $data['payload'] = $model->get_all_slots();

        return view('App\Modules\Slots\Views\Admin\index', $data);
    }


    function updateSlot($id)
    {
        $model = new Slots_m();


        $rw = (object) $model->find($id);



        if ($this->request->getPost()) {

            $post =  (object) $this->request->getPost();

            $validation = \Config\Services::validation();
            $validation->setRules([
                'name' => 'required|is_unique[slots.name,id,' . $id . ']',
                'status' => 'required'
            ]);

            if ($validation->withRequest($this->request)->run()) {
                // Update data
                $rw->name = $post->name;
                $rw->status = $post->status;
                $rw->updated_at = time();
                $rw->modified_by =  auth()->user()->id;


                if ($model->save($rw)) {
                    return redirect()->to('admin/slots/manage')->with('success', 'Record updated successfully.');
                } else {
                    return redirect()->back()->withInput()->with('error', 'Failed to update record.');
                }
            } else {
                session()->setFlashdata('validation_errors', $validation->getErrors());
                return redirect()->back()->withInput()->with('validation_errors', $validation->getErrors());
            }
        }

        $data['row'] = $rw;
        return view('App\Modules\Slots\Views\Admin\update', $data);
    }
}