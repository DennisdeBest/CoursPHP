<?php

require_once 'vendor/autoload.php';
$app = new \Slim\App;

$app->get('/', function ($request, $response, $args) {
    require_once("DB.php");
    $stt = DB::getInstance()->prepare('SELECT * FROM `jeu_video`');
    $stt->execute();
    $temp ="";
    while ($row = $stt->fetch()) {
        //$data[] = $row;
        $nom = $row['nom'];
        $temp .= "<a href='$nom'>".$row["nom"].PHP_EOL."</a><br />";
    }
    return $response->write($temp);
});
$app->get('/{name}', function ($request, $response, $args) {
    require_once("DB.php");
    $nom = $args['name'];
    $stt = DB::getInstance()->prepare("SELECT * FROM `jeu_video` WHERE nom='$nom'");
    $stt->execute();
    $temp ="";
    while ($row = $stt->fetch()) {
        $temp .= "Nom : ".$row["nom"].PHP_EOL."<br />".
            "Possesseur : ".$row["possesseur"].PHP_EOL."<br />".
            "Console : ".$row["console"].PHP_EOL."<br />".
            "Commentaire : ".$row["commentaires"].PHP_EOL."<br />";
    }
    return $response->write($temp);
});
$app->run();


// Run app
