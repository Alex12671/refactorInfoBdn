<?php
require_once("Database.php");

//ToDo: cambiar los atributos por los de la base de datos(cuando la tenga)
class Matricula extends Database {
    private   $dni;
    private   $codi;
    private   $nota;


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

    public function cancelEnrollment($dni,$codi) {
        $stmt = $this->db->prepare("DELETE FROM matricula WHERE DNI = :dni AND Codi = :codi");
        $stmt->execute([':dni' => "$dni",':codi' => $codi]);
        return $stmt;    
    }

    public function makeEnrollment($dni,$codi) {
        $stmt = $this->db->prepare("INSERT INTO matricula VALUES(:dni,:codi,NULL)");
        $stmt->execute([':dni' => "$dni",':codi' => $codi]);
        return $stmt;    
    }

    public function putGrades($nota,$dni,$codi) {
        $stmt = $this->db->prepare("UPDATE matricula SET Nota = :nota WHERE DNI = :dni AND Codi = :codi");
        $stmt->execute([':nota' => $nota,':dni' => "$dni",':codi' => $codi]);
        return $stmt;  
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
     * Get the value of nota
     */ 
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set the value of nota
     *
     * @return  self
     */ 
    public function setNota($nota)
    {
        $this->nota = $nota;

        return $this;
    }
}

?>