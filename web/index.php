<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

if ($_SERVER["HTTP_HOST"] == 'jablecki.loc') {
    $app['debug'] = true;
}
$app['debug'] = true;

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

$items = array(
    'current' => array(
        'Ridiculous <a href="https://docs.google.com/spreadsheet/pub?key=0AjuNCAcSURT6dFJyc0t5N1F0WWlMTWF1OVY2MlJZMXc&single=true&gid=0&output=html">Starbucks Coffee of the Day + Syrup Chart</a>',
        'Consolidated <a href="http://blog.jablecki.org">Blog</a>.',
        'Some of my favorite <a href="' . '/chords' . '">chords/tabs</a> to play guitar.',
        'Buenos Aires <a href="/bike">Social Bike Shop Map</a>.',
        '<del>Still being amazed by <a href="http://www.linode.com/?r=8272b3593b0ab7ca3e5b4e4caae33bf6042cd12c">linode</a>.</del> Linode is still amazing, but I\'ve switched to <a href="https://clientarea.ramnode.com/aff.php?aff=128">Ramnode</a>. Good prices, lots of ram',
        'My favorite place to catch up on tech <a href="http://news.ycombinator.com/">Hacker News</a>.',
        'Find me on twitter <a href="http://twitter.com/jabowocky">@jabowocky</a>.',
        'My <a href="' . '/cv' . '">CV/Resume</a>.',
        '<a href="' . '/pug' . '">Pugs</a> for Gaby.'
    ),
    'old' => array(
        'Group Gift was laid waste - casualty to a sloppy Symfony upgrade. To be revived! (Ruby?)',
        'Freelance launched (and disbanded) with my genius friends <a href="http://codenotion.com">codeNotion</a>.',
        'The long past <a href="http://olxbeardcontest.blogspot.com">beard contest</a> at one of my <a href="http://www.olx.com">previous jobs</a>.',
        // 'A quick net-art page <a href="http://jablecki.org/options.php">Options</a>.',
        'A fun past project, <a href="http://bragproof.com/">BragProof</a>, sitting quietly with ~30 users per day. Probably bots.',
    ),
);

$app->get('/cv', function () use ($app) {
    return $app['twig']->render('cv.twig', array());
})
->bind('cv');

$chords = array(
    "http://www.ezfolk.com/uke/chords/" => "! Slow but complete chord reference for Ukulele",
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
    "http://tabs.ultimate-guitar.com/t/the_avett_brothers/paranoia_in_bb_major_ver3_crd.htm" => "Avett Brothers - Paranoia In Bb Major",
    "http://tabs.ultimate-guitar.com/t/the_avett_brothers/die_die_die_ver3_crd.htm" => "Avett Brothers - Die Die Die",
    "http://tabs.ultimate-guitar.com/t/the_avett_brothers/incomplete_and_insecure_crd.htm" => "Avett Brothers - Incomplete And Insecure",
    "http://tabs.ultimate-guitar.com/t/the_avett_brothers/ill_with_want_crd.htm" => "Avett Brothers - Ill With Want",
    "http://tabs.ultimate-guitar.com/m/mountain_goats/no_children_ver3_crd.htm" => "Mountain Goats - No Children",
    "http://tabs.ultimate-guitar.com/f/fiona_apple/not_about_love_crd.htm" => "Fiona Apple - Not About Love",
    "http://www.gotaukulele.com/2011/06/sleeping-by-myself-eddie-vedder-ukulele.html" => "Eddie Vedder - (Ukulele) Sleeping By Myself",
    "http://www.ukulele-tabs.com/uke-songs/eddie-vedder/sleeping-by-myself-uke-tab-19853.html" => "Eddie Vedder - (Ukulele) Sleeping By Myself v2",
    "http://tabs.ultimate-guitar.com/w/weezer/my_name_is_jonas_tab.htm" => "Weezer - My Name is Jonas",
);

function getPugPic()
{
    $json_url = 'http://pugme.herokuapp.com/random';
    $ch = curl_init( $json_url );
    $options = array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array('Content-type: application/json') ,
    );
    curl_setopt_array( $ch, $options );
    $result =  curl_exec($ch); // Getting jSON result string
    $pugpic = json_decode($result);
    return $pugpic->pug;
}

$app->get('/chords', function () use ($app, $chords) {
    asort($chords);
    return $app['twig']->render('chords.twig', array(
        'chords' => $chords,
    ));
})
->bind('chords');

$app->get('/pug', function () use ($app) {
    $pugpic = getPugPic();
    return $app['twig']->render('pug.twig', array(
        'pugpic' => $pugpic,
    ));
})
->bind('pug');

$app->get('/', function () use ($app, $items) {
    return $app['twig']->render('index.twig', array(
        'items' => $items,
    ));
})
->bind('index');

$app->get('/bike', function () use ($app) {
    return $app['twig']->render('bike.twig', array(
    ));
})
->bind('bike');

$app->get('/images/{file}', function ($file) use ($app) {
    if (!file_exists(__DIR__.'/images/'.$file)) {
        return $app->abort(404, 'The image was not found.');
    }

    $stream = function () use ($file) {
        readfile($file);
    };

    return $app->stream($stream, 200, array('Content-Type' => 'image/png'));
});

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
