<?php
require_once("Database.php");

//ToDo: cambiar los atributos por los de la base de datos(cuando la tenga)
class Alumno extends Database {
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

    public function getSelectedStudent($email) {
        $stmt = $this->db->prepare("SELECT * FROM alumnes WHERE Email = :email");
        $stmt->execute([':email' => "$email"]);
        return $stmt;    
    }

    public function updateStudent($dni,$nom,$cognoms,$edat,$email) {
        $stmt = $this->db->prepare("UPDATE alumnes SET DNI = :dni, Nom = :nom, Cognoms = :cognoms, Edat = :edat WHERE Email = :email");
        $stmt->execute([':dni' => "$dni",':nom' => "$nom",':cognoms' => "$cognoms",':edat' => "$edat",':email' => "$email"]);
        return $stmt;  
    }

    public function updateStudentPicture($foto,$email) {
        $stmt = $this->db->prepare("UPDATE alumnes SET Foto = :foto WHERE Email = :email");
        $stmt->execute([':foto' =>"$foto",':email' => "$email"]);
        return $stmt; 
    }

}

?>