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
public function getUserByEmail($email) {
    $sql = "SELECT * FROM utilisateur WHERE email = :email";
    $db = config::getConnection();
    try {
        $query = $db->prepare($sql);
        $query->execute(['email' => $email]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        return $user;
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}

public function connexionUtilisateur($email, $mdp)
{
    $sql = "SELECT * FROM utilisateur WHERE email=:email";
    $db = config::getConnection();

    try {
        $query = $db->prepare($sql);
        $query->execute(['email' => $email]);
        $count = $query->rowCount();
        $user = $query->fetch();

        if ($count == 0) {
            return "Utilisateur non trouvé.";
        } else {
            if (password_verify($mdp, $user['mdp'])) {
                // Vérifier si le rôle est "participant" ou "organisateur"
                if ($user['role'] === 'participant' || $user['role'] === 'organisateur') {
                    return "Connexion réussie en tant qu'utilisateur";
                } else {
                    return "Vous n'avez pas les privilèges pour vous connecter.";
                }
            } else {
                return "Mot de passe incorrect.";
            }
        }
    } catch (Exception $e) {
        return "Erreur : " . $e->getMessage();
    }
}


public function emailEstUnique($email) {
    $db = config::getConnection();
    $sql = "SELECT COUNT(*) as count FROM utilisateur WHERE email = :email";
    
    try {
        $query = $db->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        // Si count est égal à 0, l'email est unique
        return $result['count'] == 0;
    } catch (PDOException $e) {
        die('Erreur: ' . $e->getMessage());
    }
}


public function inscriptionUtilisateur($nom, $prenom, $email, $age, $role, $mdp) {
    // Vérifier si l'email est unique
    if ($this->emailEstUnique($email)) {
        // Hacher le mot de passe
        //$hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);

        // Créer un nouvel objet Utilisateur
        $nouvelUtilisateur = new Utilisateur($nom, $prenom, $email, $age, $role, $mdp);

        // Ajouter l'utilisateur à la base de données
        // Vous devrez utiliser une requête SQL INSERT INTO ici

        // Gérer les erreurs et renvoyer un message de succès ou d'erreur
        if ($this->ajouterUtilisateur($nouvelUtilisateur)) {
            return "Inscription réussie !";
        } else {
            return "Erreur lors de l'inscription. Veuillez réessayer.";
        }
    } else {
        return "Cet email est déjà utilisé. Veuillez choisir un autre email.";
    }
}



    
    

}


?>