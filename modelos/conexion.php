<?php

class Conexion{
    static public function conectar(){
       $con  = new PDO("mysql:host=192.168.1.44;port=3306;dbname=inv_equipos", "prueba", "1234", 
                        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        return $con;
    }
}
?>
