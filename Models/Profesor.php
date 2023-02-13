<?php
require_once("Database.php");

//ToDo: cambiar los atributos por los de la base de datos(cuando la tenga)
class Profesor extends Database {
    private   $dni;
    private   $email;
    private   $nom;
    private   $cognoms;
    private   $titol_academic;
    private   $foto;
    private   $password;


    /*Methods*/

    public function getActiveProfessors() {
        $stmt = $this->db->prepare("SELECT * FROM professors WHERE Activado = 1");
        $stmt->execute();
        return $stmt;
    }

    public function getAllProfessors() {
        $stmt = $this->db->prepare("SELECT * FROM professors");
        $stmt->execute();
        return $stmt;
    }

    public function getSelectedProfessor($dni) {
        $stmt = $this->db->prepare("SELECT * FROM professors WHERE DNI = :dni");
        $stmt->execute([':dni' => "$dni"]);
        return $stmt;
    }

    public function getLoggedInProfessor($email) {
        $stmt = $this->db->prepare("SELECT * FROM professors WHERE Email = :email");
        $stmt->execute([':email' => "$email"]);
        return $stmt;
    }

    public function searchProfessors($dni) {
        $stmt = $this->db->prepare("SELECT * FROM professors WHERE DNI LIKE :dni");
        $stmt->execute([':dni' => "$dni%"]);
        return $stmt;
    }

    public function addProfessor($dni,$email,$nom,$cognoms,$titol,$foto,$password) {
        $stmt = $this->db->prepare("INSERT INTO professors VALUES (:dni,:email, :nom,:cognoms,:titol,:foto,:password,'1')");
        $stmt->execute([':dni' => "$dni", ':email' => "$email", ':nom' => "$nom", ':cognoms' => "$cognoms", ':titol' => "$titol", ':foto' => "$foto", ':password' => "$password"]);
        return $stmt;
    }

    public function updateProfessor($nom,$cognoms,$titol,$dni) {
        $stmt = $this->db->prepare("UPDATE professors SET Nom = :nom, Cognoms = :cognoms, Titol_Academic = :titol WHERE DNI = :dni");
        $stmt->execute([':nom' => "$nom",':cognoms' => "$cognoms",':titol' => "$titol",':dni' => "$dni"]);
        return $stmt;  
    }

    public function updateProfessorPicture($foto,$dni) {
        $stmt = $this->db->prepare("UPDATE professors SET Foto = :foto WHERE DNI= :dni");
        $stmt->execute([':foto' =>"$foto",':dni' => "$dni"]);
        return $stmt; 
    }

    public function changeProfessorStatus($query,$dni) {
        $stmt = $this->db->prepare($query);
        $stmt->execute([':dni' => $dni]);
        return $stmt;  
    }

    public function getAssociatedCourses($dni) {
        $stmt = $this->db->prepare("SELECT * FROM cursos WHERE DNI = :dni");
        $stmt->execute([':dni' => $dni]);
        return $stmt;  
    }

    public function getStudentsList($dni,$codi) {
        $stmt = $this->db->prepare("SELECT a.Nom,a.Cognoms,a.DNI,a.Foto,c.Codi,c.Data_Final,m.Nota FROM alumnes a INNER JOIN matricula m ON a.DNI = m.DNI INNER JOIN cursos c ON m.Codi = c.Codi WHERE c.DNI = :dni AND c.Codi = :codi");
        $stmt->execute([':dni' => $dni, ':codi' => $codi]);
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
     * Get the value of titol_academic
     */ 
    public function getTitol_academic()
    {
        return $this->titol_academic;
    }

    /**
     * Set the value of titol_academic
     *
     * @return  self
     */ 
    public function setTitol_academic($titol_academic)
    {
        $this->titol_academic = $titol_academic;

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