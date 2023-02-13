<html>
  <head>
    <link rel="stylesheet" type="text/css" href="stylesheets/nota.css">
    <meta charset="utf-8">
    <title>Panel de control alumnos</title>
  </head>
    <body>

    <?php
    try {
        if(isset($_SESSION)) {
          if($_SESSION['rol'] == 1 ) {
            ?>
            <header>
                <h1 class="inicio">Modificar alumno</h1>
                <a href="index.php" class="foto" ><img src="img/logo.png" alt="logo"></img></a>
                <nav class="menu">
                  <ul>
                      <li><a href="index.php?controller=user&action=destroySession">Cerrar sesión</a></li>
                      <li><a href="index.php?controller=user&action=showProfessorHome">Volver a cursos</a></li>
                  </ul>
                </nav>
              </header>
              <div id="modificar">
              <h1 class="bienvenida" >Bienvenido <?php echo $_SESSION['nombre'];?>!</h1>
            <form  id="ponerNota" method="POST" action="index.php?controller=profesor&action=putGrades&codi=<?php echo $_GET['codi']; ?>&id=<?php echo $_GET['id']; ?>">
            <br/>
            <input type="number" id="nota" name="nota" placeholder="Ingresa la nota" min="0" max="10" required><br/>
            <button type="submit" >Poner nota</button><br/>
            <?php

            
          }
          else {
            require_once "../../Exceptions/PermissionException.php";
            throw new PermissionException();
          }
        }
        else {
          require_once "../../Exceptions/NoSessionFoundException.php";
          throw new NoSessionFoundException();
        }
      }catch(PermissionException $e) {
        echo $e->errorMessage();
        echo "<meta http-equiv=refresh content='2; url=index.php?controller=admin&action=logAdmin'>";
      }
      catch(NoSessionFoundException $e) {
        echo $e->errorMessage();
        echo "<meta http-equiv=refresh content='2; url=../../index.php'>";
      }
    ?>
    </body>
</html>