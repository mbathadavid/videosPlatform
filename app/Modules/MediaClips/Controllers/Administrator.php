<?php

namespace App\Modules\MediaClips\Controllers;

use App\Controllers\AdministratorController;
use App\Modules\MediaClips\Models\MediaClips_m;

use CodeIgniter\API\ResponseTrait;

class Administrator extends AdministratorController
{
    use ResponseTrait;

    //Index Function 
    public function index()
    {
        $data = [];
        helper(['form']);

        return view('App\Modules\MediaClips\Views\Admin\index', $data);
    }

    //Function to Add Media Clips
    public function add() {
        $data = [];
        helper(['form']);

        $model = new MediaClips_m();

        if ($this->request->getPost()) {
            $post = (object) $this->request->getPost();

            echo "<pre>";
                print_r($post);
            echo "</pre>";
            die;
        }

        $data['industries'] = $this->gen->populate('industries','id','name');
        $data['mediahouses'] = $this->gen->populate('mediahouses','id','name');
        $data['slots'] = $this->gen->populate('slots','id','name');
        $data['clients'] = $this->gen->populate('clients','id','name');

        return view('App\Modules\MediaClips\Views\Admin\add', $data);
    }


    //Function to upload file
    public function create() {
        echo "Nisyavika";
    }
}