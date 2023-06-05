<?php 
class ControladorEquipos{
    static public function ctrNumCodigo($tipoEquipo){
        if(empty($tipoEquipo) || is_null($tipoEquipo)){
            return "invalid";
        }else{
            return $respuesta = ModeloEquipos::mdlNumCodigo($tipoEquipo);
        }
        
    }

    static public function ctrCargarAreas(){
        return $respuesta = ModeloEquipos::mdlCargarAreas();
    }

    static public function ctrCargarMarcas(){
        return $respuesta = ModeloEquipos::mdlCargarMarcas();
    }

    static public function ctrMostrarEquipos(){
        return $respuesta = ModeloEquipos::mdlMostrarEquipos();
    }

    static public function ctrAgregarEquipo($numInventario, $tipoEquipo, $lugarCiudad, $marca, $modelo, $numSerie, $fechaCompra, $estado, $lugarCompra, $numFactura, $cpu, $ram, $almacenamiento, $sistemaOperativo, $dirMac, $dirIp, $ubicacion, $baja){
        if((empty($numInventario) || empty($tipoEquipo) || empty($lugarCiudad) || empty($marca) || empty($modelo) || empty($numSerie) || empty($fechaCompra) || empty($estado) || empty($lugarCompra) || empty($numFactura) || empty($cpu) || empty($ram) || empty($almacenamiento) || empty($sistemaOperativo) || empty($dirMac) || empty($dirIp) || empty($ubicacion) || empty($baja)) || 
            (is_null($numInventario) || is_null($tipoEquipo) || is_null($lugarCiudad) || is_null($marca) || is_null($modelo) || is_null($numSerie) || is_null($fechaCompra) || is_null($estado) || is_null($lugarCompra) || is_null($numFactura) || is_null($cpu) || is_null($ram) || is_null($almacenamiento) || is_null($sistemaOperativo) || is_null($dirMac) || is_null($dirIp) || is_null($ubicacion) || is_null($baja))){
                return "invalid";
        }else{
            return $respuesta = ModeloEquipos::mdlAgregarEquipo($numInventario, $tipoEquipo, $lugarCiudad, $marca, $modelo, $numSerie, $fechaCompra, $estado, $lugarCompra, $numFactura, $cpu, $ram, $almacenamiento, $sistemaOperativo, $dirMac, $dirIp, $ubicacion, $baja);
        }
    }

    static public function ctrEditarEquipo($idEquipo, $idSpecs, $numInventario, $tipoEquipo, $lugarCiudad, $marca, $modelo, $numSerie, $fechaCompra, $estado, $lugarCompra, $numFactura, $cpu, $ram, $almacenamiento, $sistemaOperativo, $dirMac, $dirIp, $ubicacion, $baja){
        if((empty($idEquipo) || empty($idSpecs) || empty($numInventario) || empty($tipoEquipo) || empty($lugarCiudad) || empty($marca) || empty($modelo) || empty($numSerie) || empty($fechaCompra) || empty($estado) || empty($lugarCompra) || empty($numFactura) || empty($cpu) || empty($ram) || empty($almacenamiento) || empty($sistemaOperativo) || empty($dirMac) || empty($dirIp) || empty($ubicacion) || empty($baja)) || 
            (is_null($idEquipo) || is_null($idSpecs) || is_null($numInventario) || is_null($tipoEquipo) || is_null($lugarCiudad) || is_null($marca) || is_null($modelo) || is_null($numSerie) || is_null($fechaCompra) || is_null($estado) || is_null($lugarCompra) || is_null($numFactura) || is_null($cpu) || is_null($ram) || is_null($almacenamiento) || is_null($sistemaOperativo) || is_null($dirMac) || is_null($dirIp) || is_null($ubicacion) || is_null($baja))){
                return "invalid";
        }else{
            return $respuesta = ModeloEquipos::mdlEditarEquipo($idEquipo, $idSpecs, $numInventario, $tipoEquipo, $lugarCiudad, $marca, $modelo, $numSerie, $fechaCompra, $estado, $lugarCompra, $numFactura, $cpu, $ram, $almacenamiento, $sistemaOperativo, $dirMac, $dirIp, $ubicacion, $baja);
        }
        
    }

    static public function ctrEliminarEquipo($idEquipo, $idSpecs){
        if((empty($idEquipo) || empty($idSpecs)) || (is_null($idEquipo) || is_null($idSpecs))){
            return "invalid";
        }else{
            return $respuesta = ModeloEquipos::mdlEliminarEquipo($idEquipo, $idSpecs);
        }
        
    }

    
}
?>