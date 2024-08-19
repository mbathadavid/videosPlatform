<?php

namespace App\Modules\Permissions\Controllers;

use App\Controllers\AdministratorController;
use App\Modules\Permissions\Models\Permissions_m;
use App\Modules\Groups\Models\Groups_m;

use CodeIgniter\API\ResponseTrait;

class Administrator extends AdministratorController
{
    use ResponseTrait;

    //Index Function 
    public function index()
    {
        $data = [];
        helper(['form']);
        $model = new Groups_m();

        $data['groups'] = $model->findAll();
        $data['pagetitle'] = 'Permissions Assign';

        return view('App\Modules\Permissions\Views\Admin\index', $data);
    }
}