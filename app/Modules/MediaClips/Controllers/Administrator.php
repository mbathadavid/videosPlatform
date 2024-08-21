<?php

namespace App\Modules\MediaClips\Controllers;

use App\Controllers\AdministratorController;
use App\Modules\MediaClips\Models\MediaClips_m;
use App\Modules\MediaHouses\Models\MediaHouses_m;
use CodeIgniter\Files\File;

use CodeIgniter\API\ResponseTrait;

class Administrator extends AdministratorController
{
    use ResponseTrait;

    //Index Function 
    public function index()
    {
        $data = [];
        helper(['form']);
        $model = new MediaClips_m();

        $data['clips'] = $model->findAll();
        $data['industries'] = $this->gen->populate('industries', 'id', 'name');
        $data['mediahouses'] = $this->gen->populate('mediahouses', 'id', 'name');
        $data['slots'] = $this->gen->populate('slots', 'id', 'name');
        $data['clients'] = $this->gen->populate('clients', 'id', 'name');

        return view('App\Modules\MediaClips\Views\Admin\index', $data);
    }

    //Function to Add Media Clips
    public function add()
    {
        $data = [];
        helper(['form']);

        $model = new MediaClips_m();
        $media = new MediaHouses_m();

        if ($this->request->getPost()) {
            $post = (object) $this->request->getPost();
            $mediahouse = (object) $media->find($post->mediahouse);

            $form_data = array(
                'storytitle' => $post->storytitle,
                'mediahouse' => $post->mediahouse,
                'ratecard' => $mediahouse->rate_card,
                'datetime' => strtotime($post->datetime),
                'slot' => $post->slot,
                'client' => $post->client,
                // 'sector' => $post->sector,
                'duration' => $post->duration,
                'tonality' => $post->tonality,
                'journalist' => $post->journalist,
                'summary' => $post->summary,
                'created_on' => time(),
                'created_by' => auth()->user()->id
            );

            $file = $this->request->getFile('filepond');

            // echo "<pre>";
            //     print_r($file);
            // echo "</pre>";
            // die;

            $fileRules = [
                'filepond' => [
                    'label' => 'Image File',
                    'rules' => [
                        // 'uploaded[filepond]',
                        // 'is_image[filepond]',
                        'mime_in[filepond,video/mp4,audio/mp3]',
                        // 'max_size[userfile,100]',
                        // 'max_dims[userfile,1024,768]',
                    ],
                ],
            ];

            if ($this->validate($fileRules)) {
                $name = $file->getRandomName();

                $directoryPath = ROOTPATH . 'public/uploads/' . date('Y') . '/' . date('M');

                // Check if the directory exists
                if (!is_dir($directoryPath)) {
                    // Create the directory if it does not exist
                    mkdir($directoryPath, 0755, true);
                }

                // sleep(5);

                if ($file->move('./public/uploads', $name)) {
                    $form_data['filepath'] = base_url('public/uploads/' . $name);
                }
            }

            //Create a new entry for Media Clips
            $ok = $this->gen->insert_data('mediaclips', $form_data);

            if ($ok) {
                return redirect()->to('admin/media_clips')->with('success', 'Media Clip Successfully Added!');
            } else {
                return redirect()->to('admin/media_clips')->with('error', 'Something went wrong!');
            }
        }

        $data['industries'] = $this->gen->populate('industries', 'id', 'name');
        $data['mediahouses'] = $this->gen->populate('mediahouses', 'id', 'name');
        $data['slots'] = $this->gen->populate('slots', 'id', 'name');
        $data['clients'] = $this->gen->populate('clients', 'id', 'name');

        return view('App\Modules\MediaClips\Views\Admin\add', $data);
    }


    //Function to upload file
    public function view($id)
    {
        $model = new MediaClips_m();
        
        $data['clip'] = (object) $model->find($id);

        $data['industries'] = $this->gen->populate('industries', 'id', 'name');
        $data['mediahouses'] = $this->gen->populate('mediahouses', 'id', 'name');
        $data['slots'] = $this->gen->populate('slots', 'id', 'name');
        $data['clients'] = $this->gen->populate('clients', 'id', 'name');

        return view('App\Modules\MediaClips\Views\Admin\view', $data);
    }
}
