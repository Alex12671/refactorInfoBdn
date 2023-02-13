<html>
  <head>
    <link rel="stylesheet" type="text/css" href="stylesheets/inicioprofesores.css">
    <meta charset="utf-8">
    <title>Panel de control profesores</title>
  </head>
    <body>

    <?php
    try {
        if(isset($_SESSION)) {
          if($_SESSION['rol'] == 1) {
            ?>
            <header>
              <h1 class="inicio">Listado de cursos</h1>
              <a href="index.php" class="foto" ><img class="logo" src="img/logo.png" alt="logo"></img></a>
              <nav class="menu">
                <ul>
                  <li><a href="index.php?controller=user&action=destroySession">Cerrar sesión</a></li>
                </ul>
              </nav>
            </header>
            <div id="tabla">
            <h1 class="bienvenida" >Bienvenido <?php echo $_SESSION['nombre'];?>!</h1><?php
             echo "<div class=cursos>";
             foreach($coursesList as $course => $value) {
                 echo "<table cellspacing=0 class=curso>";
                 echo "<tbody>";
                 $fechaInicio = date("d/m/Y", strtotime($value["Data_Inici"]));
                 $fechaFinal = date("d/m/Y", strtotime($value["Data_Final"]));
                 echo "<tr>"; 
                 echo "<td class=nombre>".$value['Nom']."</td>";
                 echo "</tr>";
                 echo "<tr>"; 
                 echo "<td>".$value['Descripcio']."</td>";
                 echo "</tr>";
                 echo "<tr>"; 
                 echo "<td>Data Inici - Final: $fechaInicio - $fechaFinal</td>";
                 echo "</tr>";  
                 if($value['Data_Final'] < $today) {
                         echo "<tr>";
                         echo "<td><b>Curso finalizado. Ya puedes poner notas.</b></td>";
                         echo "</tr>"; 
                     
     
                 }
                 echo "<tr>";
                 echo "<td><a class=enlace href=index.php?controller=profesor&action=showStudentsList&codi=".$value['Codi']."&nombre=".urlencode($value['Nom']).">Ver listado de alumnos</a></td>";
                 echo "<tr>";
                 echo "</table>";
             }   
             echo "</div";
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