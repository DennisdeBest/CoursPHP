<?php
require_once("DB.php");
$stt = DB::getInstance()->query('SELECT * FROM `jeu_video`');
$stt->execute();
//$stt->setFetchMode(PDO::FETCH_ASSOC);
while ($row = $stt->fetch()) {
    $data[] = $row;
    echo $row["nom"]."\t";
}