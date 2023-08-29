<?php
require_once("C:\\xampp\\htdocs\\piDev2A\\config.php");
//include_once '../controllers/utilisateurController.php';
//include_once '../models/utilisateur.php';
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
                $hashedPassword = password_hash($user->getMdp(), PASSWORD_DEFAULT);

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
                    $hashedPassword,

                    
                ]);
            } catch (Exception $e) {
                echo 'Erreur: '.$e->getMessage();
            }
        }

        public function getUserById($id)
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
						age= :age,
						role=:role
                        
                        
						
					WHERE id= :id'
                );
                $query->execute([
                    
                    'nom' => $user->getNom(),
                    'prenom' =>$user->getPrenom(),
                    'email' => $user->getEmail(),
                    'age'=>$user->getAge(),
                    'role'=>$user->getRole(),
                    
                    'id' => $id
                    
                    
                ]);
                //echo $query->rowCount() . " records UPDATED successfully <br>";
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }


        public function connexionAdmin($email, $mdp)
{
    $sql = "SELECT * FROM utilisateur WHERE email=:email";
    $db = config::getConnection();
    
    try {
        $query = $db->prepare($sql);
        $query->execute(['email' => $email]);
        $count = $query->rowCount();
        $user = $query->fetch();
        
        if ($count == 0) {
            return "Utilisateur administrateur non trouvé.";
        } else {
            if (password_verify($mdp, $user['mdp'])) {
                // Vérifier si le rôle est administrateur
                if ($user['role'] === 'admin') {
                    return "Connexion réussie en tant qu'administrateur.";
                } else {
                    return "Vous n'avez pas les privilèges d'administrateur.";
                }
            } else {
                return "Mot de passe incorrect.";
            }
        }
    } catch (Exception $e) {
        return "Erreur : " . $e->getMessage();
    }
}



    public function searchUser($value){
        $db = config::getConnection();
        $sql = "SELECT * FROM utilisateur WHERE nom LIKE :search OR prenom LIKE :search OR role LIKE :search"; // Utilisez OR pour rechercher dans deux colonnes
    
        try {
            $req = $db->prepare($sql);
    
            // Ajoutez des signes de pourcentage au début et à la fin de la valeur de recherche
            $searchValue = $value . '%';
    
            // Liez la valeur de recherche à la requête en utilisant des paramètres nommés
            $req->bindParam(':search', $searchValue, PDO::PARAM_STR);
    
            $req->execute();
            $list = $req->fetchAll(); // Utilisez fetchAll pour obtenir tous les résultats
    
            return $list;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function getOrganisateurs()
{
    $sql = "SELECT * FROM utilisateur WHERE role = 'organisateur'";
    $db = config::getConnection();
    
    try {
        $query = $db->query($sql);
        $organisateurs = $query->fetchAll(PDO::FETCH_ASSOC);
        return $organisateurs;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
    
    

}


?>