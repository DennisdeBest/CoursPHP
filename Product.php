<?php
abstract Class Product {
    protected $ref;
    protected $name;
    protected $price;
    protected $VAT;
    protected $qty;

    public function __construct($ref, $name, $price, $VAT=0.2, $qty=1){
    $this->ref=$ref;
    $this->name=$name;
    $this->price=$price;
    $this->VAT=$VAT;
    $this->qty=$qty;
    }
    abstract function getPrice();
    abstract function getVAT();
    abstract function totalPrice();
    abstract function setQty($qty);
    function __toString()
    {
        return "Price : ".$this->price;
    }
}
Class Computer extends Product{

    function getPrice(){
        return $this->price*$this->qty;
    }
    function getVAT(){
        return $this->price*$this->VAT*$this->qty;
    }
    function totalPrice(){
        return $this->price*$this->VAT*$this->qty + $this->price*$this->qty;
    }
    function setQty($qty){
        $this->qty=$qty;
    }
}
Class Contract extends Product{
    function __construct($ref, $name, $price, $VAT=0, $qty=1)
    {
        parent::__construct($ref, $name, $price, $VAT=0, $qty=1);
    }

    function getPrice(){
        return $this->price*$this->qty;
    }
    function getVAT(){
        return $this->price*$this->VAT*$this->qty;
    }
    function totalPrice(){
        return $this->price*$this->qty;
    }
    function setQty($qty){
        if($qty<13)
            $this->qty=$qty;
        else
            echo "Must be 12 or less";
    }
}

$c = new Computer("xxxxx", "comp1", 100);
$c->setQty(10);
echo $c.PHP_EOL;
echo $c->getVAT().PHP_EOL;
echo $c->totalPrice().PHP_EOL;

$d = new Contract("cccc", "Internet", 33.95);
$d->setQty(10);
echo $d.PHP_EOL;
echo $d->getPrice();
echo $d->totalPrice();