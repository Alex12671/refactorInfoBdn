<html>
  <head>
    <link rel="stylesheet" type="text/css" href="stylesheets/listadoalumnos.css">
    <meta charset="utf-8">
    <title>Panel de control profesores</title>
  </head>
    <body>

    <?php
    try {
        if(isset($_SESSION)) {
            if(isset($_GET['codi'])) {
                if($_SESSION['rol'] == 1) {
                    ?>
                    <header>
                    <h1 class="inicio">Listado de alumnos de <?php echo "".$_GET['nombre'].""; ?></h1>
                    <a href="index.php" class="foto" ><img class="logo" src="img/logo.png" alt="logo"></img></a>
                    <nav class="menu">
                        <ul>
                            <li><a href="index.php?controller=user&action=destroySession">Cerrar sesión</a></li>
                            <li><a href="index.php?controller=user&action=showProfessorHome">Volver a cursos</a></li>
                        </ul>
                    </nav>
                    </header>
                    <div id="tabla">
                    <h1 class="bienvenida" >Bienvenido <?php echo $_SESSION['nombre'];?>!</h1><?php
                    if($result2->rowCount() > 0) {
                        echo "<div class=alumnos>";
                        foreach($studentsList as $student => $value) {
                            echo "<table cellspacing=0>";
                            echo "<tbody>";
                            
                            echo "<tr>"; 
                            echo "<td class='nombre'>".$value['Nom']." ".$value['Cognoms']."</td>";
                            echo "<tr>"; 
                            echo "<tr>"; 
                            echo "<td>".$value['DNI']."</td>";
                            echo "</tr>"; 
                            echo "<td><img src=".$value['Foto']." style='width:100px;height:100px;'></img></td>";
                            echo "</tr>"; 
                            if($value['Data_Final'] < $today) {
                                if(is_null($value['Nota'])) {
                                    echo "<tr>"; 
                                    echo "<td>Poner nota <a href=index.php?controller=profesor&action=showPutGradesPage&codi=".$value['Codi']."&id=".$value['DNI']." > <img src='img/nota.png' style='width:60px;height:60px;'> </img></a> </td>";
                                    echo "</tr>"; 
                                }
                                else {
                                    echo "<tr>"; 
                                    echo "<td class=nota>Nota actual: ".$value['Nota']."</td>";
                                    echo "</tr>"; 
                                    echo "<tr>";
                                    echo "<td>Modificar nota<a href=index.php?controller=profesor&action=showPutGradesPage&codi=".$value['Codi']."&id=".$value['DNI']." > <img src='img/nota.png' style='width:60px;height:60px;'> </img></a></td>";
                                    echo "</tr>"; 
                                }
                
                            }
                            else {
                                echo "<tr>"; 
                                echo "<td>Nota no disponible</td>";
                                echo "</tr>"; 
                            }
                            echo "</tbody>";
                            echo "</table>";
                        }
                        echo "</div>"; 
                        
                    }
                    else {
                        echo "<p class=noresult> Vaya, parece que no hay ningún alumno inscrito todavía :(";
                    }
                }
                else {
                    require_once "../../Exceptions/PermissionException.php";
                    throw new PermissionException();
                }
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