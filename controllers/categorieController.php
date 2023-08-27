<?php
require_once("C:\\xampp\\htdocs\\piDev2A\\config.php");


class CategorieController{
    public function afficherCategorie(){
        $sql="SELECT * FROM categorie";
        $db = config::getConnection();
        try{
            $liste = $db->query($sql);
            return $liste;
        }catch (Exception $e) {
            die('Erreur:'. $e->getMessage());
        }
    }

    public function supprimerCategorie($idcategorie ){
        $sql= "DELETE from categorie where idcategorie=:idcategorie";
        $db = config::getConnection();
        $req=$db->prepare($sql);
        $req->bindValue(':idcategorie', $idcategorie);
        try {
            $req->execute();
            
        } catch (Exception $e) {
            die('Erreur:'. $e->getMessage());
        }
    }

    public function ajouterCategorie($categ){
        $sql = "INSERT INTO categorie (nomcategorie,imgcatg) VALUES (?,?)";
        $db = config::getConnection();
        try{
            $query = $db->prepare($sql);
            $query->execute([
                $categ->getNomCategorie(),
                $categ->getImgCatg(),
            ]);
        }catch (Exception $e) {
            echo 'Erreur: '.$e->getMessage();
        }
    }

    public function getCategoryById($idcategorie){
        $sql = "SELECT * from categorie where idcategorie = $idcategorie";
        $db = config::getConnection();
        try{
            $query = $db->prepare($sql);
            $query->execute();

            $categorie = $query->fetch();
            return $categorie;
        }catch (Exception $e) {
            die('Erreur: '.$e->getMessage());
        }
    }

    public function modifierCategorie($categ, $idcategorie){
        try{
            $db = config::getConnection();
            $query = $db->prepare(
                'UPDATE categorie SET
                nomcategorie= :nomcategorie,
                imgcatg= :imgcatg
                where idcategorie = :idcategorie'
            );
            $query->execute([
                'nomcategorie' => $categ->getNomCategorie(),
                'imgcatg' => $categ->getImgCatg(),
                'idcategorie' => $idcategorie
            ]);
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }
    
}
?>