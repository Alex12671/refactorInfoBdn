<html>
  <head>
    <link rel="stylesheet" type="text/css" href="stylesheets/administracion.css">
    <meta charset="utf-8">
    <title>Panel de control admin</title>
  </head>
    <body>
    <?php
    try {
        if(isset($_SESSION)) {
          if($_SESSION['rol'] == 0) {
          ?>  
          <header>
            <h1 class="inicio">Panel de administración</h1>
            <a href="index.php" class="foto" ><img src="img/logo.png" alt="logo"></img></a>
            <nav class="menu">
              <ul>
                <li ><a class="admin" href="index.php?controller=user&action=destroySession">Cerrar sesión</a></li>
              </ul>
            </nav>
          </header>
          <div id="panelAdmin">
                <h1 class="bienvenida" >Bienvenido <?php echo $_SESSION['nombre'];?>!</h1>
                <div id="botones">
                  <a class="cursos" href="index.php?controller=curso&action=showCourses">Administrar cursos</a>
                  <a class="profesores" href="index.php?controller=profesor&action=showProfessors">Administrar profesores</a>
                </div>
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
</html>