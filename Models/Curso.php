<?php
require_once("Database.php");

//ToDo: cambiar los atributos por los de la base de datos(cuando la tenga)
class Curso extends Database {
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

    public function getAllCourses() {
        $stmt = $this->db->prepare("SELECT Codi,Nom,Descripcio,Hores_Duracio,Data_Inici,Data_Final FROM cursos WHERE Activado = 1");
        $stmt->execute();
        return $stmt;
    }

}

?>