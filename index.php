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
        // 'Buenos Aires <a href="http://jablecki.org/bike.php">Social Bike Shop Map</a>.',
        'Still being amazed by <a href="http://www.linode.com/?r=8272b3593b0ab7ca3e5b4e4caae33bf6042cd12c">linode</a>.',
        'My favorite place to catch up on tech <a href="http://news.ycombinator.com/">Hacker News</a>.',
        'Find me on twitter <a href="http://twitter.com/jabowocky">@jabowocky</a>.',
        'New Hobby project: <a href="http://gift.jablecki.org/">Group Gift</a>.',
        'My <a href="' . '/cv' . '">CV/Resume</a>'
    ),
    'old' => array(
        'freelance launched with my genius friends <a href="http://codenotion.com">codeNotion</a>',
        'The long past <a href="http://olxbeardcontest.blogspot.com">beard contest</a> at my <a href="http://www.olx.com">previous job</a>.',
        // 'A quick net-art page <a href="http://jablecki.org/options.php">Options</a>.',
        'A fun past project, <a href="http://bragproof.com/">BragProof</a>, has suspended development.',
    ),            
);

$app->get('/cv', function () use ($app) {
    return $app['twig']->render('cv.twig', array());
})
->bind('cv');

$chords = array(
    "http://tabs.ultimate-guitar.com/m/mountain_goats/heretic_pride_tab.htm" => "Mountain Goats - Heretic Pride",
    "http://tabs.ultimate-guitar.com/n/no_use_for_a_name/on_the_outside_crd.htm" => "No Use For A Name - On the Outside",
    "http://tabs.ultimate-guitar.com/c/cranberries/linger_acoustic_crd.htm" => "Cranberries - Linger",
    "http://tabs.ultimate-guitar.com/c/cloud_cult/take_your_medicine_crd.htm" => "Cloud Cult - Take your Medecine",
    "http://tabs.ultimate-guitar.com/c/cloud_cult/when_water_comes_to_life_crd.htm" => "Cloud Cult - Water Comes to Life",
    "http://www.10acordes.com.ar/letra-de-la-primavera-victor-velazquez-17443" => "La Primavera de Victor Vel&aacute;zquez",
    "http://tabs.ultimate-guitar.com/s/switchfoot/24_ver3_crd.htm" => "Switchfoot - 24",
    "http://tabs.ultimate-guitar.com/n/neutral_milk_hotel/april_8th_ver3_tab.htm" => "Neutral Milk Hotel - April 8th",
    "http://tabs.ultimate-guitar.com/m/mumford_and_sons/awake_my_soul_crd.htm" => "Mumford &amp; Sons - Awaky My Soul",
    "http://tabs.ultimate-guitar.com/j/jeff_buckley/hallelujah_ver2_crd.htm" => "Jeff Buckley - Hallelujah",
    "http://tabs.ultimate-guitar.com/t/the_avett_brothers/head_full_of_doubt_road_full_of_promise_crd.htm" => "Avett Brothers - Head Full Of Doubt",
    "http://tabs.ultimate-guitar.com/t/the_avett_brothers/i_and_love_and_you_ver3_crd.htm" => "Avett Brothers - I and Love and You",
    "http://tabs.ultimate-guitar.com/n/neutral_milk_hotel/oh_comely_crd.htm" => "Neutral Milk Hotel - Oh Comely",
    "http://tabs.ultimate-guitar.com/j/john_frusciante/past_recedes_crd.htm" => "John Frusciante - Past Recedes",
    "http://tabs.ultimate-guitar.com/j/jonathan_coulton/re_your_brains_crd.htm" => "Jonathan Coulton - Re Your Brains",
    "http://tabs.ultimate-guitar.com/m/mumford_and_sons/white_blank_page_crd.htm" => "Mumford &amp; Sons - White Blank Page",
    "http://tabs.ultimate-guitar.com/t/two_gallants/waves_of_grain_crd.htm" => "Two Gallants - Waves of Grain",
    "http://tabs.ultimate-guitar.com/n/neutral_milk_hotel/two-headed_boy_crd.htm" => "Neutral Milk Hotel - Two Headed Boy",
    "http://tabs.ultimate-guitar.com/n/neutral_milk_hotel/two-headed_boy_part_two_crd.htm" => "Neutral Milk Hotel - Two Headed Boy pt 2",
    "http://tabs.ultimate-guitar.com/j/johnny_flynn/the_wrote_and_the_writ_ver2_crd.htm" => "Johnny Flynn - The Wrote and the Writ",
);

$app->get('/chords', function () use ($app, $chords) {
    asort($chords);
    return $app['twig']->render('chords.twig', array(
        'chords' => $chords,
    ));
})
->bind('chords');


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