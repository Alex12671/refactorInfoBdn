<?php
require_once("Database.php");

//ToDo: cambiar los atributos por los de la base de datos(cuando la tenga)
class Alumno extends Database {
    private   $dni;
    private   $email;
    private   $nom;
    private   $cognoms;
    private   $edat;
    private   $foto;
    private   $password;


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
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

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
     * Get the value of cognoms
     */ 
    public function getCognoms()
    {
        return $this->cognoms;
    }

    /**
     * Set the value of cognoms
     *
     * @return  self
     */ 
    public function setCognoms($cognoms)
    {
        $this->cognoms = $cognoms;

        return $this;
    }

    /**
     * Get the value of edat
     */ 
    public function getEdat()
    {
        return $this->edat;
    }

    /**
     * Set the value of edat
     *
     * @return  self
     */ 
    public function setEdat($edat)
    {
        $this->edat = $edat;

        return $this;
    }

    /**
     * Get the value of foto
     */ 
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set the value of foto
     *
     * @return  self
     */ 
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}

?>