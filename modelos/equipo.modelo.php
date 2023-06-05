<?php
require_once "conexion.php";
class ModeloEquipos{
    static public function mdlMostrarEquipos(){
        $con = Conexion::conectar();
        $stmt  = $con->prepare("SELECT e.num_inventario, e.tipo_equipo, ms.nombre_marca, e.modelo_equipo, e.num_serie, e.date_ingreso, e.estado_ingreso, ar.nombre_area, e.date_baja, e.id_equipos, e.idmarcas_table, e.idareas_table, e.idspecs, e.lugar_compra, e.num_factura, e.direc_mac, e.direc_ip, e.lugar_ciudad, sps.cpu, sps.ram, sps.almacenamiento, sps.sistema_operativo FROM equipos_table e 
        INNER JOIN marcas_table ms ON e.idmarcas_table = ms.idmarcas_table 
        INNER JOIN areas_table ar ON e.idareas_table = ar.idareas_table
        INNER JOIN specs_equipos_table sps ON e.idspecs = sps.idspecs;");

        $stmt -> execute();
        return $stmt -> fetchAll();

        $con ->close();
        $con = null;
        $stmt -> close();
        $stmt = null;
    }

    static public function mdlAgregarEquipo($numInventario, $tipoEquipo, $lugarCiudad, $marca, $modelo, $numSerie, $fechaCompra, $estado, $lugarCompra, $numFactura, $cpu, $ram, $almacenamiento, $sistemaOperativo, $dirMac, $dirIp, $ubicacion, $baja){
        $con = Conexion::conectar();
        $stmtSpecs  = $con->prepare("INSERT INTO `specs_equipos_table`( `cpu`, `ram`, `almacenamiento`, `sistema_operativo`) VALUES (:cpu, :ram, :almacenamiento, :sistemaOperativo)");
        
        $stmtSpecs -> bindParam(":cpu", $cpu, PDO::PARAM_STR);
        $stmtSpecs -> bindParam(":ram", $ram, PDO::PARAM_STR);
        $stmtSpecs -> bindParam(":almacenamiento", $almacenamiento, PDO::PARAM_STR);
        $stmtSpecs -> bindParam(":sistemaOperativo", $sistemaOperativo, PDO::PARAM_STR);

        if($stmtSpecs -> execute()){
            $lastInsertId = $con->lastInsertId();//Regresa el utilimo id
            $stmt  = $con->prepare("INSERT INTO `equipos_table`(`num_inventario`, `lugar_ciudad`, `tipo_equipo`, `idmarcas_table`, `modelo_equipo`, `num_serie`, `date_ingreso`, `lugar_compra`, `estado_ingreso`, `num_factura`, `idareas_table`, `idspecs`, `date_baja`, `direc_mac`, `direc_ip`) 
                                                VALUES (:numInventario, :lugarCiudad, :tipoEquipo, :idmarca, :modelo, :numSerie, :fechaCompra, :lugarCompra, :estado, :numFactura, :ubicacion, :idspecs, :baja, :dirMac, :dirIp)");
            $stmt -> bindParam(":numInventario", $numInventario, PDO::PARAM_STR);
            $stmt -> bindParam(":lugarCiudad", $lugarCiudad, PDO::PARAM_STR);
            $stmt -> bindParam(":tipoEquipo", $tipoEquipo, PDO::PARAM_STR);
            $stmt -> bindParam(":idmarca", $marca, PDO::PARAM_INT);
            $stmt -> bindParam(":modelo", $modelo, PDO::PARAM_STR);
            $stmt -> bindParam(":numSerie", $numSerie, PDO::PARAM_STR);
            $stmt -> bindParam(":fechaCompra", $fechaCompra, PDO::PARAM_STR);
            $stmt -> bindParam(":lugarCompra", $lugarCompra, PDO::PARAM_STR);
            $stmt -> bindParam(":estado", $estado, PDO::PARAM_STR);
            $stmt -> bindParam(":numFactura", $numFactura, PDO::PARAM_STR);
            $stmt -> bindParam(":ubicacion", $ubicacion, PDO::PARAM_INT);
            $stmt -> bindParam(":idspecs", $lastInsertId, PDO::PARAM_INT);
            $stmt -> bindParam(":baja", $baja, PDO::PARAM_STR);
            $stmt -> bindParam(":dirMac", $dirMac, PDO::PARAM_STR);
            $stmt -> bindParam(":dirIp", $dirIp, PDO::PARAM_STR);

            if($stmt -> execute()){
                /* return "El equipo se agregó exitosamente"; */
                return true; 
            }else{
                /* return "Error, no se pudo agregar el equipo"; */
                return false;
            }
        }else{
            return false;
        }

        
        

        $con ->close();
        $con = null;
        $stmt -> close();
        $stmt = null;
        $stmtSpecs -> close();
        $stmtSpecs = null;
    }

    static public function mdlEditarEquipo($idEquipo, $idSpecs, $numInventario, $tipoEquipo, $lugarCiudad, $marca, $modelo, $numSerie, $fechaCompra, $estado, $lugarCompra, $numFactura, $cpu, $ram, $almacenamiento, $sistemaOperativo, $dirMac, $dirIp, $ubicacion, $baja){
            $con = Conexion::conectar();
            $stmt  = $con->prepare("UPDATE equipos_table SET num_inventario=:numInventario, lugar_ciudad=:lugarCiudad, tipo_equipo=:tipoEquipo, idmarcas_table=:idmarca, modelo_equipo=:modelo, num_serie=:numSerie, date_ingreso=:fechaCompra, lugar_compra=:lugarCompra, estado_ingreso=:estado, num_factura=:numFactura, idareas_table=:ubicacion, idspecs=:idspecs, date_baja=:baja, direc_mac=:dirMac, direc_ip=:dirIp WHERE id_equipos=:idequipo");
            $stmt -> bindParam(":idequipo", $idEquipo, PDO::PARAM_INT); 
            $stmt -> bindParam(":numInventario", $numInventario, PDO::PARAM_STR);
            $stmt -> bindParam(":lugarCiudad", $lugarCiudad, PDO::PARAM_STR);
            $stmt -> bindParam(":tipoEquipo", $tipoEquipo, PDO::PARAM_STR);
            $stmt -> bindParam(":idmarca", $marca, PDO::PARAM_INT);
            $stmt -> bindParam(":modelo", $modelo, PDO::PARAM_STR);
            $stmt -> bindParam(":numSerie", $numSerie, PDO::PARAM_STR);
            $stmt -> bindParam(":fechaCompra", $fechaCompra, PDO::PARAM_STR);
            $stmt -> bindParam(":lugarCompra", $lugarCompra, PDO::PARAM_STR);
            $stmt -> bindParam(":estado", $estado, PDO::PARAM_STR);
            $stmt -> bindParam(":numFactura", $numFactura, PDO::PARAM_STR);
            $stmt -> bindParam(":ubicacion", $ubicacion, PDO::PARAM_INT);
            $stmt -> bindParam(":idspecs", $idSpecs, PDO::PARAM_INT);
            $stmt -> bindParam(":baja", $baja, PDO::PARAM_STR);
            $stmt -> bindParam(":dirMac", $dirMac, PDO::PARAM_STR);
            $stmt -> bindParam(":dirIp", $dirIp, PDO::PARAM_STR);

            $stmtSpecs = $con->prepare("UPDATE specs_equipos_table SET cpu=:cpu, ram=:ram, almacenamiento=:almacenamiento, sistema_operativo=:sistemaOperativo WHERE idspecs=:idspecs");
            $stmtSpecs -> bindParam(":cpu", $cpu, PDO::PARAM_STR);
            $stmtSpecs -> bindParam(":ram", $ram, PDO::PARAM_STR);
            $stmtSpecs -> bindParam(":almacenamiento", $almacenamiento, PDO::PARAM_STR);
            $stmtSpecs -> bindParam(":sistemaOperativo", $sistemaOperativo, PDO::PARAM_STR);
            $stmtSpecs -> bindParam(":idspecs", $idSpecs, PDO::PARAM_INT);

            if($stmt -> execute() && $stmtSpecs -> execute()){
                /* return "El equipo se actualizó exitosamente"; */
                return true;
            }else{
                /* return "Error, no se pudo actualizar el equipo"; */
                return false;
            }


            $con ->close();
            $con = null;
            $stmt -> close();
            $stmt = null;
            $stmtSpecs -> close();
            $stmtSpecs = null;
        }

    static public function mdlEliminarEquipo($idEquipo, $idSpecs){
        $con = Conexion::conectar();
        $stmt  = $con->prepare("DELETE FROM equipos_table WHERE id_equipos = :id");
        $stmt -> bindParam(":id", $idEquipo, PDO::PARAM_INT);

        $stmtSpecs = $con->prepare("DELETE FROM specs_equipos_table WHERE idspecs = :id");
        $stmtSpecs -> bindParam(":id", $idSpecs, PDO::PARAM_INT);   

        if($stmt -> execute() && $stmtSpecs -> execute()){
            /* return "El equipo se eliminó exitosamente"; */
            return true;
        }else{
            /* return "Error, no se pudo eliminar el equipo"; */
            return false;
        }

        $con ->close();
        $con = null;
        $stmt -> close();
        $stmt = null;
        $stmtSpecs -> close();
        $stmtSpecs = null;
    }

    static public function mdlCargarMarcas(){
        $con = Conexion::conectar();
        $stmt  = $con->prepare("SELECT idmarcas_table, nombre_marca FROM marcas_table;");
        $stmt -> execute();
        return $stmt -> fetchAll();

        $con ->close();
        $con = null;
        $stmt -> close();
        $stmt = null;
    }

    static public function mdlCargarAreas(){
        $con = Conexion::conectar();
        $stmt  = $con->prepare("SELECT idareas_table, nombre_area FROM areas_table;");
        $stmt -> execute();
        return $stmt -> fetchAll();

        $con ->close();
        $con = null;
        $stmt -> close();
        $stmt = null;
    }

    static public function mdlNumCodigo($tipoEquipo){
        $con = Conexion::conectar();
        $stmt  = $con->prepare("SELECT count(tipo_equipo) AS 'total' FROM equipos_table WHERE tipo_equipo = :tipoEquipo");
        $stmt -> bindParam(":tipoEquipo", $tipoEquipo, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetchAll();

        $con ->close();
        $con = null;
        $stmt -> close();
        $stmt = null;
    }
}
?>