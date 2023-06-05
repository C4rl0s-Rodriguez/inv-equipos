<?php
    require_once "../controladores/login.controlador.php";
    require_once "../modelos/login.modelo.php";

    class ajaxLogin{
        public $userName;
        public $pass;

        public function iniciarSesion(){
            $respuesta = ControladorLogin::ctrIniciarSesion($this->userName, $this->pass);
            echo ($respuesta);
        }

        public function cerrarSesion(){
            $respuesta = ControladorLogin::ctrCerrarSesion();
            echo json_encode($respuesta);
        }
    }

    if(!isset($_POST["accion"])){
    }else{
        if($_POST["accion"]=="cerrarSesion"){
            $usuario = new ajaxLogin();
            $usuario->cerrarSesion();
        }
        if($_POST["accion"]=="iniciarSesion"){
            $usuario = new ajaxLogin();
            $usuario->userName = $_POST["userName"];
            $usuario->pass = $_POST["pass"];
            $usuario->iniciarSesion();
        }
    }
?>