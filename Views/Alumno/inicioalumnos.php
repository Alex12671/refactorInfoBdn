<html>
  <head>
    <link rel="stylesheet" type="text/css" href="stylesheets/cursos_matriculados.css">
  </head>
    <body>

    <?php
        include("funciones.php");
        if($_SESSION) {
          if($_SESSION['rol'] == 2) {
            ?>
            <header>
              <h1 class="inicio">Listado de cursos</h1>
              <a href="index.php" class="foto" ><img class="logo" src="img/logo.png" alt="logo"></img></a>
              <nav class="menu">
                <ul>
                  <li><a href="index.php?controller=user&action=destroySession">Cerrar sesión</a></li>
                  <li><a href="index.php?controller=alumno&action=showEnrollments">Ver listado de cursos matriculados</a></li>
                  <li><a href="index.php?controller=alumno&action=modifyStudent" class="mod_prof"> Modificar perfil</a></li>
                </ul>
              </nav>
            </header>
            <div id="tabla">
            <h1 class="bienvenida" >Bienvenido <?php echo $_SESSION['nombre'];?>!</h1><?php
            $today = date("Y-m-d");
            echo "<div class=cursos>";
            foreach($coursesList as $course => $value) {
                echo "<table cellspacing=0>";
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
                echo "<td>Hores totals: ".$value['Hores_Duracio']."</td>";
                echo "</tr>";
                echo "<tr>"; 
                echo "<td>Data Inici - Final: $fechaInicio - $fechaFinal</td>";
                echo "</tr>";  
    
                $mats= $matricula->getAssociatedMatriculations($selectedStudent['DNI'],$value['Codi']);
                if($mats->rowCount() == 0) {
    
                    if($value['Data_Inici'] > $today) {
                        echo "<td class=info> <a href=matricularse.php?codi=".$value['Codi']." > <img src='img/matricula.png' style='width:42px;height:42px;'> </img></a>Matrículate ahora </td>";
                    } 
                    else {
                        echo "<td class=info>El curso ya ha comenzado</td>";
                    }
                    
                }
                else if($mats->rowCount() == 1) {
    
                    if($value['Data_Final'] > $today) {
                        echo "<td> <a href=desmatricularse.php?codi=".$value['Codi']." > <img src='img/cross.png' style='width:42px;height:42px;'> </img></a>Desmatricularse </td>";
                    }
                    else {
                        echo "<td class=info>Curso finalizado.</td>";
                    }
    
                }
            }
            echo "</div>";
                
            echo "</tbody>";
            echo "</table>"; 
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