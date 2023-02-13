<!--Controlador frontal: fichero que se encarga de cargarlo absolutamente todo -->
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Camera a free jQuery slideshow with many effects, transitions, adaptive layout, easy to customize, using canvas and mobile ready"> 
	<meta name = "robots" content="noindex">
	<meta name = "robots" content="noimageindex">
    <!-- <link href="stylesheets/administracion.css" rel="stylesheet">
    <link href="stylesheets/alumnos.css" rel="stylesheet">
    <link href="stylesheets/añadir_curso.css" rel="stylesheet">
    <link href="stylesheets/añadir_profesor.css" rel="stylesheet">
    <link href="stylesheets/cursos.css" rel="stylesheet">
    <link href="stylesheets/cursos_matriculados.css" rel="stylesheet">
    <link href="stylesheets/inicioprofesores.css" rel="stylesheet">
    <link href="stylesheets/listadoalumnos.css" rel="stylesheet">
    <link href="stylesheets/login_admin.css" rel="stylesheet">
    <link href="stylesheets/modificarcurso.css" rel="stylesheet">
    <link href="stylesheets/modificarprofesor.css" rel="stylesheet">
    <link href="stylesheets/nota.css" rel="stylesheet">
    <link href="stylesheets/profesores.css" rel="stylesheet">
    <link href="stylesheets/prueba.css" rel="stylesheet">
    <link href="stylesheets/registro.css" rel="stylesheet"> -->
</head>
<body>
    
    
<?php 
require_once "autoload.php";


if (isset($_GET['controller'])){
    $nombreController = $_GET['controller']."Controller";
}
else{
    //Controlador per dedecte
    $nombreController = "userController";
}
if (class_exists($nombreController)){
    $controlador = new $nombreController(); 
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }
    else{
        $action ="logUser";
    }
    $controlador->$action();   
}else{

    echo "No existe el controlador";
}


?>

</body>
</html>


