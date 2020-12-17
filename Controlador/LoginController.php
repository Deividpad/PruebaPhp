<?php

    if(!isset($_SESSION))
    {
        session_start();
    }

require_once (__DIR__.'/../Modelo/Usuario.php');

if(!empty($_GET['action'])){
    LoginController::main($_GET['action']);
}else{
    //echo "No se encontro ninguna accion...";
}

class LoginController
{

    static function main($action)
    {

        if ($action == "Login") {
            LoginController::Login();
        }elseif($action == "Close"){
            LoginController::Close();
        }
    }    

    public function Login()
    {
        try {
            $User = $_POST['User'];
            $Password = $_POST['Password'];
            $respuesta = Usuario::Login($User, $Password);
            if (is_array($respuesta)) {
                $_SESSION['idUsuario'] = $respuesta['usuario'];
                echo true;
            } else {
                echo "Usuario o Contraseña Incorrecta.";
                
            }
        } catch (Exception $e) {
            header("Location: ../login.php");
        }
    }

    public function Close(){
        session_destroy();
        header("Location: ../login.php");
    }
}






