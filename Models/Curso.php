<?php
require_once("Database.php");

//ToDo: cambiar los atributos por los de la base de datos(cuando la tenga)
class Curso extends Database {
    private   $codi;
    private   $nom;
    private   $descripcio;
    private   $hores_duracio;
    private   $data_inici;
    private   $data_final;
    private   $dni;



    /*Methods*/

    public function getActiveCourses() {
        $stmt = $this->db->prepare("SELECT Codi,Nom,Descripcio,Hores_Duracio,Data_Inici,Data_Final FROM cursos WHERE Activado = 1");
        $stmt->execute();
        return $stmt;
    }

    public function getAllCourses() {
        $stmt = $this->db->prepare("SELECT * FROM cursos ORDER BY Codi");
        $stmt->execute();
        return $stmt;
    }

    public function getSelectedCourse($codi) {
        $stmt = $this->db->prepare("SELECT * FROM cursos WHERE Codi = :codi");
        $stmt->execute([':codi' => "$codi"]);
        return $stmt;
    }

    public function searchCourses($nombre) {
        $stmt = $this->db->prepare("SELECT * FROM cursos WHERE Nom LIKE :nombre");
        $stmt->execute([':nombre' => "$nombre%"]);
        return $stmt;
    }

    public function addCourse($nom,$descripcio,$hores_duracio,$data_inici,$data_final,$dni) {
        $stmt = $this->db->prepare("INSERT INTO cursos VALUES (DEFAULT,:nombre,:descripcio, :hores_duracio,:data_inici,:data_final,:dni,'1')");
        $stmt->execute([':nombre' => "$nom", ':descripcio' => "$descripcio", ':hores_duracio' => "$hores_duracio", ':data_inici' => "$data_inici", ':data_final' => "$data_final", ':dni' => "$dni"]);
        return $stmt;
    }

    public function updateCourse($descripcio,$hores_duracio,$data_inici,$data_final,$dni,$codi) {
        $stmt = $this->db->prepare("UPDATE cursos SET Descripcio = :descripcio, Hores_Duracio = :hores_duracio, Data_Inici = :data_inici, Data_Final = :data_final, DNI = :dni WHERE Codi = :codi");
        $stmt->execute([':descripcio' => "$descripcio",':hores_duracio' => "$hores_duracio",':data_inici' => "$data_inici",':data_final' => "$data_final",':dni' => "$dni",':codi' => "$codi"]);
        return $stmt;  
    }

    public function changeCourseStatus($query,$codi) {
        $stmt = $this->db->prepare($query);
        $stmt->execute([':codi' => $codi]);
        return $stmt;  
    }

    /**
     * Get the value of codi
     */ 
    public function getCodi()
    {
        return $this->codi;
    }

    /**
     * Set the value of codi
     *
     * @return  self
     */ 
    public function setCodi($codi)
    {
        $this->codi = $codi;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of descripcio
     */ 
    public function getDescripcio()
    {
        return $this->descripcio;
    }

    /**
     * Set the value of descripcio
     *
     * @return  self
     */ 
    public function setDescripcio($descripcio)
    {
        $this->descripcio = $descripcio;

        return $this;
    }

    /**
     * Get the value of hores_duracio
     */ 
    public function getHores_duracio()
    {
        return $this->hores_duracio;
    }

    /**
     * Set the value of hores_duracio
     *
     * @return  self
     */ 
    public function setHores_duracio($hores_duracio)
    {
        $this->hores_duracio = $hores_duracio;

        return $this;
    }

    /**
     * Set the value of data_inici
     *
     * @return  self
     */ 
    public function setData_inici($data_inici)
    {
        $this->data_inici = $data_inici;

        return $this;
    }

    /**
     * Get the value of data_inici
     */ 
    public function getData_inici()
    {
        return $this->data_inici;
    }

    /**
     * Get the value of data_final
     */ 
    public function getData_final()
    {
        return $this->data_final;
    }

    /**
     * Set the value of data_final
     *
     * @return  self
     */ 
    public function setData_final($data_final)
    {
        $this->data_final = $data_final;

        return $this;
    }

    /**
     * Get the value of dni
     */ 
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set the value of dni
     *
     * @return  self
     */ 
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }
}

?>