<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<style>
    .green {color:green}
    .red {color:red}
    .blue {color:blue}
    .red,.green, .blue {font-weight: 700;}
    body{
        background-color: darkgrey;
    }
    #mainContent{
        margin: auto;
        width:30%;
        padding-top:25px;
        padding-bottom: 25px;
        font-family: Georgia, serif;
        border: groove 3px black;
        background-color: white;
        text-align: center;
        position: relative
    }
    h1{
        text-decoration: underline;
    }
    #stat{
        position: absolute;
        top : -10px;
        left : 10px;
    }
</style>
<body>
<div id="mainContent">
<h1>Ultimate Fighting</h1>
</br>
<?php
//Main class Perso
Class Perso {
    protected $Name;

    public function getName()
    {
        return $this->Name;
    }
    protected $HP;
    protected $Multiplier;

    public function getMultiplier()
    {
        return $this->Multiplier;
    }
    protected $Damage;


    public function getHP()
    {
        return $this->HP;
    }

    public function setHP($HP)
    {
        $this->HP = $HP;
    }

    function __construct($Name,$HP, $Multiplier){
        $this->Name=$Name;
        $this->HP = $HP;
        $this->Multiplier = $Multiplier;
    }
    final function pas(){
        $this->HP -= $this->getMultiplier();
        echo $this->Name." Takes a step and has : <span class='blue'>".$this->getHP()."</span> HP".PHP_EOL."<br>";
    }
    final function doDamage(Perso $other){
        $rand = rand(5, 25)*$this->Multiplier;

        $other->setHP($other->getHP()-$rand);
        echo $this->Name." Does <span class='red'>".$rand."</span> HP damage to ".$other->getName().PHP_EOL."<br>";
    }
    final function death(){
        echo "<strong><br>";
        echo $this->Name." is dead".PHP_EOL."<br>";
        echo "</strong>";
    }
}
//Magician class
Class Magician extends Perso{
    function __construct($Name="Magician",$HP = 100, $Multiplier=1){
        $this->Name=$Name;
        $this->HP = $HP;
        $this->Multiplier = $Multiplier;
        echo $this->Name." Says : Hello".PHP_EOL."<br>";;
    }
}
//Troll class
Class Troll extends Perso{
    function __construct($Name="Troll",$HP = 50, $Multiplier=2){
        $this->Name=$Name;
        $this->HP = $HP;
        $this->Multiplier = $Multiplier;
        echo $this->Name." Says : Grrr".PHP_EOL."<br>";
    }
    //Troll has 1 out of 5 chance to get some health back
    function Heal(){
        $rand = rand(1,5);
        $rand2 = rand (10, 40);
        if($rand == 2){
            $this->setHP($this->getHP()+$rand2);
            echo $this->getName()." Has a beer and regains <span class='green'>".$rand2."</span> HP".PHP_EOL."<br>";
        }
    }
}
//Connect to database and update values
function writeToDB($a,$b){
     try {
         $dbh = new PDO('mysql:host=localhost;dbname=CoursPHP', "root", "11Dennis");
         $dbh->query("UPDATE jeu SET mWin=mWin+$a WHERE id=1");
         $dbh->query("UPDATE jeu SET tWin=tWin+$b WHERE id=1");
         //echo "UPDATE jeu SET tWin=tWin+$b WHERE id=1";
         $dbh = null;
     } catch (PDOException $e) {
         print "Erreur !: " . $e->getMessage() . "<br/>";
         die();
     }
}
//Connect to database and return the first row
function displayDB(){
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=CoursPHP', "root", "11Dennis");
        $sql = $dbh->prepare("SELECT * FROM jeu");
        $sql->execute();
        $result = $sql->fetch();
        echo "<br>Troll won ".$result ["tWin"]." times <br>";
        echo "Magician won ".$result ["mWin"]." times";
        $dbh = null;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
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

//Instanciate characters
$m = new Magician();
$t = new Troll();
echo "<br>";
// Fight loop
for ($x = 0; $x <= 10; $x++){
    if($m->getHP()>$m->getMultiplier()) {

        $m->pas();
        $m->doDamage($t);
        if($t->getHP()<=0){
            $t->death();
            writeToDB(1,0);
            break;
        }
        echo "<br>";;
    }
    else {
        $t->death();
        writeToDB(0,1);
        break;
    }
    if($t->getHP()>$t->getMultiplier()) {
        $t->pas();
        $t->doDamage($m);
        if($m->getHP()<=0){
            $m->death();
            writeToDB(0,1);
            break;
        }
        $t->Heal();
        echo "<br>";;
    }
    else {
        $t->death();
        writeToDB(1,0);
        break;
    }

}

//Display stats
displayDB();
?>
<div id="stat">
    <br>
    <br>
    <input type="submit" value="Try again !" onclick='window.location.reload()'/>
    <br>
    <br>
    <!--<input type="button" value="Reset stats" onclick=/>-->
</div>

    <div id="reset">
        <form action="resetDB.php" method="post">
        <input type="submit" value="Reset" />
        </form>
    </div>

</div>
</body>
</html>