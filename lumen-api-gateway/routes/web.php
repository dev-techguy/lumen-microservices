<?php

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

$router->group(['middleware' => 'client.credentials'], function () use ($router) {
    /**
     * ---------------
     * authors routes
     * --------------
    */
    $router->get('authors', 'AuthorController@index');
    $router->post('authors', 'AuthorController@store');
    $router->get('authors/{id}', 'AuthorController@show');
    $router->put('authors/{id}', 'AuthorController@update');
    $router->patch('authors/{id}', 'AuthorController@update');
    $router->delete('authors/{id}', 'AuthorController@destroy');


    /**
     * ------------
     * books routes
     * ------------
    */
    $router->get('books', 'BookController@index');
    $router->post('books', 'BookController@store');
    $router->get('books/{id}', 'BookController@show');
    $router->put('books/{id}', 'BookController@update');
    $router->patch('books/{id}', 'BookController@update');
    $router->delete('books/{id}', 'BookController@destroy');


    /**
     * ------------
     * users routes
     * ------------
    */
    $router->get('users', 'UserController@index');
    $router->post('users', 'UserController@store');
    $router->get('users/{id}', 'UserController@show');
    $router->put('users/{id}', 'UserController@update');
    $router->patch('users/{id}', 'UserController@update');
    $router->delete('books/{id}', 'UserController@destroy');
});
