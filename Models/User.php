<?php
require_once("Database.php");

//ToDo: cambiar los atributos por los de la base de datos(cuando la tenga)
class User extends Database {
    private   $name;
    private   $password;

    /*Getters*/

    function getName() {
        return $this->name;
    }

    function getPassword() {
        return $this->password;
    }

    /*setters*/

    function setName($name) {
        $this->name = $name;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    /*Methods*/

    public function validateStudent($email,$password) {
        $stmt = $this->db->prepare("SELECT * FROM alumnes WHERE Email = :email AND Password = :password");
        $stmt->execute([':email' => "$email",':password' => "$password"]);
        return $stmt;
    }

    public function validateProfessor($email,$password) {
        $stmt = $this->db->prepare("SELECT * FROM professors WHERE Email = :email AND Password = :password AND Activado = 1");
        $stmt->execute([':email' => "$email",':password' => "$password"]);
        return $stmt;
    }

    public function registerUser($dni,$email,$nom,$cognoms,$edat,$foto) {
        $stmt = $this->db->prepare("INSERT INTO alumnes VALUES(:dni, :email, :nom, :cognoms, :edat, :foto, :password");
        $stmt->execute([':dni' => "$dni",':email' => $email, ':nom' => "$nom",':cognoms' => "$cognoms",':edat' => "$edat",':foto' => "$foto"]);
        return $stmt;  
    }
    

}

?>