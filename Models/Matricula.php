<?php
require_once("Database.php");

//ToDo: cambiar los atributos por los de la base de datos(cuando la tenga)
class Matricula extends Database {
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

    public function getAssociatedMatriculations($dni,$codi) {
        $stmt = $this->db->prepare("SELECT * FROM matricula WHERE DNI = :dni AND Codi = :codi ");
        $stmt->execute([':dni' => "$dni", ':codi' => "$codi"]);
        return $stmt;    
    }

    public function getStudentEnrollments($dni) {
        $stmt = $this->db->prepare("SELECT c.Codi,c.Nom,c.Descripcio,c.Hores_Duracio,c.Data_Inici,c.Data_Final,c.DNI,m.Nota FROM matricula m INNER JOIN cursos c ON m.Codi = c.Codi WHERE m.DNI = :dni ");
        $stmt->execute([':dni' => "$dni"]);
        return $stmt;    
    }

}

?>