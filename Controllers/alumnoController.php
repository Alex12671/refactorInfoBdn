<?php
class AlumnoController{

      

    public function showEnrollments() {
        require_once "Models/Matricula.php";
        require_once "Models/Curso.php";
        require_once "Models/Alumno.php";
        $matricula = new Matricula();
        $alumno = new Alumno();
        $curso = new Curso();
        $result= $alumno->getSelectedStudent($_SESSION['email']);
        $selectedStudent = $result->fetch();
        $mats= $matricula->getStudentEnrollments($selectedStudent['DNI']);
        $enrollments = $mats->fetchAll();
        $resultado= $curso->getAllCourses();
        $coursesList = $resultado->fetchAll();
        require_once "Views/Alumno/cursos_matriculados.php";
    }

    public function modifyStudent() {
        require_once "Models/Alumno.php";
        $alumno = new Alumno();
        if(isset($_POST['Nom'])) {

            $result= $alumno->updateStudent($_POST['DNI'],$_POST['Nom'],$_POST['Cognoms'],$_POST['Edat'],$_SESSION['email']);

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
                            $result = $alumno->updateStudentPicture($_POST['Foto'],$_SESSION['email']);
                        } 
                        else {
                
                            echo "<p class=fallo>Hubo un fallo al subir el archivo.</p>";
                            echo '<meta http-equiv="refresh" content="2;url=index.php" />';
                    
                        }
                    } 
        
                }

            }
            echo "<p class=modificar>Datos modificados correctamente</p>";
            echo "<meta http-equiv=refresh content='2; url=index.php?controller=user&action=showStudentHome'>";
            

            

        }


        else {
            $result= $alumno->getSelectedStudent($_SESSION['email']);
            $selectedStudent = $result->fetch();
            require_once "Views/Alumno/modificar_alumno.php";
        }
    }
}
?>