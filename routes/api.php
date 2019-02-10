<?php

/*
|--------------------------------------------------------------------------
| Common api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
    $router->get('/users', 'UserController@index');
$router->group([
    'middleware' => 'auth'
], function ($router) {
    // resource('/users', 'UserController', $router);
    $router->get('/users/{id}', 'UserController@show');
    $router->post('/users', 'UserController@store');
    $router->put('/users/{id}', 'UserController@update');
    $router->delete('/users/{id}', 'UserController@delete');

    $router->get('/profile', 'ProfileController@index');
    $router->put('/profile', 'ProfileController@update');
    $router->put('/profile/change-password', 'ProfileController@changePassword');
    $router->get('/permissions', 'PermissionController@index');
    // resource('/roles', 'RoleController', $router);
    $router->get('/roles', 'RoleController@index');
    $router->get('/roles/{id}', 'RoleController@show');
    $router->post('/roles', 'RoleController@store');
    $router->put('/roles/{id}', 'RoleController@update');
    $router->delete('/roles/{id}', 'RoleController@delete');

    // resource('/positions', 'PositionController', $router);
});

    $router->get('/positions', 'PositionController@index');
    $router->get('/positions/{id}', 'PositionController@show');
    $router->post('/positions', 'PositionController@store');
    $router->put('/positions/{id}', 'PositionController@update');
    $router->delete('/positions/{id}', 'PositionController@destroy');
    $router->put('/positions/change-status/{id}', 'PositionController@changeStatus');
    $router->get('/branches' ,'BranchController@index');
    $router->get('/branches/{id}', 'BranchController@show');
    $router->post('/branches', 'BranchController@store');
    $router->put('branches/{id}', 'BranchController@update');
    $router->delete('/branches/{id}', 'BranchController@destroy');
    $router->put('/branches/change-status/{id}', 'BranchController@changeStatus');
    $router->put('/branches/change-branch-main/{id}', 'BranchController@changeBranchMain');
    //department
    $router->get('/departments', 'DepartmentController@index');
    $router->get('/departments/{id}', 'DepartmentController@show');
    $router->post('/departments', 'DepartmentController@store');
    $router->put('/departments/{id}', 'DepartmentController@update');
    $router->delete('/departments/{id}', 'DepartmentController@destroy');
    $router->get('/departments/branch/{id}', 'DepartmentController@getByBranch');
    $router->put('/departments/change-status/{id}', 'DepartmentController@changeStatus');
    //city
    $router->get('/cities', 'CityController@index');
    $router->get('/districts', 'DistrictController@index');
$router->post('login', 'LoginController@login');
$router->post('register', 'RegisterController@register');

/**
 * resource router helper
 * @author KingDarkness <nguyentranhoan13@gmail.com>
 * @date   2018-07-17
 * @param  string     $uri        enpoint url
 * @param  string     $controller controller name
 * @param  Laravel\Lumen\Routing\Router     $router     RouterObject
 */
// function resource($uri, $controller, Laravel\Lumen\Routing\Router $router)
// {
//     $router->get($uri, $controller.'@index');
//     $router->get($uri.'/{id}', $controller.'@show');
//     $router->post($uri, $controller.'@store');
//     $router->put($uri.'/{id}', $controller.'@update');
//     $router->delete($uri.'/{id}', $controller.'@destroy');
// }