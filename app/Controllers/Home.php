<?php

namespace App\Controllers;
use App\Modules\Industries\Models\Industries_m;
use App\Modules\MediaClips\Models\MediaClips_m;
use App\Modules\Clients\Models\Clients_m;
use App\Modules\MediaHouses\Models\MediaHouses_m;


class Home extends BaseController
{
    public function index(): string
    {
        if (auth()->loggedIn()) 
        {
        $oneWeekAgo = strtotime('-1 week');

        // return view('welcome_message');
        $data['pagetitle'] = 'Dashboard';
        $Industries  = new Industries_m();
        $Clips  = new MediaClips_m();
        $Clients  = new Clients_m();
        $Media  = new MediaHouses_m();


        $data['industries'] = $Industries->countAllResults();
        $data['clips'] = $Clips->countAllResults();
        $data['clients'] = $Clients->countAllResults();
        $data['media'] = $Media->countAllResults();

        $data['recent_clips'] = $Clips->orderBy('id', 'desc')->limit(10)->get()->getResult();
        $data['recent_clients'] = $Clients->orderBy('id', 'desc')->limit(10)->get()->getResult();
        

        $data['clients_w'] =  $Clients->where('created_on >=', $oneWeekAgo)->countAllResults();
        $data['clips_w'] =  $Clips->where('created_on >=', $oneWeekAgo)->countAllResults();
        $data['media_w'] =  $Media->where('created_on >=', $oneWeekAgo)->countAllResults();
        $data['industries_w'] =  $Industries->where('created_on >=', $oneWeekAgo)->countAllResults();

        $data['Clientss'] = $this->gen->populate('clients','id', 'name');
        $data['Industries'] = $this->gen->populate('industries', 'id', 'name');

            $user = auth()->user();

            if ($user->inGroup('admin') || $user->inGroup('superadmin')) 
            {

                return view('dashboards/admin', $data);
            }

        // return view('dashboards/admin',$data);
        }
        else
        {
            return view('Shield/login');
        }
    }
}
