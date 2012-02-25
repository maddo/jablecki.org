<?php

require_once __DIR__.'/silex.phar'; 


$app = new Silex\Application(); 

if ($_SERVER["HTTP_HOST"] == 'jablecki.loc') {
    $app['debug'] = true;
}

$app->get('/hello/{name}', function($name) use($app) { 
    return 'Hello '.$app->escape($name); 
}); 

$app->run(); 