<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/nama', ['as' => 'lihatUmur', function () {
    return "Nama saya: Bagus Fibrianto";
}]);

$router->get('/age', function () {
    return "27 years";
});

$router->get('/redir', function () {
    return redirect()->route('lihatUmur');
});

$router->get('/student[/{nama}]', function ($nama = 'ali') {
    
    $student = [
        "ali" => [
            "name" => "Muhammad Ali",
            "age" => "20",
            "city" => "Malang"
        ],
        "ferdi" => [
            "name" => "Ferdi Rambo",
            "age" => "21",
            "city" => "Batu"
        ],
        "ayu" => [
            "name" => "Ayu Ting Ting",
            "age" => "21",
            "city" => "Blitar"
        ]
    ];
    if(isset($student[$nama])) {
        return $student[$nama];
    } else {
        return "Nama tidak ada dalam daftar";
    }
});

$router->group(['prefix' => 'kelas'], function () use ($router) {
    $router->get('siswa', function () {
        return ["Ali", "Ferdi", "Ayu"];
    });
});

$router->group(['prefix' => 'siswa'], function () use ($router)  {
    $router->get('/', 'SiswaController@index');
    $router->get('/{id}', 'SiswaController@getOne');
    $router->post('/', 'SiswaController@addOne');
    $router->put('/{id}', 'SiswaController@updateOne');
    $router->delete('/{id}', 'SiswaController@deleteOne');
});