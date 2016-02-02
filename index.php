<html>
<head>
    <meta charset="UTF-8">
</head>
<?php
class Vehicule {


    private $immat;
    public function __construct($immat) {
        $this->immat = $immat;
        echo 'Nouveau véhicule: ' . $this->immat . PHP_EOL;
    }
    public function __destruct() {
        echo '-> destruction: ' . $this->immat . PHP_EOL;
    }
}

$v = new Vehicule("ABC-123"); // affiche "Nouveau véhicule: ABC-123"
unset($v);  // affiche "-> destruction: ABC-123"
?>

</html>
