<?php
class Magic {
    private $names = array('id','name', 'date');
    private $attrs = array();

    public function __get($name)
    {
        if(in_array($name, $this->names) && isset($name));
            return $this->attrs[$name];
    }
    public function __set($name, $value)
    {
        if (in_array($name, $this->names))
            $this->attrs[$name] = $value;
    }
    public function __isset($name)
    {
        return in_array($name, $this->names);
    }
    public function __unset($name)
    {
        if(isset($name))
            unset($this->attrs[$name]);
    }
    public function __call($name, $arguments)//public static function __callStatic idem
    {
        echo 'Appel méthode '.$name.' avec arguments '.$arguments.implode(',',$arguments).PHP_EOL;
    }
}


$m = new Magic;
$m->toto = 'Hello';
echo $m->toto;
$m->mamethode('lol', 'bla');


?>