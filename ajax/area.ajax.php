<?php
    require_once "../controladores/area.controlador.php";
    require_once "../modelos/area.modelo.php";

    class ajaxArea{
        public $idArea;
        public $nombreArea;
        public $ubicacion;

        public function mostrarAreas(){
            $respuesta = ControladorAreas::ctrMostrarAreas();
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }

        public function agregarArea(){
            $respuesta = ControladorAreas::ctrAgregarArea($this->nombreArea, $this->ubicacion);
            echo $respuesta;
        }

        public function editarArea(){
            $respuesta = ControladorAreas::ctrEditarArea($this->idArea, $this->nombreArea, $this->ubicacion);
            echo $respuesta;
        }

        public function eliminarArea(){
            $respuesta = ControladorAreas::ctrEliminarArea($this->idArea);
            echo $respuesta;
        }
    }

    if(!isset($_POST["accion"])){
        $cargarDatos = new ajaxArea();
        $cargarDatos -> mostrarAreas();
    }else{
        if($_POST["accion"]=="agregar"){
            $agregar = new ajaxArea();
            $agregar->nombreArea = $_POST["nombreArea"];
            $agregar->ubicacion = $_POST["ubicacion"];
            $agregar->agregarArea();
        }
        if($_POST["accion"]=="editar"){
            $editar = new ajaxArea();
            $editar->idArea = $_POST["idArea"];
            $editar->nombreArea = $_POST["nombreArea"];
            $editar->ubicacion = $_POST["ubicacion"];
            $editar->editarArea();
        }
        if($_POST["accion"]=="eliminar"){
            $eliminar = new ajaxArea();
            $eliminar->idArea = $_POST["idArea"];
            $eliminar->eliminarArea();
        }
    }
?>