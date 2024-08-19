<?php

namespace App\Modules\Clients\Controllers;

use App\Controllers\AdministratorController;
use App\Modules\Clients\Models\Clients_m;

use CodeIgniter\API\ResponseTrait;

class Administrator extends AdministratorController
{
    use ResponseTrait;

    //Index Function 
    public function index()
    {
        $data = [];
        helper(['form']);

        return view('App\Modules\Clients\Views\Admin\index', $data);
    }
}