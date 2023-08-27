<?php

class Categorie{
    private $idcategorie;
    private $nomcategorie;
    private $imgcatg;
    

    public function __construct($nomcategorie,$imgcatg) {
        $this->nomcategorie=$nomcategorie;
        $this->imgcatg = $imgcatg;
    }

    public function getIdCategorie(){
        return $this->idcategorie;
    }

    public function getNomCategorie(){
        return $this->nomcategorie;
    }
    public function setNomCategorie(string $nom){
        $this->nomcategorie = $nom;
    }

    public function getImgCatg(){
        return $this->imgcatg;
    }
    public function setImgCatg(string $img){
        $this->imgcatg = $img;
    }

}
?>