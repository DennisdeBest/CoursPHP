<head>
    <meta charset="UTF-8">
</head>

<?php
require_once('DB.php');
abstract class Entity {
    private $table;
    private $fields, $args;

    public function __construct($table, $fields)
    {
        $this->table = $table;
        $this->fields = $fields;
    }

    public function __toString()
    {
        return get_class($this);
    }
    public function __get($name)
    {
        if(in_array($name, $this->fields) && isset($name));
        return $this->args[$name];
    }
    public function __set($name, $value)
    {
        if (in_array($name, $this->fields))
            $this->args[$name] = $value;
    }
}

class User extends Entity{
    public function __construct($table, $fields)
    {
        parent::__construct('user', array('id', 'firstname', 'lastname', 'email'));
    }
    public function __toString()
    {
        return 'User ['.$this->id.'] '.$this->firstname.' '. $this->lastname.' email : '.$this->email .PHP_EOL.'<br>';
    }
}
class Product extends Entity{
    public function __construct($table, $fields)
    {
        parent::__construct('product', array('id', 'name','description','price'));
    }
}

$stt = DB::getInstance()->query('SELECT * FROM user');
$stt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
while ($row = $stt->fetch()) {
    echo $row;
}