<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', function() {
    $auth = service('auth');
    if (!$auth->loggedIn()) {
        return redirect()->to('login');
    }
    return redirect()->to('admin'); 
});

// $routes->get('/', 'Home::index');

service('auth')->routes($routes);

//Admin Group Routes
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    //Dashboard Route
    $routes->get('/', 'Admin::index');
    $routes->add('modules', 'AdminController::modules');

    //User Groups
    $routes->group('groups', ['namespace' => 'App\Modules\Groups\Controllers','filter' => 'auth'], function ($routes) {
        $routes->add('add', 'Administrator::create');
    });

    //Users Management
    $routes->group('users', ['namespace' => 'App\Modules\Users\Controllers','filter' => 'auth'], function ($routes) {
        $routes->add('/', 'Administrator::index');
        $routes->add('add', 'Administrator::add');
        $routes->add('edit/(:any)', 'Administrator::edit/$1');
        $routes->add('ban/(:any)', 'Administrator::ban/$1');
        $routes->add('unban/(:any)', 'Administrator::unban/$1');
        $routes->add('suspend/(:any)/(:any)', 'Administrator::suspend/$1/$2');
    });


    // media houses

     $routes->group('media-houses', ['namespace' => 'App\Modules\MediaHouses\Controllers','filter' => 'auth'], function ($routes) {
        $routes->add('manage', 'Administrator::index');
        $routes->add('(:any)/update_media', 'Administrator::updateMhouse/$1');
    });



    // industries
    $routes->group('industries', ['namespace' => 'App\Modules\Industries\Controllers', 'filter' => 'auth'], function ($routes) {
        $routes->add('manage', 'Administrator::index');
        $routes->add('(:any)/update_industry', 'Administrator::updateIndustry/$1');
    

    //Permissions
    $routes->group('permissions', ['namespace' => 'App\Modules\Permissions\Controllers','filter' => 'auth'], function ($routes) {
        $routes->add('/', 'Administrator::index');
        $routes->add('check', 'Administrator::check');
        $routes->add('assign/(:any)', 'Administrator::assign/$1');
    });
});
