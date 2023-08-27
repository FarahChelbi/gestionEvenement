<?php
require_once("C:\\xampp\\htdocs\\piDev2A\\config.php");

class EvenementController{
    public function afficherEvenement(){
        $sql = "SELECT * FROM evenement";
        $db = config::getConnection();
        try{
            $liste = $db->query($sql);
            return $liste;
        }catch (Exception $e) {
            die('Erreur:'. $e->getMessage());
        }
    }

    public function supprimerEvenement($idevent){
        $sql = "DELETE FROM evenement WHERE idevent=:idevent";
        $db = config::getConnection();
        $req=$db->prepare($sql);
        $req->bindValue(':idevent', $idevent);
        try {
            $req->execute();
            
        } catch (Exception $e) {
            die('Erreur:'. $e->getMessage());
        }
    }

    public function ajouterEvenement($event){
        $sql = "INSERT INTO evenement (titre,dateevent,organisateur,description) VALUES (?,?,?,?)";
        $db = config::getConnection();
        try{
            $query = $db->prepare($sql);
            $query->execute([
                $event->gettitre(),
                $event->getdate_event(),
                $event->getorganisateur(),
                $event->getdescription(),
            ]);
        }catch (Exception $e) {
            echo 'Erreur: '.$e->getMessage();
        }
    }

    public function getEventById($idevent){
        $sql = "SELECT * FROM evenement where idevent = $idevent";
        $db = config::getConnection();
        try{
            $query = $db->prepare($sql);
            $query->execute();

            $event = $query->fetch();
            return $event;
        }catch (Exception $e) {
            die('Erreur: '.$e->getMessage());
        }
    }

    public function modifierEvenement($event, $idevent){
        try{
            $db = config::getConnection();
            $query = $db->prepare(
                'UPDATE evenement SET
                titre= :titre,
                dateevent= :dateevent,
                organisateur= :organisateur,
                description= :description
                where idevent = :idevent'
            );
            $query->execute([
                'titre' => $event->gettitre(),
                'dateevent' => $event->getdate_event(),
                'organisateur' =>$event->getorganisateur(),
                'description' => $event->getdescription(),
                'idevent' => $$idevent
            ]);
        }catch (PDOException $e) {
            $e->getMessage();
        }
     }
}


?>