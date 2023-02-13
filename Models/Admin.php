<?php
require_once("Database.php");

//ToDo: cambiar los atributos por los de la base de datos(cuando la tenga)
class Admin extends Database {
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

    public function validateAdmin($nombre,$password) {
        $stmt = $this->db->prepare("SELECT * FROM admin WHERE Nombre = :nombre AND Password = :password");
        $stmt->execute([':nombre' => "$nombre",':password' => "$password"]);
        return $stmt;
    }

}

?>

