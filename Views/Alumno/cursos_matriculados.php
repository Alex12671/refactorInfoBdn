<html>
  <head>
    <link rel="stylesheet" type="text/css" href="stylesheets/cursos_matriculados.css">
    <meta charset="utf-8">
    <title>Panel de control alumnos</title>
  </head>
    <body>

    <?php
        include("funciones.php");
        if($_SESSION) {
          if($_SESSION['rol'] == 2) {
            ?>
            <header>
              <h1 class="inicio">Cursos matriculados</h1>
              <a href="index.php" class="foto" ><img class="logo" src="img/logo.png" alt="logo"></img></a>
              <nav class="menu">
                <ul>
                  <li><a href="index.php?controller=user&action=destroySession">Cerrar sesión</a></li>
                  <li><a href="index.php?controller=user&action=showStudentHome">Volver a página de inicio</a></li>
                </ul>
              </nav>
            </header>
            <div id="tabla">
            <h1 class="bienvenida" >Bienvenido <?php echo $_SESSION['nombre'];?>!</h1><?php
            if($mats->rowCount() == 0) {

              echo "<h2>Vaya, parece que no estás matriculado en ningún curso :(";    
  
          }
          else {
              echo "<div class=cursos>";
              foreach($enrollments as $enrollment => $value) {
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
  
                  if($value['Data_Final'] < date("Y-m-d")) {
                      echo "<tr>"; 
                      echo "<td>".$value['Nota']."</td>";
                      echo "</tr>"; 
                  }
                  else {
                      echo "<tr>"; 
                      echo "<td> No disponible </td>";
                      echo "</tr>"; 
                  }
                  
              
              }
              echo "</div>";
  
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