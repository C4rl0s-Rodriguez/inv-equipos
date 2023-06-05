<?php
    
    class ControladorLogin{
        static public function ctrIniciarSesion($userName, $pass){
            session_start();
            if(empty($userName) || empty($pass) || is_null($userName) || is_null($pass)){

                return "invalid";

            }else{

                $usuario = ModeloLogin::mdlGetUsuario($userName);
                if($userName == $usuario["nombreUsuario"] && $pass == $usuario["passUsuario"]){
                    $_SESSION["estado"] = "1";
                    $_SESSION["nombre"] = $userName;
                    return true;
                }else{
                    return "wrong";
                }

            }
            
        }

        static public function ctrCerrarSesion(){
            session_start();
            $_SESSION = array();

            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            session_destroy();
        }
    }
?>