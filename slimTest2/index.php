<?php

require_once 'vendor/autoload.php';

$app = new \Slim\App;

// Define app routes

$app->get('/', function ($request, $response, $args) {
    $content = file_get_contents('pages/index.tpl');
    $data = array('title' => 'Coucou !!',
        'subtitle' => 'Accueil',
        'link_url' => 'contact',
        'link_name' => 'Page contact');
    foreach ($data as $k => $v){
        $content = str_replace('{{' . $k . '}}', $v, $content);
}
    return $response->write($content);
});
$app->get('/contact', function ($request, $response, $args) {
    $content = file_get_contents('pages/index.tpl');
    $data = array('title' => 'Contact',
        'subtitle' => 'Contact',
        'link_url' => '../slimTest2/',
        'link_name' => 'Accueil');
    foreach ($data as $k => $v){
        $content = str_replace('{{' . $k . '}}', $v, $content);
    }
    return $response->write($content);
});

// Run app
$app->run();