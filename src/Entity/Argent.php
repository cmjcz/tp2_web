<?php

namespace App\Entity;

class Argent{

    private $somme = 0;
    public function getSomme(){
        return $this->somme;
    }

    public function setSomme(int $sum){
        $this->somme = $sum;
    }
}

?>