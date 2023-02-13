<?php
class PermissionException extends Exception {
    public function errorMessage() {
        $errorMsg = "No tienes los permisos necesarios";
        return $errorMsg;
    }
}
?>