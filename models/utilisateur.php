<?php 
class Utilisateur {
    private $id = null;
    private $nom = null;
    private $prenom = null;
    private $email = null;
    private $age = null;
    private $role = null;
    private $mdp = null;

    public function __construct($nom, $prenom, $email, $age, $role, $mdp){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->age = $age;
        $this->role = $role;
        $this->mdp = $mdp;
    }

    public function getId(){
        return $this->id;
    }

    public function getNom(){
        return $this->nom;
    }
    public function setNom(string $Nom){
        $this->nom = $Nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }
    public function setPrenom(string $Prenom){
        $this->prenom = $Prenom;
    }

    public function getAge(){
        return $this->age;
    }
    public function setAge(int $Age){
        $this->age = $Age;
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail(string $Email){
        $this->email = $Email;
    }

    public function getMdp(){
        return $this->mdp;
    }
    public function setMdp(string $Mdp){
       // $this->mdp = password_hash ($Mdp , PASSWORD_DEFAULT); // hash
       $this->mdp = $Mdp;
    }

    public function getRole(){
        return $this->role;
    }
    public function setRole(string $Role){
        $this->role = $Role;
    }
    }

?>