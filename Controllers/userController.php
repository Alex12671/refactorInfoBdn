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
                ?> <meta http-equiv="refresh" content="20; url=index.php?controller=user&action=logUser"> <?php
            }
            
        }
        else {
            $resultado= $user->validateStudent($_POST['email'],$_POST['password']);
            if($resultado->rowCount() > 0) {
                $result= $resultado->fetch();
                if($result[0]['nombre'] == $_POST['usuario'] && $result[0]['password'] == $_POST['password']) {
                    $_SESSION['rol']  = 1;
                    $_SESSION['usuario'] = $_POST['usuario'];
                }
            }
            else{
                echo "Las credenciales son incorrectas";
                ?> <meta http-equiv="refresh" content="20; url=index.php?controller=user&action=logUser"> <?php
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
}
?>