<html>
  <head>
    <link rel="stylesheet" type="text/css" href="stylesheets/añadir_curso.css">
    <meta charset="utf-8">
    <title>Añadir Curso</title> 
  </head>
    <body>
    
    <?php
    try {
    if(isset($_SESSION)) {
        if($_SESSION['rol'] == 0) {
          ?>
          <header>
          <h1 class="inicio">Añadir nuevo curso</h1>
          <a href="index.php" class="foto" ><img src="img/logo.png" alt="logo"></img></a>
          <nav class="menu">
            <ul> 
              <li><a href="index.php?controller=user&action=destroySession">Cerrar sesión</a></li>
              <li><a href="index.php?controller=curso&action=showCourses">Volver a administración de cursos</a></li>
            </ul>
          </nav>
        </header>
          <div id="modificar">
          <h1 class="bienvenida" >Bienvenido <?php echo $_SESSION['nombre'];?>!</h1>
            <form  id="addCurso" method="POST" action="index.php?controller=curso&action=addCourse">
                <input type="text" id="Nom" name="Nom" placeholder ="Nombre" required><br/>
                <input type="text" id="Descripcio" name="Descripcio" placeholder ="Descripcio" required><br/>
                <input type="text" id="Hores_Duracio" name="Hores_Duracio" placeholder ="Hores_Duracio" required><br/>
                <input type="text" id="Data_Inici" name="Data_Inici" onchange="getDatevalue()" onfocus="(this.type='date')" placeholder ="Data_Inici" required >
                <input type="text" id="Data_Final" name="Data_Final" onfocus="(this.type='date')" placeholder ="Data_Final" required disabled><br/>
                <select name="DNI" id="DNI" required>
                    <?php
                    foreach($professorsList as $professor => $value) {
                        echo "<option value=".$value['DNI'].">".$value['DNI']." - ".$value['Nom']." ".$value['Cognoms']."</option>";
                    }
                    ?>
                </select>
                <button type="submit">Añadir</button>
            </form>
            </div>
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
    <script>
      //controlando la fecha mínima de entrada a hoy
      var today = new Date();
      var tomorrow = new Date();
      tomorrow.setDate(today.getDate() + 1);
      dataInici = document.getElementById("Data_Inici");
      dataInici.min = today.toLocaleDateString('en-ca');
      //funcion para controlar las fechas de entrada
      function getDatevalue() {
        
        dataFinal = document.getElementById("Data_Final");
        dataMinima = new Date(dataInici.value);
        dataMinima.setDate(dataMinima.getDate() + 1);
        dataFinal.min = dataMinima.toLocaleDateString('en-ca');;
        dataFinal.disabled = false;
        dataFinal.value = '';
      }
      
      
      
    </script>
</html>