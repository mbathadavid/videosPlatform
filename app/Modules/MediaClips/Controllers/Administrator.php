<?php

namespace App\Modules\MediaClips\Controllers;

use App\Controllers\AdministratorController;
use App\Models\Media;
use App\Modules\MediaClips\Models\MediaClips_m;
use App\Modules\MediaClips\Models\Clips_m;
use App\Modules\MediaHouses\Models\MediaHouses_m;
use CodeIgniter\Files\File;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;


use App\Modules\Settings\Models\Settings_m;

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

            // echo "<pre>";
            //         print_r($post);
            // echo "</pre>";
            // die;

            $mediahouse = (object) $media->find($post->mediahouse);

            $form_data = array(
                'storytitle' => $post->storytitle,
                'category' => $post->category,
                'page' => $post->page,
                'soi' => $post->soi,
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
                $directoryPath = 'assets/uploads/' . date('Y') . '/' . date('M').'/'.date('d');

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
                                'file_name' => $file->getName(),
                                'file_path' => $directoryPath,
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
        $data['print_media'] = $media->get_print();
        $data['mediahouses'] = $media->media_houses();
        $data['slots'] = $this->gen->populate('slots', 'id', 'name');
        $data['clients'] = $this->gen->populate('clients', 'id', 'name');

        return view('App\Modules\MediaClips\Views\Admin\add', $data);
    }


    //Function to upload file
    public function view($encryptedId)
    {
        $model = new MediaClips_m();

        $encrypter = \Config\Services::encrypter();

        // Decrypt the ID
        $id = $encrypter->decrypt(hex2bin($encryptedId));
        
        $data['clip'] = (object) $model->find($id);

        $data['industries'] = $this->gen->populate('industries', 'id', 'name');
        $data['mediahouses'] = $this->gen->populate('mediahouses', 'id', 'name');
        $data['slots'] = $this->gen->populate('slots', 'id', 'name');
        $data['clients'] = $this->gen->populate('clients', 'id', 'name');
        $data['clips'] = $model->media_clips($id);

        return view('App\Modules\MediaClips\Views\Admin\view', $data);
    }

    //Function to upload file
    public function viewClips($encryptedId)
    {
        $model = new MediaClips_m();


        $encrypter = \Config\Services::encrypter();

        // Decrypt the ID
        $id = $encrypter->decrypt(hex2bin($encryptedId));

        // throw new \CodeIgniter\Exceptions\PageNotFoundException('Clip not found');

        $data['clip'] = (object) $model->find($id);

        $data['industries'] = $this->gen->populate('industries', 'id', 'name');
        $data['mediahouses'] = $this->gen->populate('mediahouses', 'id', 'name');
        $data['slots'] = $this->gen->populate('slots', 'id', 'name');
        $data['clients'] = $this->gen->populate('clients', 'id', 'name');
        $data['clips'] = $model->media_clips($id);

        return view('App\Modules\MediaClips\Views\Admin\view_clips', $data);
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

        $encrypter = \Config\Services::encrypter();
       
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
        if ($category) {
            $model->where('category', $category);
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

        if ($category) {
            $model->where('category', $category);
        }

        $model->where('status', 1);

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
        $cats = array(
            1 => 'Print Media',
            2 => 'Media Clip'
        );

        foreach ($clips as $p) {
            $p = (object) $p;
            $mediahouses = $this->gen->populate('mediahouses', 'id', 'name');
            $clients = $this->gen->populate('clients', 'id', 'name');
            $slots = $this->gen->populate('slots', 'id', 'name');

            $media = isset($mediahouses[$p->mediahouse]) ? $mediahouses[$p->mediahouse] : '-';
            $client = isset($clients[$p->client]) ? $clients[$p->client] : '-';
            $slot = isset($slots[$p->slot]) ? $slots[$p->slot] : '-';

            $encryptedId = bin2hex($encrypter->encrypt($p->id));

            $data[] = [
                'id' => $p->id,
                'encryptedId' => $encryptedId,
                'title' => $p->storytitle,
                'category' => isset($cats[$p->category]) ? $cats[$p->category] : 'N/A',
                'page' => $p->page ? $p->page : '',
                'soi' => $p->soi ? $p->soi : '',
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



    public function _exportMediaReportCSV()
    {
        $model = new MediaClips_m();

        $encrypter = \Config\Services::encrypter();

        // Read the request parameters for filtering
        $request = service('request');
        $category = $request->getPost('category');
        $from = strtotime($request->getPost('from'));
        $to = strtotime($request->getPost('to'));
        $mediaHouse = $request->getPost('media_house');
        $client = $request->getPost('client');

        // Apply filters
        if ($category) {
            $model->where('category', $category);
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

            $encryptedId = bin2hex($encrypter->encrypt($p->id));

            $media = isset($mediahouses[$p->mediahouse]) ? $mediahouses[$p->mediahouse] : '-';
            $client = isset($clients[$p->client]) ? $clients[$p->client] : '-';
            $slot = isset($slots[$p->slot]) ? $slots[$p->slot] : '-';

            $clips = $model->media_clips($p->id);

            // Initialize the publication field with an empty array
      

            $pub =  base_url('public_resource/media/view/'. $encryptedId);
            $ave = ($p->ratecard > 0) ? ($p->ratecard * $p->duration) : 0;
            $pr =  ($ave * 3);

            // Build the row array
            $row = [
                    date('dS M Y', $p->datetime), // Date
                    $media,                        // Media House
                    $p->storytitle,                // Headline
                    $pub,                  // Attached Publication Paths
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


    public function exportMediaReportExcel()
    {
        $model = new MediaClips_m();
        $encrypter = \Config\Services::encrypter();

        $setmodel = new Settings_m();
        $settings = (object) $setmodel->find_set(1);

        // Read the request parameters for filtering
        $request = service('request');
        $category = $request->getPost('category');
        $from = strtotime($request->getPost('from'));
        $to = strtotime($request->getPost('to'));
        $mediaHouse = $request->getPost('media_house');
        $client = $request->getPost('client');

        // Apply filters
        if ($category) {
            $model->where('category', $category);
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

        // Fetch all matching records
        $clips = $model->orderBy('id', 'DESC')->findAll();

        // Prepare Excel Spreadsheet
        $spreadsheet = new Spreadsheet();

        if ($category == 1 || !$category) {
            // Create sheet for Category 1
            $sheet1 = $spreadsheet->createSheet();
            $sheet1->setTitle('Print Media');
            $this->generateSheet($sheet1, $clips, 1, $encrypter, $settings);
        }

        if ($category == 2 || !$category) {
            // Create sheet for Category 2
            $sheet2 = $spreadsheet->createSheet();
            $sheet2->setTitle('Media Clips');
            $this->generateSheet($sheet2, $clips, 2, $encrypter, $settings);
        }

        // Remove default sheet if not needed
        if ($spreadsheet->getSheetCount() > 2) {
            $spreadsheet->removeSheetByIndex(0);
        }

        // Set header for download
        $writer = new Xlsx($spreadsheet);
        $filename = preg_replace('/[^A-Za-z0-9_\-]/', '_', 'Media Monitoring Report') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    private function generateSheet($sheet, $clips, $category, $encrypter, $settings)
    {
        // Title and logo
        $title = "Media Monitoring Report";
        $sheet->setCellValue('B1', $title);
        $sheet->mergeCells('B1:J1');
        $sheet->getStyle('B1')->getFont()->setSize(40)->setBold(true);
        $sheet->getStyle('B1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Example logo insertion (this assumes you have a logo image in the public directory)
        // Note: Uncomment and adjust the path if you have a logo to add
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setPath($settings->logopath);
        $drawing->setCoordinates('A1');
        $drawing->setHeight(60);
        $drawing->setWidth(60);
        $drawing->setWorksheet($sheet);

        // Headers based on category
        if ($category == 1) {
            $headers = [
                'DATE',
                'PUBLICATION',
                'HEADLINE',
                'ARTICLE SUMMARY',
                'PAGE',
                'SLOT',
                'SOI (cm2)',
                'WEIGHTING',
                'JOURNALIST',
                'AVE',
                'PR VALUE (ksh)'
            ];
        } elseif ($category == 2) {
            $headers = [
                'DATE',
                'STATION',
                'HEADLINE',
                'ARTICLE SUMMARY',
                'TIME',
                'SLOT',
                'SOV (Sec)',
                'WEIGHTING',
                'JOURNALIST',
                'AVE',
                'PR VALUE (ksh)'
            ];
        }

        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '3', $header);
            $sheet->getStyle($col . '3')->getFont()->setBold(true);
            $sheet->getStyle($col . '3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('00FF00'); // Green
            $sheet->getStyle($col . '3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $col++;
        }

        // Data rows
        $rowNumber = 4;
        foreach ($clips as $clip) {
            $clip = (object) $clip;
            if ($clip->category != $category) {
                continue; // Skip if the clip doesn't match the category
            }

            $encryptedId = bin2hex($encrypter->encrypt($clip->id));

            $media = $this->gen->populate('mediahouses', 'id', 'name')[$clip->mediahouse] ?? '-';
            $clientName = $this->gen->populate('clients', 'id', 'name')[$clip->client] ?? '-';
            $slot = $this->gen->populate('slots', 'id', 'name')[$clip->slot] ?? '-';

            $pub = base_url('public_resource/media/view/' . $encryptedId);
            $ave = ($clip->ratecard > 0 && $clip->duration > 0) ? ($clip->ratecard * $clip->duration) : 0;
            $ave1 = ($clip->ratecard > 0 && $clip->soi > 0) ? ($clip->ratecard * $clip->soi) : 0;
            $pr = $ave * 3;
            $pr1 = $ave1 * 3;

            if ($category == 1) {
                $data = [
                    date('dS M Y', $clip->datetime),
                    $media,
                    $pub,
                    $clip->summary,
                    $clip->page,
                    $slot,
                    $clip->soi,
                    $clip->tonality,
                    $clip->journalist,
                    $ave1,
                    $pr1
                ];
            } elseif ($category == 2) {
                $data = [
                    date('dS M Y', $clip->datetime),
                    $media,
                    $pub,
                    $clip->summary,
                    date('His', $clip->datetime) . 'hrs',
                    $slot,
                    $clip->duration,
                    $clip->tonality,
                    $clip->journalist,
                    $ave,
                    $pr
                ];
            }

            $col = 'A';
            foreach ($data as $value) {
                $sheet->setCellValue($col . $rowNumber, $value);
                $col++;
            }
            $rowNumber++;
        }

        // Formatting
        $sheet->getStyle('A3:K3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3:K' . ($rowNumber - 1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A3:K' . ($rowNumber - 1))->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A4:K' . ($rowNumber - 1))->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00'); // Yellow
    }


    public function _exportMediaReportExcel()
    {
        $model = new MediaClips_m();
        $encrypter = \Config\Services::encrypter();

        $setmodel = new Settings_m();
        $settings = (object) $setmodel->find_set(1);

        // Read the request parameters for filtering
        $request = service('request');
        $category = $request->getPost('category');
        $from = strtotime($request->getPost('from'));
        $to = strtotime($request->getPost('to'));
        $mediaHouse = $request->getPost('media_house');
        $client = $request->getPost('client');

        // Apply filters
        if ($category) {
            $model->where('category', $category);
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

        // Fetch all matching records
        $clips = $model->orderBy('id', 'DESC')->findAll();

        // Prepare Excel Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Title and logo
        $title = "Media Monitoring Report";
        $sheet->setCellValue('B1', $title);
        $sheet->mergeCells('B1:J1');
        $sheet->getStyle('B1')->getFont()->setSize(40)->setBold(true);
        $sheet->getStyle('B1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Example logo insertion (this assumes you have a logo image in the public directory)
        // Note: Uncomment and adjust the path if you have a logo to add
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setPath($settings->logopath);
        $drawing->setCoordinates('A1');
        $drawing->setHeight(60);
        $drawing->setWidth(60);
        $drawing->setWorksheet($sheet);

        // Headers
        if($category == 1)
        {
            $headers = [
                'DATE',
                'PUBLICATION',
                'HEADLINE',
                'ARTICLE SUMMARY',
                'PAGE',
                'SLOT',
                'SOI (cm2)',
                'WEIGHTING',
                'JOURNALIST',
                'AVE',
                'PR VALUE (ksh)'
            ];
        }
        elseif($category == 2)
        {
            $headers = [
                'DATE',
                'STATION',
                'HEADLINE',
                'ARTICLE SUMMARY',
                'TIME',
                'SLOT',
                'SOV (Sec)',
                'WEIGHTING',
                'JOURNALIST',
                'AVE',
                'PR VALUE (ksh)'
            ];
        }
        

        $col = 'A';
        foreach ($headers as $header) 
        {
            $sheet->setCellValue($col . '3', $header);
            $sheet->getStyle($col . '3')->getFont()->setBold(true);
            $sheet->getStyle($col . '3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('00FF00'); // Green
            $sheet->getStyle($col . '3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $col++;
        }

        // Data rows
        $rowNumber = 4;
        foreach ($clips as $clip) {
            $clip = (object) $clip;

            
            $encryptedId = bin2hex($encrypter->encrypt($clip->id));

            $media = $this->gen->populate('mediahouses', 'id', 'name')[$clip->mediahouse] ?? '-';
            $clientName = $this->gen->populate('clients', 'id', 'name')[$clip->client] ?? '-';
            $slot = $this->gen->populate('slots', 'id', 'name')[$clip->slot] ?? '-';

            $pub = base_url('public_resource/media/view/' . $encryptedId);
            $ave = ($clip->ratecard > 0 && $clip->duration > 0) ? ($clip->ratecard * $clip->duration) : 0;
            $ave1 = ($clip->ratecard > 0 && $clip->soi > 0) ? ($clip->ratecard * $clip->soi) : 0;
            $pr = $ave * 3;
            $pr1 = $ave1 * 3;

            
            if($category == 1)
            {
                $data = [
                    date('dS M Y', $clip->datetime),
                    $media,
                    $pub,
                    $clip->summary,
                    $clip->page,
                    $slot,
                    $clip->soi,
                    $clip->tonality,
                    $clip->journalist,
                    $ave1,
                    $pr1
                ];
            }
            elseif($category == 2)
            {
                $data = [
                    date('dS M Y', $clip->datetime),
                    $media,
                    $pub,
                    $clip->summary,
                    date('His', $clip->datetime) . 'hrs',
                    $slot,
                    $clip->duration,
                    $clip->tonality,
                    $clip->journalist,
                    $ave,
                    $pr
                ];
            }
          

            $col = 'A';
            foreach ($data as $value) {
                $sheet->setCellValue($col . $rowNumber, $value);
                $col++;
            }
            $rowNumber++;
        }

        // Formatting
        $sheet->getStyle('A3:K3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3:K' . ($rowNumber - 1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A3:K' . ($rowNumber - 1))->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A4:K' . ($rowNumber - 1))->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00'); // Yellow

        // Set header for download
        $writer = new Xlsx($spreadsheet);
        $filename = preg_replace('/[^A-Za-z0-9_\-]/', '_', $title) . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    //Delete Clip
    public function delete($encrypted) {

        $model = new MediaClips_m();
        $Kl = new Clips_m();

        $encrypter = \Config\Services::encrypter();

        // Decrypt the ID
        $id = $encrypter->decrypt(hex2bin($encrypted));


        // remove associated files from server
        $clips = $model->media_clips($id);

       

         foreach($clips as $clip)
         {
            unlink($clip->path);
            $Kl->delete($clip->id);
         }


        // $done = $this->gen->update_data('encrypted',['status' => 2],['id' => $id]);
        $done =  $model->delete($id);

        if ($done) 
        {
            return redirect()->to('admin/media_clips')->with('success', 'Media Clip Successfully Deleted!');
        } 
        else 
        {
            return redirect()->to('admin/media_clips')->with('error', 'Something went wrong!');
        }
    }



    


}
