<html>
  <head>
    <link rel="stylesheet" type="text/css" href="stylesheets/modificarprofesor.css">
    <meta charset="utf-8">
    <title>Modificar alumno</title>
  </head>
    <body>

    <?php
    try {
        if(isset($_SESSION)) {
          if($_SESSION['rol'] == 2) {
            ?>
            <header>
                <h1 class="inicio">Modificar alumno</h1>
                <a href="index.php" class="foto" ><img src="img/logo.png" alt="logo"></img></a>
                <nav class="menu">
                  <ul>
                    <li ><a class="admin" href="index.php?controller=user&action=destroySession">Cerrar sesión</a></li>
                    <li ><a href="index.php?controller=user&action=showStudentHome">Volver a panel principal</a></li>
                  </ul>
                </nav>
              </header>
              <div id="modificar">
              <h1 class="bienvenida" >Bienvenido <?php echo $_SESSION['nombre'];?>!</h1>
                <script src="ModificarFoto.js"></script>
                <form  id="modify" method="POST" enctype="multipart/form-data" >
                        <input hidden type="text" id="modify" name="DNI" value = "<?php echo $selectedStudent['DNI']; ?>" ><br/>
                    <label for="Email">Email: 
                        <input disabled type="email" id="modify" value = "<?php echo $selectedStudent['Email']; ?>" ><br/>
                    <label for="Nom">Nom: 
                        <input type="text" id="modify" name="Nom" value = "<?php echo $selectedStudent['Nom']; ?>" ><br/>
                    <label for="Cognoms">Cognoms: 
                        <input type="text" id="modify" name="Cognoms" value = "<?php echo $selectedStudent['Cognoms']; ?>" ><br/>
                    <label for="Edat">Edat: 
                        <input type="text" id="modify" name="Edat" value = "<?php echo $selectedStudent['Edat']; ?>" ><br/>
                    <label for="mod_foto">Modificar: 
                        <input type="checkbox" id="Foto" name="Foto" onclick="modificarFoto()" ><br/>
                    Foto actual: <img src="<?php echo $selectedStudent['Foto']; ?>" style='width:50px;height:40px;'></img><br/>
                        <div id="divFoto"></div>
                        <button type="submit">Modificar</button>
                    </form>
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