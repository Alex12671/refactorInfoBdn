<html>
  <head>
    <link rel="stylesheet" type="text/css" href="stylesheets/modificarcurso.css">
    <meta charset="utf-8">
    <title>Modificar Curso</title>
  </head>
    <body>

    <?php
    try {
        if(isset($_SESSION)) {
          if($_SESSION['rol'] == 0) {
              ?>
              <header>
                <h1 class="inicio">Modificar curso</h1>
                <a href="index.php" class="foto" ><img src="img/logo.png" alt="logo"></img></a>
                <nav class="menu">
                  <ul>
                    <li ><a class="admin" href="sortir.php">Cerrar sesión</a></li>
                    <li ><a href="cursos.php">Volver a administración de cursos</a></li>
                  </ul>
                </nav>
              </header>
              <div id="modificar">
              <h1 class="bienvenida" >Bienvenido <?php echo $_SESSION['nombre'];?>!</h1>
              <form  id="modify" method="POST" action="index.php?controller=curso&action=modifyCourse&Codi=<?php echo $_GET['Codi']; ?>" >
                <label for="Nom">Nom: 
                <input disabled type="text" id="modify" name="Nom" value = "<?php echo $selectedCourse['Nom']; ?>" ><br/>
                <label for="Descripcio">Descripció: 
                <input type="text" id="modify" name="Descripcio" value = "<?php echo $selectedCourse['Descripcio']; ?>" ><br/>
                <label for="Hores_Duracio">Hores duració: 
                <input type="text" id="modify" name="Hores_Duracio" value = "<?php echo $selectedCourse['Hores_Duracio']; ?>" ><br/>
                <label for="Data_Inici">Data inici: 
                <input type="text" id="modify" name="Data_Inici" onfocus="(this.type='date')" value = "<?php echo $selectedCourse['Data_Inici']; ?>" ><br/>
                <label for="Data_Final">Data final: 
                <input type="text" id="modify" name="Data_Final"  onfocus="(this.type='date')" value = "<?php echo $selectedCourse['Data_Final']; ?>" ><br/>
                <label for="DNI">DNI: 
                <select name="DNI" id="modify" required >
                    <option selected disabled value="">Selecciona un profesor</option>
                    <?php
                    foreach($professorsList as $professor => $value) {
                      echo "<option value=".$value['DNI'].">".$value['DNI']." - ".$value['Nom']." ".$value['Cognoms']."</option>";
                    }
                    ?>
                </select>
                <button type="submit">Modificar</input>
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