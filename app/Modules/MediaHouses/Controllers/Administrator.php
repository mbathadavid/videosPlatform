<?php

namespace App\Modules\MediaHouses\Controllers;

use App\Controllers\AdministratorController;
use App\Modules\MediaHouses\Models\MediaHouses_m;

use CodeIgniter\API\ResponseTrait;

class Administrator extends AdministratorController
{
    use ResponseTrait;

    //Index Function 
    public function index()
    {
        $model =  new MediaHouses_m();
        $data = [];
        helper(['form']);

        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|is_unique[mediahouses.name]',
            'category' => 'required',
            'rate_card' => 'required'
        ]);

        if($this->request->getPost() && $validation->withRequest($this->request)->run())
        {
            $post = (object) $this->request->getPost();

             $formd = [
                'name' => $post->name,
                'category' => $post->category,
                'rate_card' => $post->rate_card,
                'created_by' => auth()->user()->id,
                'created_on' => time()
             ];

            $ok =  $model->save($formd);

            if($ok)
            {
                return redirect()->to('admin/media-houses/manage')->with('success', 'Successfully added');
            }
        }

        $data['payload'] = $model->get_all_media();
        return view('App\Modules\MediaHouses\Views\Admin\index', $data);
    }


    function updateMhouse($id)
    {
        $model = new MediaHouses_m();
      
           
        $rw = (object) $model->find($id);

       
        
        if ($this->request->getPost()) 
        {

            $post =  (object) $this->request->getPost();

            $validation = \Config\Services::validation();
            $validation->setRules([
                'name' => 'required|is_unique[mediahouses.name,id,' . $id . ']',
                'category' => 'required',
                'rate_card' => 'required',
            ]);

            if ($validation->withRequest($this->request)->run()) 
            {
                // Update data
                $rw->name = $post->name;
                $rw->category = $post->category;
                $rw->rate_card = $post->rate_card;
                $rw->updated_at = time();
                $rw->modified_by =  auth()->user()->id;
               

                if ($model->save($rw)) 
                {
                    return redirect()->to('admin/media-houses/manage')->with('success', 'Record updated successfully.');
                } 
                else 
                {
                    return redirect()->back()->withInput()->with('error', 'Failed to update record.');
                }
            } 
            else 
            {
                session()->setFlashdata('validation_errors', $validation->getErrors());
                return redirect()->back()->withInput()->with('validation_errors', $validation->getErrors());
            }
        }

        $data['row'] = $rw;
        return view('App\Modules\MediaHouses\Views\Admin\updatemedia', $data);
    }

    
}