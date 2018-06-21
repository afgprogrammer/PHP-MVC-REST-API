<?php

$router->get('/home', 'home@index');

$router->post('/home', 'home@post');

$router->get('/', function() {
    echo 'Welcome ';
});
