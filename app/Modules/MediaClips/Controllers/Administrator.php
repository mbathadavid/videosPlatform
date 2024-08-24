<?php

namespace App\Modules\MediaClips\Controllers;

use App\Controllers\AdministratorController;
use App\Models\Media;
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

        $data['clips'] = $model->all_clips();
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

            $files = $this->request->getFiles();

            // echo "<pre>";
            //     print_r($files);
            // echo "</pre>";
            // die;

            $fileRules = [
                'filepond' => [
                    'label' => 'Image File',
                    'rules' => [
                        // 'uploaded[filepond]',
                        // 'is_image[filepond]',
                        'mime_in[filepond,video/mp4,audio/mpeg]',
                        // 'max_size[userfile,100]',
                        // 'max_dims[userfile,1024,768]',
                    ],
                ],
            ];

            // if ($this->validate($fileRules)) {
            //     $name = $file->getRandomName();

            //     // $directoryPath = ROOTPATH . 'public/uploads/' . date('Y') . '/' . date('M');
            //     $directoryPath = 'assets/uploads/' . date('Y') . '/' . date('M');

            //     // Check if the directory exists
            //     if (!is_dir($directoryPath)) {
            //         // Create the directory if it does not exist
            //         mkdir($directoryPath, 0755, true);
            //     }

               
                
            //     $filepath = null;
            //     if ($file->move($directoryPath, $file->getRandomName())) {
            //         $filepath = $directoryPath . '/' . $file->getName(); // Get the final path
            //         $form_data['filepath'] = $filepath;
            //     }
            // }

            //Create a new entry for Media Clips
            $ok = $this->gen->insert_data('mediaclips', $form_data);

            if ($ok) {
                //Upload Files
                $directoryPath = 'assets/uploads/' . date('Y') . '/' . date('M');

                if (!is_dir($directoryPath)) {
                    // Create the directory if it does not exist
                    mkdir($directoryPath, 0755, true);
                }

                if ($files) {
                    foreach ($files['filepond'] as $file) {
                        $filepath = null;
                        if ($file->move($directoryPath, $file->getRandomName())) {
                            $filepath = $directoryPath . '/' . $file->getName(); // Get the final path
                            
                            $filedata = array(
                                'clipid' => $ok,
                                'path' => $filepath,
                                'created_on' => time(),
                                'created_by' => auth()->user()->id
                            );
                        }

                        $kk = $this->gen->insert_data('clips', $filedata);
                    }
                }

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
        $data['clips'] = $model->media_clips($id);

        return view('App\Modules\MediaClips\Views\Admin\view', $data);
    }


    function getReport()
    {
        $data = [];
        $data['industries'] = $this->gen->populate('industries', 'id', 'name');
        $data['clients'] = $this->gen->populate('clients', 'id', 'name');
        $data['mediahouses'] = $this->gen->populate('mediahouses', 'id', 'name');
        return view('App\Modules\MediaClips\Views\Admin\report', $data);
    }

    function fetchMediaReport()
    {
        $model = new MediaClips_m();

        // Read the DataTables request parameters
        $request = service('request');
        $draw = $request->getPost('draw');
        $start = $request->getPost('start');
        $length = $request->getPost('length');
        $search = $request->getPost('search')['value'];

        // Custom filters
        $category = $request->getPost('category');
        $from = strtotime($request->getPost('from'));
        $to = strtotime($request->getPost('to'));
        $mediaHouse = $request->getPost('media_house');
        $client = $request->getPost('client');

        // Apply filters
        // if ($category) {
        //     $model->where('category', $category);
        // }

        if ($from && $to) {
            if ($from == $to) {
                $model->where('datetime', $from);
            } else {
                $model->where('datetime >=', $from);
                $model->where('datetime <=', $to);
            }
        } elseif ($from) {
            $model->where('datetime >=', $from);
        } elseif ($to) {
            $model->where('datetime <=', $to);
        }

        if ($mediaHouse) {
            $model->where('mediahouse', $mediaHouse);
        }

        if ($client) {
            $model->where('client', $client);
        }

        // Total number of records without filtering
        $totalRecords = $model->countAllResults(false);

        // Apply the search filter after the other filters
        if ($search) {
            $model->groupStart()
                ->like('storytitle', $search)
                ->orLike('journalist', $search)
                ->orLike('summary', $search)
                ->groupEnd();
        }

        // Total number of records with filtering
        $totalRecordwithFilter = $model->countAllResults(false);

        // Fetch records with limit and offset
        $clips = $model->orderBy('id', 'DESC')
        ->findAll($length, $start);

        // Prepare data for DataTables
        $data = [];
        foreach ($clips as $p) {
            $p = (object) $p;
            $mediahouses = $this->gen->populate('mediahouses', 'id', 'name');
            $clients = $this->gen->populate('clients', 'id', 'name');
            $slots = $this->gen->populate('slots', 'id', 'name');

            $media = isset($mediahouses[$p->mediahouse]) ? $mediahouses[$p->mediahouse] : '-';
            $client = isset($clients[$p->client]) ? $clients[$p->client] : '-';
            $slot = isset($slots[$p->slot]) ? $slots[$p->slot] : '-';

            $data[] = [
                'id' => $p->id,
                'title' => $p->storytitle,
                'media' => $media,
                'client' => $client,
                'slot' => $slot,
                'duration' => $p->duration,
                'date' => date('dS M Y', $p->datetime),
            ];
        }

        // Prepare the response
        $response = [
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecordwithFilter,
            "data" => $data
        ];

        return $this->response->setJSON($response);
    }



    public function exportMediaReportCSV()
    {
        $model = new MediaClips_m();

        // Read the request parameters for filtering
        $request = service('request');
        $category = $request->getPost('category');
        $from = strtotime($request->getPost('from'));
        $to = strtotime($request->getPost('to'));
        $mediaHouse = $request->getPost('media_house');
        $client = $request->getPost('client');

        // Apply filters
        if ($category) {
            // $model->where('category', $category);
        }

        if ($from && $to) {
            if ($from == $to) {
                $model->where('datetime', $from);
            } else {
                $model->where('datetime >=', $from);
                $model->where('datetime <=', $to);
            }
        } elseif ($from) {
            $model->where('datetime >=', $from);
        } elseif ($to) {
            $model->where('datetime <=', $to);
        }


        if ($mediaHouse) {
            $model->where('mediahouse', $mediaHouse);
        }

        if ($client) {
            $model->where('client', $client);
        }

        // Apply search filter
        
        // Fetch all matching records
        $clips = $model->orderBy('id', 'DESC')->findAll();


        $mediahouses = $this->gen->populate('mediahouses', 'id', 'name');
        $clients = $this->gen->populate('clients', 'id', 'name');
        $slots = $this->gen->populate('slots', 'id', 'name');


        $title = "Media Monitoring Report";
        $xt = "";

        if($client)
        {
            $Client = isset($clients[$client]) ? $clients[$client] : '-'; 
            $xt = strtoupper($Client).' Media Monitoring Report';
        }

       
        if($from && $to)
        {
            $xt .=' - FROM '. $request->getPost('from').'  TO '. $request->getPost('from');
        }
        elseif($from)
        {
                $xt .= ' - ' . $request->getPost('from');

        }



       

        // Prepare CSV data
        // $csvData = "ID,Title,Media,Client,Slot,Duration,Date\n";
        $csvData = "DATE,STATION,HEADLINE,ARTICLE SUMMARY,TIME, SLOT,SOV (Sec),WEIGHTING,JOURNALIST,AVE,PR  VALUE\n";

        foreach ($clips as $p) {
            $p = (object) $p;

            $media = isset($mediahouses[$p->mediahouse]) ? $mediahouses[$p->mediahouse] : '-';
            $client = isset($clients[$p->client]) ? $clients[$p->client] : '-';
            $slot = isset($slots[$p->slot]) ? $slots[$p->slot] : '-';

            $clips = $model->media_clips($p->id);

            // Initialize the publication field with an empty array
            $publication = [];

            // Loop through each clip to attach paths
            foreach ($clips as $clip) {
                $publication[] = base_url($clip->path);  // Adjust 'path' to the correct key if needed
            }

            // Convert the publication array to a string with new lines and space within the cell
            $publication = implode(" \n", $publication);

            // Wrap the publication in double quotes to ensure correct CSV format
            $publication = "\"{$publication}\"";

            $ave = ($p->ratecard * $p->duration);
            $pr =  ($ave * 3);

            // Build the row array
            $row = [
                    date('dS M Y', $p->datetime), // Date
                    $media,                        // Media House
                    $p->storytitle,                // Headline
                    $publication,                  // Attached Publication Paths
                    date('His', $p->datetime) . 'hrs', // Time
                    $slot,                         // Slot
                    $p->duration,                  // SOV (Sec)
                    $p->tonality,                  // Weighting
                    $p->journalist,                // Journalist
                    $ave,                          // AVE
                    $pr                            // PR Value
                ];

            // Convert the row array into a CSV string and append it to csvData
            $csvData .= implode(',', $row) . "\n";
        }

        $filename = isset($xt) && !empty($xt) ? $xt : $title;

        $filename = preg_replace('/[^A-Za-z0-9_\-]/', '_', $filename);


        // Set headers to download the file as a CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        // Output the CSV data
        echo $csvData;
        exit;
    }


}
