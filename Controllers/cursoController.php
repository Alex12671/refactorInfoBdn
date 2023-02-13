<?php
class CursoController{

      

    public function showCourses() {
        require_once "Models/Curso.php";
        $curso = new Curso();
        $cursos = $curso->getAllCourses();
        $cursosLista = $cursos->fetchAll();
        require_once "Views/Cursos/cursos.php";
    }

    public function searchCourses() {
        require_once "Models/Curso.php";
        $curso = new Curso();
        $cursos = $curso->searchCourses($_POST['Buscar']);
        $cursosLista = $cursos->fetchAll();
        require_once "Views/Cursos/cursos.php";
    }

    public function showAddCoursePage() {
        require_once "Models/Profesor.php";
        $profesor = new Profesor();
        $result = $profesor->getActiveProfessors();
        $professorsList = $result->fetchAll();
        require_once "Views/Cursos/añadir_curso.php";
    }

    public function addCourse() {
        require_once "Models/Curso.php";
        $curso = new Curso();
        $cursos = $curso->addCourse($_POST['Nom'],$_POST['Descripcio'],$_POST['Hores_Duracio'],$_POST['Data_Inici'],$_POST['Data_Final'],$_POST['DNI']);
        echo "<p class=exito>Curso añadido correctamente</p>";
        echo "<meta http-equiv=refresh content='2; url=index.php?controller=curso&action=showCourses'>";
    }

    public function showModifyCoursePage() {
        require_once "Models/Curso.php";
        require_once "Models/Profesor.php";
        $curso = new Curso();
        $profesor = new Profesor();
        $cursos = $curso->getSelectedCourse($_GET['Codi']);
        $selectedCourse = $cursos->fetch();
        $result = $profesor->getActiveProfessors();
        $professorsList = $result->fetchAll();
        require_once "Views/Cursos/modificarcurso.php";
    }

    public function modifyCourse() {
        require_once "Models/Curso.php";
        $curso = new Curso();
        $result= $curso->updateCourse($_POST['Descripcio'],$_POST['Hores_Duracio'],$_POST['Data_Inici'],$_POST['Data_Final'],$_POST['DNI'],$_GET['Codi']);
        echo "<p class=modificar>Datos modificados correctamente</p>";
        echo "<meta http-equiv=refresh content='2; url=index.php?controller=curso&action=showCourses'>";
    }

    public function changeCourseStatus() {
        require_once "Models/Curso.php";
        $curso = new Curso();
        if ($_GET['estado'] == 1) {
    
            $query = "UPDATE cursos SET Activado = '0' WHERE Codi = :codi";
            $result= $curso->changeCourseStatus($query,$_GET['Codi']);
            echo "<meta http-equiv=refresh content='0; url=index.php?controller=curso&action=showCourses'>";

        }
        else if ($_GET['estado'] == 0) {
    
            $query = "UPDATE cursos SET Activado = '1' WHERE Codi = :codi";
            $result= $curso->changeCourseStatus($query,$_GET['Codi']);
            echo "<meta http-equiv=refresh content='0 url=index.php?controller=curso&action=showCourses'>";
        }
    }
    
}
?>