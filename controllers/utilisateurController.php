<?php
require_once("C:\\xampp\\htdocs\\piDev2A\\config.php");
//include_once '../config.php';
//include_once '../models/utilisateur.php';

class UtilisateurController{
    
    public function afficherUtilisateur()
        {
            $sql="SELECT * FROM utilisateur";
            $db = config::getConnection();
            try {
                $liste = $db->query($sql);
				
                return $liste;
            } catch (Exception $e) {
                die('Erreur:'. $e->getMessage());
            }
        }

        public function supprimerUtilisateur($id)
        {
            $sql="DELETE FROM utilisateur WHERE id=:id";
            $db = config::getConnection();
            $req=$db->prepare($sql);
			
            $req->bindValue(':id', $id);
            try {
                $req->execute();
            } catch (Exception $e) {
                die('Erreur:'. $e->getMessage());
            }
        }

        public function ajouterUtilisateur($user)
        {
            //$sql="INSERT INTO utilisateur ( id, nom, prenom, email, age,role, mdp) VALUES (DEFAULT, :nom, :prenom, :email, :age,:role, :mdp)";
            //$sql = "INSERT INTO utilisateur(nom, prenom, email, age, role, mdp) VALUES (:nom, :prenom, :email, :age,:role, :mdp)";
            $sql="INSERT INTO utilisateur (nom, prenom, email, age, role, mdp) VALUES (?,?,?,?,?,?)";
            $db = config::getConnection();
            try {
                $query = $db->prepare($sql);
                $query->execute([
                    /*
                    'nom' => $user->getNom(),
                    'prenom' => $user->getPrenom(),
                    'email' => $user->getEmail(),
                    'age' => $user->getAge(),
                    'role' => $user->getRole(),
                    'mdp' => $user->getMdp(),
                    
*/
                    $user->getNom(),
                    $user->getPrenom(),
                    $user->getEmail(),
                    $user->getAge(),
                    $user->getRole(),
                    $user->getMdp(),

                    
                ]);
            } catch (Exception $e) {
                echo 'Erreur: '.$e->getMessage();
            }
        }

        public function getUser($id)
        {
            $sql="SELECT * from utilisateur where id = $id";
            $db = config::getConnection();
            try {
                $query=$db->prepare($sql);
                $query->execute();

                $user=$query->fetch();
                return $user;
            } catch (Exception $e) {
                die('Erreur: '.$e->getMessage());
            }
        }

        public function modifierUtilisateur($user, $id)
        {
            try {
                $db = config::getConnection();
                $query = $db->prepare(
                    'UPDATE utilisateur SET 
						
						nom= :nom, 
                        prenom = :prenom,
						email= :email, 
						
						role=:role
						
					WHERE id= :id'
                );
                $query->execute([
                    
                    'nom' => $user->getNom(),
                    'prenom' =>$user->getPrenom(),
                    'email' => $user->getEmail(),
                    
                    'role'=>$user->getRole(),
                    'id' => $id
                    
                    
                ]);
                //echo $query->rowCount() . " records UPDATED successfully <br>";
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }
}


?>