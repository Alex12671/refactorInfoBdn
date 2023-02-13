<?php
class ProfesorController{

      

    public function showProfessors() {
        require_once "Models/Profesor.php";
        $profesor = new Profesor();
        $profesores = $profesor->getAllProfessors();
        $profesoresLista = $profesores->fetchAll();
        require_once "Views/Profesores/profesores.php";
    }

    public function searchProfessors() {
        require_once "Models/Profesor.php";
        $profesor = new Profesor();
        $profesores = $profesor->searchProfessors($_POST['Buscar']);
        $profesoresLista = $profesores->fetchAll();
        require_once "Views/Profesores/profesores.php";
    }

    public function showAddProfessorPage() {
        require_once "Models/Profesor.php";
        $profesor = new Profesor();
        $result = $profesor->getActiveProfessors();
        $professorsList = $result->fetchAll();
        require_once "Views/Profesores/añadir_profesor.php";
    }

    public function addProfessor() {
        require_once "Models/Profesor.php";
        $profesor = new Profesor();
        $filename = $_FILES['Foto']['name'];
        $destination = 'professors/'.$filename;
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $file = $_FILES['Foto']['tmp_name'];
        $size = $_FILES['Foto']['size'];

        if ($_FILES['Foto']['size'] > 16000000) { // Tamaño maximo = 16MB
            echo "<p class=fallo>El archivo es muy grande!</p>";
            echo '<meta http-equiv="refresh" content="2;url=profesores.php" />';
        } 
        else {
                
            if (move_uploaded_file($file, $destination)) {

                $profesores = $profesor->addProfessor($_POST['DNI'],$_POST['Email'],$_POST['Nom'],$_POST['Cognoms'],$_POST['Titol_Academic'],$destination,md5($_POST['Password']));
                echo "<p class=añadir>Profesor añadido correctamente</p>";
                echo "<meta http-equiv=refresh content='2; url=index.php?controller=profesor&action=showProfessors'>";

                
                

            } 
            else {

                echo "<p class=fallo>Hubo un fallo al subir el archivo.</p>";
                echo '<meta http-equiv="refresh" content="2;url=profesores.php" />';
        
            }
        }
    }

    public function showModifyProfessorPage() {
        require_once "Models/Profesor.php";
        $profesor = new Profesor();
        $result = $profesor->getSelectedProfessor($_GET['id']);
        $selectedProfessor = $result->fetch();
        require_once "Views/Profesores/modificarprofesor.php";
    }

    public function modifyProfessor() {
        require_once "Models/Profesor.php";
        $profesor = new Profesor();
        if(isset($_POST['Foto'])) {

            if(is_uploaded_file ($_FILES['Foto']['tmp_name'])) {

                $filename = $_FILES['Foto']['name'];
                $destination = 'professors/'.$filename;
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                $file = $_FILES['Foto']['tmp_name'];
                $size = $_FILES['Foto']['size'];
            
                if ($_FILES['Foto']['size'] > 16000000) { // Tamaño maximo = 16MB
                    echo "<p class=fallo>El archivo es muy grande!</p>";
                    echo '<meta http-equiv="refresh" content="2;url=index.php" />';
                } 
                else {
                        
                    if (move_uploaded_file($file, $destination)) {
                        $result = $profesor->updateProfessorPicture($destination,$_GET['id']);
                    } 
                    else {
            
                        echo "<p class=fallo>Hubo un fallo al subir el archivo.</p>";
                        echo '<meta http-equiv="refresh" content="2;url=index.php" />';
                
                    }
                } 
    
            }

        }
        $result= $profesor->updateProfessor($_POST['Nom'],$_POST['Cognoms'],$_POST['Titol_Academic'],$_GET['id']);
        echo "<p class=modificar>Datos modificados correctamente</p>";
        echo "<meta http-equiv=refresh content='2; url=index.php?controller=profesor&action=showProfessors'>";
    }

    public function changeProfessorStatus() {
        require_once "Models/Profesor.php";
        $profesor = new Profesor();
        if ($_GET['estado'] == 1) {
    
            $query = "UPDATE professors SET Activado = '0' WHERE DNI = :dni";
            $result= $profesor->changeProfessorStatus($query,$_GET['id']);
            echo "<meta http-equiv=refresh content='0; url=index.php?controller=profesor&action=showProfessors'>";

        }
        else if ($_GET['estado'] == 0) {
    
            $query = "UPDATE professors SET Activado = '1' WHERE DNI = :dni";
            $result= $profesor->changeProfessorStatus($query,$_GET['id']);
            echo "<meta http-equiv=refresh content='0 url=index.php?controller=profesor&action=showProfessors'>";
        }
    }

    public function showStudentsList() {
        require_once "Models/Profesor.php";
        $profesor = new Profesor();
        $result = $profesor->getLoggedInProfessor($_SESSION['email']);
        $professor = $result->fetch();
        $result2 = $profesor->getStudentsList($professor['DNI'],$_GET['codi']);
        $studentsList = $result2->fetchAll();
        $today = date("Y-m-d");
        require_once "Views/Profesores/listadoalumnos.php";
    }

    public function showPutGradesPage() {
        require_once "Views/Profesores/ponernota.php";
    }

    public function putGrades() {
        require_once "Models/Matricula.php";
        $matricula = new Matricula();
        $result = $matricula->putGrades($_POST['nota'],$_GET['id'],$_GET['codi']);
        echo "<p class=exito>Nota puesta correctamente</p>";
        echo '<meta http-equiv="refresh" content="2;url=index.php?controller=user&action=showProfessorHome" />';
    }
    
}
?>