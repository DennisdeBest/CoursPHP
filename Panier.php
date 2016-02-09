


<?php
Class Panier {
    protected $ref;
    protected $nom;
    protected $prix;
    protected $tva;
    protected $qte;

    function __construct($ref, $nom, $prix, $tva=0.2, $qte=1){
        if(is_string($ref))
            $this->ref=$ref;
        else
            throw new Exception("Reference invalid");
        if(is_string($nom))
            $this->nom=$nom;
        else
            throw new Exception("Name invalid");
        if(is_float($prix))
            $this->prix=$prix;
        else
            throw new Exception("Price invalid");
        if(is_float($tva))
            $this->tva=$tva;
        else
            throw new Exception("Taxe invalid");
        $this->setQte($qte);
    }

    public function getRef()
    {
        return $this->ref;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function getTva()
    {
        return $this->tva;
    }

    public function getQte()
    {
        return $this->qte;
    }

    public function setQte($qte) {
        if($qte >= 0 && is_int($qte))
        $this->qte = $qte;
    }

    public function getVATValue(){
        return $this->qte*$this->prix*$this->tva;
    }

    public function getTTC(){
        return $this->qte*$this->prix+$this->getVATValue();
    }
    public function printResult() {
        $totalHT = $this->qte*$this->prix;
        $totalTTC = $totalHT + ($totalHT*$this->tva);
        echo "Référence : ".$this->ref." Nom : ".$this->nom." Prix Unitaire : ".$this->prix."€ TVA : ".($this->tva*100)."%".PHP_EOL.
            "Qte : ".$this->qte." Prix total HT : ".$totalHT."€ Prix TTC : ".$totalTTC."€";
    }
    public function __toString()
    {
        return "Référence : ".$this->ref." Nom : ".$this->nom." Prix Unitaire : ".$this->prix."€ TVA : ".($this->tva*100)."%".PHP_EOL.
        "Qte : ".$this->qte." Prix total HT : ".$this->qte*$this->prix."€ Prix TTC : ".number_format($this->$this->getTTC(),2)."€";
    }
}
try {
    $p = new Panier("Xc0012", "RedBull", 2.0, 0.2);
    $p->setQte(113);
} catch (Exception $e) {
    echo $e->getMessage();
}
//$p->printResult();
echo $p;

