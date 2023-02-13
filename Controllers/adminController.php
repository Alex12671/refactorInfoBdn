<?php
class AdminController{

    public function logAdmin() {
      require_once "Views/login_admin.php";
    }
      
    public function ValidateAdminCredentials() {
        require_once "Models/Admin.php";
        $admin = new Admin();
        $result = $admin->validateAdmin($_POST['nombre'],md5($_POST['passwd']));
        if($result->rowCount() > 0) {
            $administrador = $result->fetch();
            $_SESSION['nombre'] = $administrador['Nombre'];
            $_SESSION['rol'] = 0;
            $this->showAdminHome();
            return;
        }
        echo "<p class=fallo >Las credenciales son incorrectas</p>";
        echo "<meta http-equiv=refresh content='2; url=index.php?controller=admin&action=logAdmin'>";
        
    }

    public function showAdminHome() {
        require_once "Views/Admin/administracion.php";
    }

}
?>