<?php

use Williamtome\App\Router\Router;

Router::get('/', 'UserController@index');
Router::get('/users/create', 'UserController@create');
Router::post('/users/store', 'UserController@store');
