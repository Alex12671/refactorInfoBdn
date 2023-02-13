<?php
class NoSessionFoundException extends Exception {
    public function errorMessage() {
        $errorMsg = "Debes iniciar sesión primero";
        return $errorMsg;
    }
}
?>