<?php 
    require_once "conexion.php";
    class ModeloAreas{
        static public function mdlMostrarAreas(){
            $con = Conexion::conectar();
            $stmt = $con->prepare("SELECT `idareas_table`, `nombre_area`, `ubicacion`, 'X' as acciones  FROM `areas_table`");

            if($stmt -> execute()){
                return $stmt -> fetchAll();
            }else{
                return "Error";
            }
            
            $con ->close();
            $con = null;
            $stmt -> close();
            $stmt = null;
        }

        static public function mdlAgregarArea($nombreArea, $ubicacion){
            $con = Conexion::conectar();
            $stmt = $con->prepare("INSERT INTO `areas_table` (`nombre_area`, `ubicacion`) VALUES (:nombreArea, :ubicacion)");

            $stmt -> bindParam(":nombreArea", $nombreArea, PDO::PARAM_STR);
            $stmt -> bindParam(":ubicacion", $ubicacion, PDO::PARAM_STR);

            if($stmt -> execute()){
                return true;
            }else{
                return false;
            }
            
            $con ->close();
            $con = null;
            $stmt -> close();
            $stmt = null;
        }

        static public function mdlEditarArea($idArea, $nombreArea, $ubicacion){
            $con = Conexion::conectar();
            $stmt = $con->prepare("UPDATE `areas_table` SET `nombre_area`=:nombreArea, `ubicacion`=:ubicacion WHERE idareas_table=:idArea");

            $stmt -> bindParam(":nombreArea", $nombreArea, PDO::PARAM_STR);
            $stmt -> bindParam(":ubicacion", $ubicacion, PDO::PARAM_STR);
            $stmt -> bindParam(":idArea", $idArea, PDO::PARAM_INT);

            if($stmt -> execute()){
                return true;
            }else{
                return false;
            }
            
            $con ->close();
            $con = null;
            $stmt -> close();
            $stmt = null;
        }

        static public function mdlEliminarArea($idArea){
            $con = Conexion::conectar();
            $stmt = $con->prepare("DELETE FROM `areas_table` WHERE idareas_table=:idArea");

            $stmt -> bindParam(":idArea", $idArea, PDO::PARAM_INT);

            if($stmt -> execute()){
                return true;
            }else{
                return false;
            }
            
            $con ->close();
            $con = null;
            $stmt -> close();
            $stmt = null;
        }
    }
?>