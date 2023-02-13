<html>
  <head>
    <link rel="stylesheet" type="text/css" href="stylesheets/cursos.css">
    <meta charset="utf-8">
    <title>Cursos</title>
  </head>
    <body>
    
    <?php
    try {
        if(isset($_SESSION)) {
          if($_SESSION['rol'] == 0) {
            ?>
            <header>
              <h1 class="inicio">Administrar cursos</h1>
              <a href="index.php" class="foto" ><img class="logo" src="img/logo.png" alt="logo"></img></a>
              <nav class="menu">
                <ul>
                  <li><a href="index.php?controller=user&action=destroySession">Cerrar sesión</a></li>
                  <li><a href="index.php?controller=admin&action=showAdminHome">Volver al panel de control</a></li>
                </ul>
              </nav>
            </header>
            <div id="tabla">
            <h1 class="bienvenida" >Bienvenido <?php echo $_SESSION['nombre'];?>!</h1><?php
            if(isset($_POST['Buscar'])) {
              ?>
              <a class="añadir" href="index.php?controller=curso&action=showAddCoursePage">Añadir un nuevo curso</a><br/>
              <form id="buscar" method="POST" action="index.php?controller=curso&action=searchCourses">
              <input type="text" id="buscar" name="Buscar">
              <button type="submit" class="buscar" >Buscar</button>
            </form>
            <table cellspacing="0">
              <thead>
                <th>Codi</th>
                <th>Nom</th>
                <th>Descripció</th>
                <th>Hores Duració</th>
                <th>Data Inici</th>
                <th>Data Final</th>
                <th>DNI</th>
                <th>Modificar</th>
                <th>Activo</th>
              </thead>
            <?php
                  foreach($cursosLista as $curso =>$array) {
                    echo "<tr>";
                    foreach ($array as $field_name => $value) {

                      if ($field_name == "Activado") {
          
                          if($value == '1') {
          
                              $src = 'img/tick.png';
                              $class = "activado";
                          }
                          else {
          
                              $src = 'img/cross.png';
                              $class = "desactivado";
          
                          }
                      }
                      else if($field_name == "Data_Inici") {
                          $fechaInicio = date("d/m/Y", strtotime($array["Data_Inici"]));
                          echo "<td>$fechaInicio</td>";
                        
                      }
                      else if($field_name == "Data_Final") {
                          $fechaFinal = date("d/m/Y", strtotime($array["Data_Final"]));
                          echo "<td>$fechaFinal</td>";
                      }
                      else {
          
                          echo "<td>$value</td>";
                          
          
                      }
                      
                  }
                  echo"<td><a href='index.php?controller=curso&action=showModifyCoursePage&Codi=".$array['Codi']."&estado=".$array['Activado']."'><img src='img/pencil.png' alt='Modificar' style='width:42px;height:42px;'></a></td>";
                  echo"<td class=$class><a href='index.php?controller=curso&action=changeCourseStatus&Codi=".$array['Codi']."&estado=".$array['Activado']."'><img src=$src alt='Borrar' style='width:42px;height:42px;'></a></td></tr>";
                  
                }
                ?> </table> <?php
            }
            else {
            ?>
              <a class="añadir" href="index.php?controller=curso&action=showAddCoursePage">Añadir un nuevo curso</a><br/>
              <form id="buscar" method="POST" action="index.php?controller=curso&action=addCourse">
                <input type="text" id="buscar" name="Buscar">
                <button type="submit" class="buscar" >Buscar</button>
              </form>
            
            
            <table cellspacing="0">
              <thead>
                <th>Codi</th>
                <th>Nom</th>
                <th>Descripció</th>
                <th>Hores Duració</th>
                <th>Data Inici</th>
                <th>Data Final</th>
                <th>DNI</th>
                <th>Modificar</th>
                <th>Activo</th>
              </thead>
              <?php
               foreach($cursosLista as $curso =>$array) {
                    echo "<tr>";
                    foreach ($array as $field_name => $value) {

                      if ($field_name == "Activado") {
          
                          if($value == '1') {
          
                              $src = 'img/tick.png';
                              $class = "activado";
                          }
                          else {
          
                              $src = 'img/cross.png';
                              $class = "desactivado";
          
                          }
                      }
                      else if($field_name == "Data_Inici") {
                          $fechaInicio = date("d/m/Y", strtotime($array["Data_Inici"]));
                          echo "<td>$fechaInicio</td>";
                         
                      }
                      else if($field_name == "Data_Final") {
                          $fechaFinal = date("d/m/Y", strtotime($array["Data_Final"]));
                          echo "<td>$fechaFinal</td>";
                      }
                      else {
          
                          echo "<td>$value</td>";
                          
          
                      }
                      
                  }
                  echo"<td><a href='index.php?controller=curso&action=showModifyCoursePage&Codi=".$array['Codi']."&estado=".$array['Activado']."'><img src='img/pencil.png' alt='Modificar' style='width:42px;height:42px;'></a></td>";
                  echo"<td class=$class><a href='index.php?controller=curso&action=changeCourseStatus&Codi=".$array['Codi']."&estado=".$array['Activado']."'><img src=$src alt='Borrar' style='width:42px;height:42px;'></a></td></tr>";
                  
              }
              
              ?>
            </table>
            </div> <?php
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