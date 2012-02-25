<?php

require_once __DIR__.'/silex.phar'; 

use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application(); 

if ($_SERVER["HTTP_HOST"] == 'jablecki.loc') {
    $app['debug'] = true;
}

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'       => __DIR__.'/views',
    'twig.class_path' => __DIR__.'/vendor/twig/lib',
));
$app->register(new Silex\Provider\SymfonyBridgesServiceProvider(), array(
    'symfony_bridges.class_path'  => __DIR__.'/vendor/symfony/src',
));

// $app->get('/hello/{name}', function ($name) use ($app) {
//     return $app['twig']->render('hello.twig', array(
//         'name' => $name,
//     ));
// });

$items = array(
    'current' => array(
        'Consolidated <a href="http://blog.jablecki.org">Blog</a>.',
        'Buenos Aires <a href="http://jablecki.org/bike.php">Social Bike Shop Map</a>.',
        'Still being amazed by <a href="http://www.linode.com/?r=8272b3593b0ab7ca3e5b4e4caae33bf6042cd12c">linode</a>.',
        'My favorite place to catch up on <a href="http://news.ycombinator.com/">net junk</a>.',
        'Fascinated, for no good reason, once again with <a href="http://twitter.com/jabowocky">twitter</a>.',
        'My <a href="' . '/cv' . '">CV/Resume</a>'
    ),
    'old' => array(
        'freelance launched with my genius friends <a href="http://codenotion.com">codeNotion</a>',
        'Checkout the now ended <a href="http://olxbeardcontest.blogspot.com">beard contest</a> at my <a href="http://www.olx.com">work</a>.',
        'A quick net-art page <a href="http://jablecki.org/options.php">Options</a>.',
        'My current project, <a href="http://bragproof.com/">BragProof</a>, is proving enjoyable.  It has it\'s own <a href="http://twitter.com/bragproofcom">twitter</a>.',
    ),            
);

$app->get('/cv', function () use ($app) {
    return $app['twig']->render('cv.twig', array());
})
->bind('cv');

$app->get('/', function () use ($app, $items) {
    return $app['twig']->render('index.twig', array(
        'items' => $items,
    ));
})
->bind('index');

if ($app['debug'] === false) {
    $app->error(function (\Exception $e, $code) {
        switch ($code) {
            case 404:
                $message = 'The requested page could not be found.';
                break;
            default:
                $message = 'We are sorry, but something went terribly wrong.';
        }

        return new Response($message, $code);
    });
}

$app->run(); 