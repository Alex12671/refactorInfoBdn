<html>
  <head>
    <link rel="stylesheet" type="text/css" href="stylesheets/añadir_profesor.css">
    <meta charset="utf-8">
    <title>Añadir profesor</title> 
  </head>
    <body>

    <?php
    try {
    if(isset($_SESSION)) {
        if($_SESSION['rol'] == 0) {
          ?>
          <header>
          <h1 class="inicio">Añadir nuevo profesor</h1>
          <a href="index.php" class="foto" ><img src="img/logo.png" alt="logo"></img></a>
          <nav class="menu">
            <ul> 
                <li><a href="index.php?controller=user&action=destroySession">Cerrar sesión</a></li>
                <li><a href="index.php?controller=profesor&action=showProfessors">Volver a administración de profesores</a></li>
            </ul>
          </nav>
        </header>
          <div id="añadir">
          <h1 class="bienvenida" >Bienvenido <?php echo $_SESSION['nombre'];?>!</h1><?php
              ?>
            <form  id="prof" method="POST" enctype="multipart/form-data" action="index.php?controller=profesor&action=addProfessor" >
                <input type="text" id="DNI" name="DNI" pattern="[0-9]{8}[A-Z]{1}" placeholder="DNI" required><br/>
                <input type="email" id="Email" name="Email" placeholder="Email" required><br/>
                <input type="text" id="Nom" name="Nom" placeholder="Nom" required>
                <input type="text" id="Cognoms" name="Cognoms" placeholder="Cognoms" required><br/>
                <input type="text" id="Titol_Academic" name="Titol_Academic" placeholder="Titol_Academic" required><br/>
                <input type="file" id="Foto" name="Foto" accept=".png, .jpg, .jpeg" placeholder="Foto"  required>
                <input type="password" id="Password" name="Password" placeholder="Password" required><br/>

                <button type="submit" >Añadir</button>
            </form>
            </div><?php
            
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