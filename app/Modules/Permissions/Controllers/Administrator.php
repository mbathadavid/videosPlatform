<?php

namespace App\Modules\Permissions\Controllers;

use App\Controllers\AdministratorController;
use App\Modules\Permissions\Models\Permissions_m;

use CodeIgniter\API\ResponseTrait;

class Administrator extends AdministratorController
{
    use ResponseTrait;

    //Index Function 
    public function index()
    {
        $data = [];
        helper(['form']);

        return view('App\Modules\Permissions\Views\Admin\index', $data);
    }
}