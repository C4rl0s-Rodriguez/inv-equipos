<?php
    class ControladorAreas{
        static public function ctrMostrarAreas(){
            return $respuesta = ModeloAreas::mdlMostrarAreas();
        }

        static public function ctrAgregarArea($nombreArea, $ubicacion){
            if((empty($nombreArea) || empty($ubicacion)) || (is_null($nombreArea) || is_null($ubicacion))){
                return "invalid";
            }else{
                return $respuesta = ModeloAreas::mdlAgregarArea($nombreArea, $ubicacion);
            }
        }

        static public function ctrEditarArea($idArea, $nombreArea, $ubicacion){
            if((empty($idArea) || empty($nombreArea) || empty($ubicacion)) || (is_null($idArea) || is_null($nombreArea) || is_null($ubicacion))){
                return "invalid";
            }else{
                return $respuesta = ModeloAreas::mdlEditarArea($idArea, $nombreArea, $ubicacion);
            }
        }

        static public function ctrEliminarArea($idArea){
            return $respuesta = ModeloAreas::mdlEliminarArea($idArea);
        }
    }
?>