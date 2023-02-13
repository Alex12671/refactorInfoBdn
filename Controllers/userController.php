<?php
class UserController{

    public function logUser() {
      require_once "Views/login.php";
    }
      
    public function ValidateUserCredentials() {
        require_once "Models/User.php";
        $user = new User();
        if($_POST['rol'] == "alumno") {
            $resultado= $user->validateStudent($_POST['email'],md5($_POST['passwd']));
            if($resultado->rowCount() > 0) {
                $result= $resultado->fetch();
                $_SESSION['rol']  = 2;
                $_SESSION['nombre'] = $result['Nom'];
                $_SESSION['email'] = $_POST['email'];
                $this->showStudentHome();                
            }
            else{
                echo "Las credenciales son incorrectas";
                ?> <meta http-equiv="refresh" content="3; url=index.php?controller=user&action=logUser"> <?php
            }
            
        }
        else {
            $resultado= $user->validateProfessor($_POST['email'],md5($_POST['passwd']));
            if($resultado->rowCount() > 0) {
                $result= $resultado->fetch();
                $_SESSION['rol']  = 1;
                $_SESSION['nombre'] = $result['Nom'];
                $_SESSION['email'] = $_POST['email'];
                $this->showProfessorHome();                
            
            }
            else{
                echo "Las credenciales son incorrectas";
                ?> <meta http-equiv="refresh" content="3; url=index.php?controller=user&action=logUser"> <?php
            }
        }
        
        
    }

    public function showStudentHome() {
        require_once "Models/Matricula.php";
        require_once "Models/Curso.php";
        require_once "Models/Alumno.php";
        $matricula = new Matricula();
        $alumno = new Alumno();
        $curso = new Curso();
        $result= $alumno->getSelectedStudent($_SESSION['email']);
        $selectedStudent = $result->fetch();
        $resultado= $curso->getAllCourses();
        $coursesList = $resultado->fetchAll();
        require_once "Views/Alumno/inicioalumnos.php";
    }

    public function showProfessorHome() {
        require_once "Models/Profesor.php";
        $profesor = new Profesor();
        $result = $profesor->getLoggedInProfessor($_SESSION['email']);
        $professor = $result->fetch();
        $result2 = $profesor->getAssociatedCourses($professor['DNI']);
        $coursesList = $result2->fetchAll();
        $today = date("Y-m-d");
        require_once "Views/Profesores/inicioprofesores.php";
    }

    public function destroySession() {

        if($_SESSION) {
            session_destroy();
            echo "<p class=salir>Sessió destruida amb èxit</p>";
            echo "<meta http-equiv=refresh content='2; url=index.php'>";
        }
        else {
            echo "No estás autoritzat a veure aquesta pàgina";
            echo "<meta http-equiv=refresh content='2; url=index.php'>";
        }

    }

    public function showRegistrationPage(){
        require_once "Views/registro.php";
    }

    public function registerUser() {
        require_once "Models/User.php";
        $user = new User();
        $filename = $_FILES['Foto']['name'];
        $destination = 'alumnes/'.$filename;
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $file = $_FILES['Foto']['tmp_name'];
        $size = $_FILES['Foto']['size'];

        if ($_FILES['Foto']['size'] > 16000000) { // Tamaño maximo = 16MB
            echo "<p class=fallo>El archivo es muy grande!</p>";
            echo '<meta http-equiv="refresh" content="2;url=index.php" />';
        } 
        else {
                
            if (move_uploaded_file($file, $destination)) {

                $result = $user->registerUser($_POST['DNI'],$_POST['Email'],$_POST['Nom'],$_POST['Cognoms'],$_POST['Titol_Academic'],$destination,md5($_POST['Password']));
                echo "Usuario registrado correctamente";
                echo "<meta http-equiv=refresh content='2; url=index.php'>";


            } 
            else {

                echo "<p class=fallo>Hubo un fallo al subir el archivo.</p>";
                echo '<meta http-equiv="refresh" content="2;url=index.php" />';
        
            }
        }
    }
}
?>