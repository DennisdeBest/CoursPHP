<?php

require_once 'vendor/autoload.php';
$app = new \Slim\App;
$pdo = new \Slim\PDO\Database('mysql:host=localhost;dbname=CoursPHP;', 'root', '11Dennis');



$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('views', [
        'cache' => false
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));

    return $view;
};












$app->get('/', function ($request, $response, $args) {
    require_once("DB.php");
    global $pdo;
    $stt = $pdo->select()->from('jeu_video')->execute();
    $jeux = $stt->fetchAll(PDO::FETCH_OBJ);
    return $this->view->render($response, 'jeux.twig', [
        'jeux' => $jeux
    ]);



    /*
     $rows = array('<table>');
    $rows[] = '<tr><th>ID</th><th>Nom</th></tr>';
    while ($row = $stt->fetch(PDO::FETCH_OBJ)) {
        $nom = $row->nom;
        $rows[] = '<tr><td>'.$row->ID."</td><td><a href='$nom'>".$row->nom.'</a></td></tr>';
    }
    $rows[] = '</table>';
    $input = file_get_contents('pages/liste.tpl');
    $output = str_replace('{{jeux}}', implode(PHP_EOL, $rows), $input);
    return $response->write($output);*/
});
$app->get('/{name}', function ($request, $response, $args) {
    require_once("DB.php");
    $nom = $args['name'];
    global $pdo;
    $stt = $pdo->select()->from('jeu_video')->where('nom', '=', $nom)->execute();
    $jeu = $stt->fetch(PDO::FETCH_OBJ);

    return $this->view->render($response, 'jeu.twig', [
        'jeu' => $jeu
        ]);

    /*
    $input = file_get_contents('pages/jeu.tpl');
    $data = array('ID' => $row->ID,
        'nom' => $row->nom,
        'console' => $row->console);
    foreach ($data as $k => $v) {
        $input = str_replace('{{' . $k . '}}', $v, $input);
    }
    return $response->write($input);*/
});
    $app->run();


// Run app
