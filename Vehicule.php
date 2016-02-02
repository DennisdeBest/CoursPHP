<?php
abstract class MyClass {
    private static $cnt = 0;
    public static function getCount() { return static::$cnt; }
    private $id;
    public function __construct() {
        $this->id = self::$cnt++;
        //echo 'Class #' . $this->id . PHP_EOL;
    }
}
Class MySon extends MyClass
{
    protected static $cnt = 0;
    private $id;
    public static function getCount() { return static::$cnt; }
    public function __construct() {
        parent::__construct();
        $this->id = self::$cnt++;
        echo 'Son #' . $this->id . PHP_EOL;
    }
}
Class MyDaughter extends MyClass
{
    protected static $cnt = 0;
    private $id;
    public static function getCount() { return static::$cnt; }
    public function __construct() {
        parent::__construct();
        $this->id = self::$cnt++;
        echo 'Daughter #' . $this->id . PHP_EOL;
    }
}

function spawn(){
    $rand = rand(1,15);
    $rand2 = rand(1,15);

    for ($x=0;$x<$rand;$x++){
        $a[] = new MySon();

    }
    for ($x=0;$x<$rand2;$x++){
        $b[] = new MyDaughter();
    }
   // for($x=0; $x<sizeof($a)+sizeof($b);$x++)

}
spawn();
echo 'Il y a ' . MyClass::getCount() . ' instance de myClass' . PHP_EOL;
echo 'Il y a ' . MyDaughter::getCount() . ' instance de myDaughter' . PHP_EOL;
echo 'Il y a ' . MySon::getCount() . ' instance de mySon' . PHP_EOL;
//echo 'Il y a ' . MyClass::getCount() . ' instance de myClass' . PHP_EOL;