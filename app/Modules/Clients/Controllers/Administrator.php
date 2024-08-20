<?php

namespace App\Modules\Clients\Controllers;

use App\Controllers\AdministratorController;
use App\Modules\Clients\Models\Clients_m;
use App\Modules\Users\Models\Users_m;
use CodeIgniter\Shield\Entities\User;

use CodeIgniter\API\ResponseTrait;

use App\Models\GeneralModel;

class Administrator extends AdministratorController
{
    use ResponseTrait;

    //Index Function 
    public function index()
    {
        $data = [];
        helper(['form']);

        $model = new Clients_m();

        if ($this->request->getPost()) {
            $post = (object) $this->request->getPost();

            $formd = [
                'name' => $post->name,
                'email' => $post->email,
                'phone' => $post->phone,
                'industry' => $post->industry,
                'description' => $post->description,
                'status' => 1,
                'created_by' => auth()->user()->id,
                'created_on' => time()
            ];

            //Insert Client
            $ok = $this->gen->insert_data('clients',$formd);

            if ($ok) {
                //Add Client as a User
                $users = auth()->getProvider();
                $name = explode(' ',$post->name);
                $fname = $name[0];
                $lname = isset($name[2]) ? $name[2] : isset($name[1]) ? $name[1] : ''; 
                $username = $fname.$lname.'_client_'.$ok;
                
                $user = new User([
                    'first_name' => $fname,
                    'last_name' => $lname,
                    'phone' => $post->phone,
                    'username' => $username,
                    'email'    => $post->email,
                    'password' => '12345678',
                ]);

                // $users->save($user);

                if ($users->save($user)) {
                    $user = $users->findById($users->getInsertID());

                    //Update Client User ID
                    $upd = $this->gen->update_data('clients',['user_id' => $users->getInsertID()],['id' => $ok]);
                    // echo "<pre>";
                    //     print_r($users->getInsertID());
                    // echo "</pre>";
                    // die;
                    //Add to Group
                    $user->addGroup('client');

                    $user->activate();
                }
                

                return redirect()->to('admin/clients')->with('success', 'Client Successfully Created!');
            } else {
                return redirect()->to('admin/clients')->with('error', 'Something went wrong!');
            }
        }

        $data['industries'] = $this->gen->populate('industries','id','name');
        $data['clients'] = $model->clients(1);

        return view('App\Modules\Clients\Views\Admin\index', $data);
    }

    //Function edit 
    public function edit($id) {
        $model = new Clients_m();
        $client = $model->find($id);

        if ($this->request->getPost()) {
            $post = (object) $this->request->getPost();

            //Update Client Part
            $formd = [
                'name' => $post->name,
                'email' => $post->email,
                'phone' => $post->phone,
                'industry' => $post->industry,
                'description' => $post->description,
                'modified_by' => auth()->user()->id,
                'modified_on' => time()
            ];

            $update = $this->gen->update_data('clients',$formd,['id' => $id]);

            if ($update) {
                 //Update The users
                 $users = auth()->getProvider();

                $user = $users->findById($post->userid);

                $name = explode(' ',$post->name);
                $fname = $name[0];
                $lname = isset($name[2]) ? $name[2] : isset($name[1]) ? $name[1] : ''; 
                $username = $fname.$lname.'_client_'.$id;

                $form_data = array(
                    'first_name' => $fname,
                    'last_name' => $lname,
                    'phone' => $post->phone,
                    'username' => $username,
                    'email'    => $post->email,
                );      
                
                $user->fill($form_data);

                $users->save($user);

                return redirect()->to('admin/clients')->with('success', 'Client Successfully Edited!');
            } else {
                return redirect()->to('admin/clients')->with('error', 'An error occured. Please try again later!');
            }
        
        }

        $data['client'] = (object) $client;
        $data['industries'] = $this->gen->populate('industries','id','name');

        return view('App\Modules\Clients\Views\Admin\edit', $data);
    }

    //Function to suspend
    public function suspend($id,$status) {
        $form_data = array(
            'status' => $status
        );

        $sus = $this->gen->update_data('clients',$form_data,['id' => $id]);

        if ($sus) {
            return redirect()->to('admin/clients')->with('success', 'Status Changed Successfully!');
        } else {
            return redirect()->to('admin/clients')->with('error', 'An error occured. Please try again later!');
        }
        
    }   
}