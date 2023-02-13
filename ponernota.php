<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="stylesheets/nota.css">
    <meta charset="utf-8">
    <title>Panel de control alumnos</title>
  </head>
    <body>

    <?php
        include("funciones.php");
        if($_SESSION) {
          if(validar($_SESSION['rol']) == 1 ) {
            ?>
            <header>
                <h1 class="inicio">Modificar alumno</h1>
                <a href="index.php" class="foto" ><img src="img/logo.png" alt="logo"></img></a>
                <nav class="menu">
                  <ul>
                    <li ><a class="admin" href="sortir.php">Cerrar sesión</a></li>
                    <li ><a href="inicioalumnos.php">Volver a panel principal</a></li>
                  </ul>
                </nav>
              </header>
              <div id="modificar">
              <h1 class="bienvenida" >Bienvenido <?php echo $_SESSION['nombre'];?>!</h1>
              <?php
            if(isset($_POST['nota'])) {

                ponerNota($_GET['codi'],$_GET['id'],$_POST['nota']);

            }
            else {

            ?>
            <form  id="ponerNota" method="POST">
            <br/>
            <input type="number" id="nota" name="nota" placeholder="Ingresa la nota" min="0" max="10" required><br/>
            <button type="submit" >Poner nota</button><br/>
            <?php

            }
          }
          else {
            echo "Solo los profesores pueden ver esta página";
            echo "<meta http-equiv=refresh content='2; url=inicioprofesores.php'>";
          }
        }
        else {
          echo "Debes iniciar sesión primero!";
          echo "<meta http-equiv=refresh content='2; url=index.php'>";
        }
    ?>
    </body>
</html>