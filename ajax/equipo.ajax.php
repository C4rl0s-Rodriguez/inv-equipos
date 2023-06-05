<?php 
require_once "../controladores/equipo.controlador.php";
require_once "../modelos/equipo.modelo.php";

class ajaxEquipo{

    public $idEquipo;
    public $idSpecs;
    public $numInventario;
    public $tipoEquipo;
    public $lugarCiudad;
    public $marca;
    public $modelo;
    public $numSerie;
    public $fechaCompra;
    public $estado;
    public $lugarCompra;
    public $numFactura;
    public $cpu;
    public $ram;
    public $almacenamiento;
    public $sistemaOperativo;
    public $dirMac;
    public $dirIp;
    public $ubicacion;
    public $baja;
    
    public function numCodigo(){

        $respuesta = ControladorEquipos::ctrNumCodigo($this -> tipoEquipo);

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

    }

    public function cargarMarcas(){

        $respuesta = ControladorEquipos::ctrCargarMarcas();

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

    }

    public function cargarAreas(){

        $respuesta = ControladorEquipos::ctrCargarAreas();

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

    }

    public function mostrarEquipos(){

        $respuesta = ControladorEquipos::ctrMostrarEquipos();

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

    }

    public function agregarEquipo(){

        $respuesta = ControladorEquipos::ctrAgregarEquipo($this->numInventario, $this->tipoEquipo, $this->lugarCiudad, $this->marca, $this->modelo, $this->numSerie, $this->fechaCompra, $this->estado, $this->lugarCompra, $this->numFactura, $this->cpu, $this->ram, $this->almacenamiento, $this->sistemaOperativo, $this->dirMac, $this->dirIp, $this->ubicacion, $this->baja);

        /* echo json_encode($respuesta, JSON_UNESCAPED_UNICODE); */
        echo $respuesta;

    }

    public function editarEquipo(){

        $respuesta = ControladorEquipos::ctrEditarEquipo($this->idEquipo, $this->idSpecs, $this->numInventario, $this->tipoEquipo, $this->lugarCiudad, $this->marca, $this->modelo, $this->numSerie, $this->fechaCompra, $this->estado, $this->lugarCompra, $this->numFactura, $this->cpu, $this->ram, $this->almacenamiento, $this->sistemaOperativo, $this->dirMac, $this->dirIp, $this->ubicacion, $this->baja);

        /* echo json_encode($respuesta, JSON_UNESCAPED_UNICODE); */
        echo $respuesta;
    }

    public function eliminarEquipo(){
        
        $respuesta = ControladorEquipos::ctrEliminarEquipo($this -> idEquipo, $this -> idSpecs);

        /* echo json_encode($respuesta, JSON_UNESCAPED_UNICODE); */
        echo $respuesta;
    }
}

if(!isset($_POST["accion"])){

    $cargarDatos = new ajaxEquipo();

    $cargarDatos -> mostrarEquipos();

}else{
    if($_POST["accion"]=="eliminar"){
        $eliminar = new ajaxEquipo();
        $eliminar -> idEquipo = $_POST["idEquipo"];
        $eliminar -> idSpecs = $_POST["idSpecs"];
        $eliminar -> eliminarEquipo();
    }
    if($_POST["accion"]=="agregar"){
        $agregar = new ajaxEquipo();
        $agregar -> numInventario = $_POST["numInventario"];
        $agregar -> tipoEquipo = $_POST["tipoEquipo"];
        $agregar -> lugarCiudad = $_POST["lugarCiudad"];
        $agregar -> marca = $_POST["marca"];
        $agregar -> modelo = $_POST["modelo"];
        $agregar -> numSerie = $_POST["numSerie"];
        $agregar -> fechaCompra = $_POST["fechaCompra"];
        $agregar -> estado = $_POST["estado"];
        $agregar -> lugarCompra = $_POST["lugarCompra"];
        $agregar -> numFactura = $_POST["numFactura"];
        $agregar -> cpu = $_POST["cpu"];
        $agregar -> ram = $_POST["ram"];
        $agregar -> almacenamiento = $_POST["almacenamiento"];
        $agregar -> sistemaOperativo = $_POST["sistemaOperativo"];
        $agregar -> dirMac = $_POST["dirMac"];
        $agregar -> dirIp = $_POST["dirIp"];
        $agregar -> ubicacion = $_POST["ubicacion"]; 
        $agregar -> baja = $_POST["baja"];
        $agregar -> agregarEquipo();
    }
    if($_POST["accion"]=="editar"){
        $editar = new ajaxEquipo();
        $editar -> idEquipo = $_POST["idEquipo"];
        $editar -> idSpecs = $_POST["idSpecs"];
        $editar -> numInventario = $_POST["numInventario"];
        $editar -> tipoEquipo = $_POST["tipoEquipo"];
        $editar -> lugarCiudad = $_POST["lugarCiudad"];
        $editar -> marca = $_POST["marca"];
        $editar -> modelo = $_POST["modelo"];
        $editar -> numSerie = $_POST["numSerie"];
        $editar -> fechaCompra = $_POST["fechaCompra"];
        $editar -> estado = $_POST["estado"];
        $editar -> lugarCompra = $_POST["lugarCompra"];
        $editar -> numFactura = $_POST["numFactura"];
        $editar -> cpu = $_POST["cpu"];
        $editar -> ram = $_POST["ram"];
        $editar -> almacenamiento = $_POST["almacenamiento"];
        $editar -> sistemaOperativo = $_POST["sistemaOperativo"];
        $editar -> dirMac = $_POST["dirMac"];
        $editar -> dirIp = $_POST["dirIp"];
        $editar -> ubicacion = $_POST["ubicacion"]; 
        $editar -> baja = $_POST["baja"];
        $editar -> editarEquipo();
    }
    if($_POST["accion"]=="marcasSelect"){
        $cargarMarcas = new ajaxEquipo();
        $cargarMarcas -> cargarMarcas();
    }
    if($_POST["accion"]=="areasSelect"){
        $cargarMarcas = new ajaxEquipo();
        $cargarMarcas -> cargarAreas();
    }
    if($_POST["accion"]=="numCodigo"){
        $generarNumero = new ajaxEquipo();
        $generarNumero -> tipoEquipo = $_POST["tipoEquipo"];
        $generarNumero -> numCodigo();
    }
}


?>