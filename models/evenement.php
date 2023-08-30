<?php

	class Evenement{
		private $idevent;
		private $titre;
		private $dateevent;
		
		private $organisateur;
		private $description;
		private $idcategorie;

		
		
		function __construct($titre_event, $date_event, $organisateur_event, $description_event, $idcategorie_event){
			$this->titre=$titre_event;
			$this->dateevent=$date_event;
			
			$this->organisateur=$organisateur_event;
			$this->description=$description_event;
			$this->idcategorie = $idcategorie_event;
			
		}

		function getidevent(){
			return $this->idevent;
		}

		function gettitre(){
			return $this->titre;
		}

		function getdate_event(){
			return $this->dateevent;
		}

		

		function getorganisateur(){
			return $this->organisateur;
		}

		function getdescription(){
			return $this->description;
		}

		
		function settitre(string $titre_event){
			$this->titre=$titre_event;
		}

		function setdateevent(DateTime  $date_event){
			$this->dateevent=$date_event;
		}

		

		function setorganisateur(string $organisateur_event){
			$this->organisateur=$organisateur_event;
		}

		function setdescription(string $description_event){
			$this->description=$description_event;
		}

		function getidcategorie()
    {
        return $this->idcategorie;
    }

    function setidcategorie($idcategorie_event)
    {
        $this->idcategorie = $idcategorie_event;
    }
		
		
	}


?>