<?php
function resetDB(){
try {
$dbh = new PDO('mysql:host=localhost;dbname=CoursPHP', "root", "11Dennis");
$dbh->query("UPDATE jeu SET mWin=0 WHERE id=1");
$dbh->query("UPDATE jeu SET tWin=0 WHERE id=1");
$dbh = null;
} catch (PDOException $e) {
print "Erreur !: " . $e->getMessage() . "<br/>";
die();
}
}

resetDB();
header('Location: Jeu.php');

?>