<?php
require_once "conexion.php";
class ModeloLogin{
    static public function mdlGetUsuario($userName){
        $con = Conexion::conectar();
        $stmt  = $con->prepare("SELECT nombreUsuario, passUsuario FROM usuariosInv WHERE nombreUsuario=:nombreUsuario;");
        $stmt -> bindParam(":nombreUsuario", $userName, PDO::PARAM_STR);

        $stmt -> execute();
        return $stmt -> fetch();

        $con ->close();
        $con = null;
        $stmt -> close();
        $stmt = null;
    }
}