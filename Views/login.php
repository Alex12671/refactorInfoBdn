<head>
<link href="stylesheets/login.css" rel="stylesheet">
</head>
<header>
          <h1 class="inicio">Página de inicio</h1>
        <a href="index.php"><img src="img/logo.png" alt="logo"></img></a>
        <nav class="menu">
          <ul>
            
            <li class="admin"><a href="index.php?controller=admin&action=logAdmin">Acceder a administración</a></li>
          </ul>
        </nav>
      </header>
      <div id="formularioLogin">
       <h1 class="tituloForm">InfoBDN</h1>
        <form  id="login" method="POST" class="login" action="index.php?controller=user&action=ValidateUserCredentials">
          <br/>
            <input type="email" id="email" name="email" placeholder="Ingresa el email" required><br/>
            
            <input type="password" id="passwd" name="passwd" placeholder="Ingresa la contraseña" required><br/>

            <label for="alumno">Alumno 
              <input type="radio" id="alumno" name="rol" value="alumno" required>

            <label for="profesor">Profesor 
              <input type="radio" id="profesor" name="rol" value="profesor" required><br/>

            <button type="submit" >Iniciar sesión</button>
            <a class="registro" href="index.php?controller=user&action=showRegistrationPage">Regístrate aquí</a>
        </form> 
      </div>