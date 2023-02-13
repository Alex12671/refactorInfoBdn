<html>
  <head>
    <link rel="stylesheet" type="text/css" href="stylesheets/login_admin.css">
    <meta charset="utf-8">
    <title>Login admin</title>
  </head>
    <body>
      <header>
            <h1 class="inicio">Login administración</h1>
          <a href="index.php"><img src="img/logo.png" alt="logo"></img></a>
          <nav class="menu">
            <ul>
              
              <li class="index"><a href="index.php">Volver a página principal</a></li>
            </ul>
          </nav>
        </header>
    <div id="loginAdmin">
    <h1 class="tituloForm"></h1>
      <form  id="login" method="POST" action="index.php?controller=admin&action=ValidateAdminCredentials" >
        <input type="text" id="nombre" name="nombre" placeholder="Ingresa el nombre" ><br/>
        <input type="password" id="passwd" name="passwd" placeholder="Ingresa la contraseña"><br/>
        <button type="submit">Acceder a administración</input>
      </form>
    </div>
    </body>
</html>