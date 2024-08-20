<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Home::index');

service('auth')->routes($routes);

//Admin Group Routes
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    //Dashboard Route
    $routes->get('/', 'Home::index');
    $routes->add('modules', 'AdminController::modules');

    //User Groups
    $routes->group('groups', ['namespace' => 'App\Modules\Groups\Controllers', 'filter' => 'auth'], function ($routes) {
        $routes->add('add', 'Administrator::create');
    });

    //Users Management
    $routes->group('users', ['namespace' => 'App\Modules\Users\Controllers', 'filter' => 'auth'], function ($routes) {
        $routes->add('/', 'Administrator::index');
        $routes->add('add', 'Administrator::add');
        $routes->add('edit/(:any)', 'Administrator::edit/$1');
        $routes->add('ban/(:any)', 'Administrator::ban/$1');
        $routes->add('unban/(:any)', 'Administrator::unban/$1');
        $routes->add('suspend/(:any)/(:any)', 'Administrator::suspend/$1/$2');
    });


    // media houses

    $routes->group('media-houses', ['namespace' => 'App\Modules\MediaHouses\Controllers', 'filter' => 'auth:media-houses,admin,home'], function ($routes) {
        $routes->add('manage', 'Administrator::index', ['filter' => 'auth:manage,index']);
        $routes->add('(:any)/update_media', 'Administrator::updateMhouse/$1');
    });



    // industries
    $routes->group('industries', ['namespace' => 'App\Modules\Industries\Controllers', 'filter' => 'auth'], function ($routes) {
        $routes->add('manage', 'Administrator::index');
        $routes->add('(:any)/update_industry', 'Administrator::updateIndustry/$1');
    });


    // slots
    $routes->group('slots', ['namespace' => 'App\Modules\Slots\Controllers', 'filter' => 'auth'], function ($routes) {
        $routes->add('manage', 'Administrator::index');
        $routes->add('(:any)/update_slot', 'Administrator::updateSlot/$1');
    });

    // platforms
    $routes->group('platforms', ['namespace' => 'App\Modules\Platforms\Controllers', 'filter' => 'auth'], function ($routes) {
        $routes->add('manage', 'Administrator::index');
        $routes->add('(:any)/update_platforms', 'Administrator::updatePlatform/$1');
    });

    // permissions
    $routes->group('permissions', ['namespace' => 'App\Modules\Permissions\Controllers', 'filter' => 'auth'], function ($routes) {
        $routes->add('/', 'Administrator::index');
        $routes->add('check', 'Administrator::check');
        $routes->add('assign/(:any)', 'Administrator::assign/$1');
    });

    //Clients
    $routes->group('clients', ['namespace' => 'App\Modules\Clients\Controllers', 'filter' => 'auth'], function ($routes) {
        $routes->add('/', 'Administrator::index');
        $routes->add('edit/(:any)', 'Administrator::edit/$1');
        $routes->add('suspend/(:any)/(:any)', 'Administrator::suspend/$1/$2');
    });
   
    //Media Clips
    $routes->group('media_clips', ['namespace' => 'App\Modules\MediaClips\Controllers', 'filter' => 'auth'], function ($routes) {
        $routes->add('/', 'Administrator::index');
        $routes->add('add', 'Administrator::add');
    });
});



// client area
$routes->group('client-area', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->add('manage', 'Administrator::index');
});
