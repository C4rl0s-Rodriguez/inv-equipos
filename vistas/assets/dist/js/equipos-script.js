var forms = document.querySelectorAll('.needs-validation')
//VARIABLE PARA ACCIONES DE AJAX
var accion = "";
var edicion = false;

//INICIAR SELECTS
loadSelect();

//Inicializando Tabla
var tablaEquipos = $('#tablareg').DataTable({
    responsive: true,
    ajax: {
        "url": "ajax/equipo.ajax.php",
        "type": "POST",
        "dataSrc":""
    },
    language: {
        "decimal":        "",
        "emptyTable":     "No hay información",
        "info":           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
        "infoEmpty":      "Mostrando 0 a 0 de 0 entradas",
        "infoFiltered":   "(Filtrado de _MAX_ entradas totales)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Mostrando _MENU_",
        "loadingRecords": "Cargando...",
        "processing":     "",
        "search":         "Buscar:",
        "zeroRecords":    "Ningun resultado encontrado",
        "paginate": {
            "first":      "Primero",
            "last":       "Ultimo",
            "next":       "Siguiente",
            "previous":   "Anterior"
        }
    }, 
    autoWidth: false,
    columnDefs:[
        {
            "targets": 9,
            "soportable": false,
            "render": function (data, type, full, meta){
                return "<center>"+
                            "<button type='button' class='btn btn-primary btn-sm btnEditar mt-2' data-bs-toggle='modal' data-bs-target='#modal-gestionar-equipos'> " +
                                "<i class='fas fa-pencil-alt'></i> " +
                            " </button> " +
                            "<button type='button' class='btn btn-danger btn-sm btnEliminar mt-2' idEquipo='"+data+"'> " +
                                "<i class='fas fa-trash'> </i> "+
                            " </button> "+
                            "<button type='button' class='btn btn-success btn-sm btnVerInfo mt-2' data-bs-toggle='modal' data-bs-target='#modal-gestionar-equipos'> " +
                                "<i class='fas fa-eye'> </i> "+
                            " </button>"+
                        "</center>";
            }
        }
    ],
    column:[
        {"data": "num_inventario"},
        {"data": "tipo_equipo"},
        {"data": "nombre_marca"},
        {"data": "modelo_equipo"},
        {"data": "num_serie"},
        {"data": "date_ingreso"},
        {"data": "estado_ingreso"},
        {"data": "nombre_area"},
        {"data": "date_baja"},
        {"data": "acciones"}
    ],
    dom: "<'row mb-2'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
});

//ACCION DEL BOTON ELIMINAR
$("#tablareg tbody").on("click", ".btnEliminar", function(){
    var data;
    let idEquipo;
    let idSpecs;
    accion = "eliminar";
    
    var dataResp = tablaEquipos.row( this ).data(); //Obtener datos de row responsive datatables
    var dataRows = tablaEquipos.row($(this).parents('tr')).data(); //Obtener datos de row datatables

    if(dataResp){
        data = dataResp;
    }else if(dataRows){
        data = dataRows;
    } 
    console.log(data);

    idEquipo = data.id_equipos;
    idSpecs = data.idspecs;

    var datos = new FormData();
    datos.append("idEquipo", idEquipo);
    datos.append("idSpecs", idSpecs);
    datos.append("accion", accion);

    swal.fire({
        title: "¡CONFIRMAR!",
        text: "¿Está seguro que desea eliminar la el equipo?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar"
    }).then(resultado =>{ //FUNCION A EJECUTAR DESPUES

        if(resultado.value){ //SI LA CONFIRMACION FUE POSITIVA EJECUTA
            //LLAMADO A AJAX
            $.ajax({
                url:"ajax/equipo.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success : function(respuesta){
                    tablaEquipos.ajax.reload(null, false);
                    if(respuesta == 1){
                        Toast.fire({
                            icon: "success",
                            title: "El equipo se eliminó exitosamente"
                        });
                    }else{
                        Toast.fire({
                            icon: "error",
                            title: "Error, no se pudo eliminar el equipo"
                        });
                    }
                    
                }
            });
        }
    })
})

//ACCION DEL BOTON AGREGAR
$("#btnAgregarEquipo").on("click", function(){
    setEnableForm();
    $("#ttlModalEquipos").text("Agregar Nuevo Equipo");
    $("#txtIdEquipo").val("");
    $("#txtIdSpecs").val("");
    $("#txtNumInventario").val("");
    $("#sltTipoEquipo").val("");
    $("#sltCiudad").val("");
    $("#sltMarca").val([0]);
    $("#txtModelo").val("");
    $("#txtNumSerie").val("");
    $("#txtFechaCompra").val("");
    $("#sltEstado").val("");
    $("#txtLugarCompra").val("");
    $("#txtNumFactura").val("");
    $("#txtCpu").val("");
    $("#txtRam").val("");
    $("#txtAlmacenamiento").val("");
    $("#sltSO").val("");
    $("#txtDirMac").val("");
    $("#txtDirIp").val("");
    $("#sltArea").val([0]);
    $("#txtBaja").val("----");
    $("#txtBaja").prop("disabled", true);
    $("#formEquipos").removeClass("was-validated");
    edicion=false;
})

//ACCION DEL BOTON EDITAR
$("#tablareg tbody").on("click", ".btnEditar", function(){
    setEnableForm();
    var data;
    var dataResp = tablaEquipos.row( this ).data(); //Obtener datos de row responsive datatables
    var dataRows = tablaEquipos.row($(this).parents('tr')).data(); //Obtener datos de row datatables

    if(dataResp){
        data = dataResp;
    }else if(dataRows){
        data = dataRows;
    }   
    console.log(data);
    $("#ttlModalEquipos").text("Editar Equipo");

    $("#txtIdEquipo").val(data["id_equipos"]);
    $("#txtIdSpecs").val(data["idspecs"]);
    $("#txtNumInventario").val(data["num_inventario"]);
    $("#sltTipoEquipo").val(data["tipo_equipo"]);
    $("#sltTipoEquipo").prop("disabled", true);
    $("#sltCiudad").val(data["lugar_ciudad"]);
    $("#sltCiudad").prop("disabled", true);
    $("#sltMarca").val(data["idmarcas_table"]);
    $("#txtModelo").val(data["modelo_equipo"]);
    $("#txtNumSerie").val(data["num_serie"]);
    $("#txtFechaCompra").val(data["date_ingreso"]);
    $("#sltEstado").val(data["estado_ingreso"]);
    $("#txtLugarCompra").val(data["lugar_compra"]);
    $("#txtNumFactura").val(data["num_factura"]);
    if(data["tipo_equipo"]=="IMPRESORA"){
        $("#txtRam").prop("disabled", true);
        $("#txtAlmacenamiento").prop("disabled", true);
        $("#txtCpu").prop("disabled", true);
        $("#stnEspec").css("display", "none");
    }else{
        $("#txtCpu").val(data["cpu"]);
        $("#txtRam").val(data["ram"]);
        $("#txtAlmacenamiento").val(data["almacenamiento"]);
        $("#sltSO").val(data["sistema_operativo"]);
    }
    $("#txtDirMac").val(data["direc_mac"]);
    $("#txtDirIp").val(data["direc_ip"]);
    $("#sltArea").val(data["idareas_table"]);
    if(data["date_baja"] == "----"){
        $("#txtBaja").prop("type", "date");
        $("#txtBaja").val(data["date_baja"]);
        $("#txtBaja").prop("disabled", false);
    }else{
        $("#txtBaja").val(data["date_baja"]);
        $("#txtBaja").prop("disabled", true);
    }
    
    edicion=true;
    $("#formEquipos").removeClass("was-validated");
})

//ACCION DEL BOTON VER
$("#tablareg tbody").on("click", ".btnVerInfo", function(){
    setEnableForm();
    var data;
    var dataResp = tablaEquipos.row( this ).data(); //Obtener datos de row responsive datatables
    var dataRows = tablaEquipos.row($(this).parents('tr')).data(); //Obtener datos de row datatables

    if(dataResp){
        data = dataResp;
    }else if(dataRows){
        data = dataRows;
    }
    $("#ttlModalEquipos").text("Ver Equipo");

    $("#txtNumInventario").val(data["num_inventario"]);
    $("#sltTipoEquipo").val(data["tipo_equipo"]);
    $("#sltCiudad").val(data["lugar_ciudad"]);
    $("#sltMarca").val(data["idmarcas_table"]);
    $("#txtModelo").val(data["modelo_equipo"]);
    $("#txtNumSerie").val(data["num_serie"]);
    $("#txtFechaCompra").val(data["date_ingreso"]);
    $("#sltEstado").val(data["estado_ingreso"]);
    $("#txtLugarCompra").val(data["lugar_compra"]);
    $("#txtNumFactura").val(data["num_factura"]);
    $("#txtCpu").val(data["cpu"]);
    $("#txtRam").val(data["ram"]);
    $("#txtAlmacenamiento").val(data["almacenamiento"]);
    $("#sltSO").val(data["sistema_operativo"]);
    $("#txtDirMac").val(data["direc_mac"]);
    $("#txtDirIp").val(data["direc_ip"]);
    $("#sltArea").val(data["idareas_table"]);
    $("#txtBaja").val(data["date_baja"]);

    $("#txtNumInventario").prop("disabled", true);
    $("#sltTipoEquipo").prop("disabled", true);
    $("#sltCiudad").prop("disabled", true);
    $("#sltMarca").prop("disabled", true);
    $("#txtModelo").prop("disabled", true);
    $("#txtNumSerie").prop("disabled", true);
    $("#txtFechaCompra").prop("disabled", true);
    $("#sltEstado").prop("disabled", true);
    $("#txtLugarCompra").prop("disabled", true);
    $("#txtNumFactura").prop("disabled", true);
    $("#txtCpu").prop("disabled", true);
    $("#txtRam").prop("disabled", true);
    $("#txtAlmacenamiento").prop("disabled", true);
    $("#sltSO").prop("disabled", true);
    $("#txtDirMac").prop("disabled", true);
    $("#txtDirIp").prop("disabled", true);
    $("#sltArea").prop("disabled", true);
    $("#txtBaja").prop("disabled", true);
    $("#btnGuardar").prop("disabled", true);

    $("#formEquipos").removeClass("was-validated");
})

//ACCION DEL GENERAR CODIGO DE INVENTARIO
$(".codeGenerate").on("change", function(){
    let equipo = "";
    let lugar = "";
    let numEquipo="000";
    let numInventario;
    let ajaxEquipo;

    accion = "numCodigo";

    if($("#sltTipoEquipo").val() == "LAPTOP"){
        equipo = "LAP";
        ajaxEquipo = "LAPTOP";
    }else if($("#sltTipoEquipo").val() == "AIO"){
        equipo = "AIO";
        ajaxEquipo = "AIO";
    }else if($("#sltTipoEquipo").val() == "PC"){
        equipo = "CPU";
        ajaxEquipo = "PC";
    }else if($("#sltTipoEquipo").val() == "IMPRESORA"){
        equipo = "IMP";
        ajaxEquipo = "IMPRESORA";
    }else if($("#sltTipoEquipo").val() == "SERVIDOR"){
        equipo = "SER";
        ajaxEquipo = "SERVIDOR";
    }

    if($("#sltCiudad").val() == "MAZATLÁN"){
        lugar = "MZT";
    }else if($("#sltCiudad").val() == "CULIACÁN"){
        lugar = "CLN";
    }else if($("#sltCiudad").val() == "LA PAZ"){
        lugar = "LPZ";
    }

    if(equipo=="IMP"){
        $("#txtRam").prop("disabled", true);
        $("#txtAlmacenamiento").prop("disabled", true);
        $("#txtCpu").prop("disabled", true);
        $("#sltSO").prop("disabled", true);
        $("#stnEspec").css("display", "none");
    }else{
        $("#txtRam").prop("disabled", false);
        $("#txtAlmacenamiento").prop("disabled", false);
        $("#txtCpu").prop("disabled", false);
        $("#sltSO").prop("disabled", false);
        $("#stnEspec").css("display", "flex");
    }

    //LLAMADO A AJAX
    var datos = new FormData();
    datos.append("accion", accion);
    datos.append("tipoEquipo", ajaxEquipo);
    if(equipo){
        if(!edicion){
            $.ajax({
                url:"ajax/equipo.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success : function(respuesta){
                    var datos = JSON.parse(respuesta); //CONVERTIR JSON ENCODE A JSON
                    numEquipo = datos[0].total+1; //Se incrementa el numero de equipo
                    numInventario = `${lugar}-${equipo}-${numEquipo.toString().padStart(3, '0')}`;
                    $("#txtNumInventario").val(numInventario);
                }
            });

        }
    }else{
            numInventario = `${lugar}-${equipo}-${numEquipo}`;
        $("#txtNumInventario").val(numInventario);
    }
            
});

//ACCION PARA GUARDAR LOS EQUIPO
$("#btnGuardar").on("click", function(){
    if($("#txtIdEquipo").val() == '' && $("#txtIdSpecs").val() == ''){
        accion = "agregar";
    }else{
        accion = "editar";
    }
    edicion=false;
    
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            Toast.fire({
                icon: "warning",
                title: "Faltan campos por llenar"
            });
            }else{
                //Validado
                //ALERTA DE CONFIRMACION PARA AGREGAR NUEVO USUARIO
                swal.fire({

                    title: "¡CONFIRMAR!",
                    text: "¿Está seguro que desea guardar el equipo?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Aceptar",
                    cancelButtonText: "Cancelar"

                }).then(resultado =>{ //FUNCION A EJECUTAR DESPUES
                    let idEquipo = $("#txtIdEquipo").val();
                    let idSpecs = $("#txtIdSpecs").val();
                    let numInventario = $("#txtNumInventario").val();
                    let tipoEquipo = $("#sltTipoEquipo").val();
                    let lugarCiudad = $("#sltCiudad").val();
                    let marca = $("#sltMarca").val();
                    let modelo = $("#txtModelo").val();
                    let numSerie = $("#txtNumSerie").val();
                    let fechaCompra = $("#txtFechaCompra").val();
                    let estado = $("#sltEstado").val();
                    let lugarCompra = $("#txtLugarCompra").val();
                    let numFactura = $("#txtNumFactura").val();
                    let cpu;
                    let ram;
                    let almacenamiento;
                    let sistemaOperativo;
                    if(tipoEquipo=="IMPRESORA"){
                        cpu = "-";
                        ram = "-";
                        almacenamiento = "-";
                        sistemaOperativo = "N/A";
                    }else{
                        cpu = $("#txtCpu").val();
                        ram = $("#txtRam").val();
                        almacenamiento = $("#txtAlmacenamiento").val();
                        sistemaOperativo = $("#sltSO").val();
                    }
                    let dirMac = $("#txtDirMac").val();
                    let dirIp = $("#txtDirIp").val();
                    let ubicacion = $("#sltArea").val();
                    let baja;
                    if($("#txtBaja").val() == ''){
                        baja = "----";
                    }else{
                        baja = $("#txtBaja").val();
                    }
                    
                    var datos = new FormData();
                    datos.append("accion", accion);
                    datos.append("idEquipo", idEquipo);
                    datos.append("idSpecs", idSpecs);
                    datos.append("numInventario", numInventario);
                    datos.append("tipoEquipo", tipoEquipo);
                    datos.append("lugarCiudad", lugarCiudad);
                    datos.append("marca", marca);
                    datos.append("modelo", modelo);
                    datos.append("numSerie", numSerie);
                    datos.append("fechaCompra", fechaCompra);
                    datos.append("estado", estado);
                    datos.append("lugarCompra", lugarCompra);
                    datos.append("numFactura", numFactura);
                    datos.append("cpu", cpu);
                    datos.append("ram", ram);
                    datos.append("almacenamiento", almacenamiento);
                    datos.append("sistemaOperativo", sistemaOperativo);
                    datos.append("dirMac", dirMac);
                    datos.append("dirIp", dirIp);
                    datos.append("ubicacion", ubicacion);
                    datos.append("baja", baja);
                    if(resultado.value){ //SI LA CONFIRMACION FUE POSITIVA EJECUTA
                        //LLAMADA A AJAX
                        $.ajax({
                            url:"ajax/equipo.ajax.php",
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success : function(respuesta){
                                //console.log(respuesta);
                                $("#modal-gestionar-equipos").modal("hide");
                                tablaEquipos.ajax.reload(null, false);
                                if(respuesta == 1){
                                    if(accion == "agregar"){
                                        Toast.fire({
                                            icon: "success",
                                            title: "El equipo se agregó exitosamente"
                                        });
                                    }else{
                                        Toast.fire({
                                            icon: "success",
                                            title: "El equipo se actualizó exitosamente"
                                        });
                                    }
                                }else{
                                    if(accion == "agregar"){
                                        Toast.fire({
                                            icon: "error",
                                            title: "Error, no se pudo agregar el equipo"
                                        });
                                    }else{
                                        Toast.fire({
                                            icon: "error",
                                            title: "Error, no se pudo actualizar el equipo"
                                        });
                                    }
                                }
                                if(respuesta == "invalid"){
                                    Toast.fire({
                                        icon: "error",
                                        title: "Error, datos invalidos"
                                    });
                                }
                            }
                        });
                    }
                })
            }
            form.classList.add('was-validated')
            
        }, false)
    })
});

//CARGAR EL CONTENIDO DE LOS SELECTS
function loadSelect(){
    //LLAMADO A AJAX
    accion = "marcasSelect";
    var datos = new FormData();
    datos.append("accion", accion);

    $.ajax({
        url:"ajax/equipo.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success : function(respuesta){
            var datos = JSON.parse(respuesta); //CONVERTIR JSON ENCODE A JSON

            $.each(datos, function(i, item) {
                var select = $("#sltMarca");
                select.append(`<option value="${item.idmarcas_table}">${item.nombre_marca}</option>`);
            });
        
        }
    });

    accion = "areasSelect";
    var datos = new FormData();
    datos.append("accion", accion);

    $.ajax({
        url:"ajax/equipo.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success : function(respuesta){
            var datos = JSON.parse(respuesta); //CONVERTIR JSON ENCODE A JSON

            $.each(datos, function(i, item) {
                var select = $("#sltArea");
                select.append(`<option value="${item.idareas_table}">${item.nombre_area}</option>`);
            });
        
        }
    });
}

$("#btnDownload").on("click", function(){
    let fecha = new Date();
    let dia = fecha.getDate().toString().padStart(2, '0');
    let mes = fecha.getMonth().toString().padStart(2, '0');
    let year = fecha.getFullYear().toString();
    fecha = `${year}-${mes}-${dia}`;

    var dataResp = tablaEquipos.rows().data().toArray(); //Obtener datos de row responsive datatables
    var string = JSON.stringify(dataResp, ["num_inventario", "tipo_equipo", "nombre_marca", "modelo_equipo", "num_serie", "date_ingreso", "estado_ingreso", "nombre_area", "date_baja"]);
    var jsonData = JSON.parse(string);

    
    let data = [];
    jsonData.forEach((element, index, array) => {
        data.push([element.num_inventario, element.tipo_equipo, element.nombre_marca, element.modelo_equipo, element.num_serie, element.date_ingreso, element.estado_ingreso, element.nombre_area, element.date_baja]);
    });


    // Default export is a4 paper, portrait, using millimeters for units
    var doc = new jsPDF({format: "letter", orientation: "landscape"});

    doc.setLineWidth(.7);
    doc.rect(77, 12.5, 170, 7);
    doc.setFont("calibri-regular");
    doc.setFontSize(12);
    doc.text("INVENTARIO DE EQUIPOS DE COMPUTO", 120, 18, null, null);


    var img = new Image();
    img.src = "vistas/assets/dist/img/logo.png";
    doc.addImage(img, "PNG", 13, 10, 51, 16); // x, y, ancho, alto
    doc.autoTable({ 
        head: [],
        body: data,
        columns: [{header: 'N° DE INVENTARIO', dataKey: 'numInventario'}, {header: 'EQUIPO / INSTRUMENTO', dataKey: 'tipoEquipo'}, {header: 'MARCA', dataKey: 'marca'}, {header: 'MODELO', dataKey: 'modelo'}, {header: 'N° DE SERIE', dataKey: 'numSerie'}, {header: 'AÑO DE COMPRA', dataKey: 'date_compra'}, {header: 'EDO. AL INCORPORAR', dataKey: 'estadoIngreso'}, {header: 'UBICACION', dataKey: 'ubicacion'}, {header: 'BAJA', dataKey: 'baja'}],
        startY: 28,
        theme: "striped",
        styles: {fontSize: 7, halign: "center", valign: "middle", lineWidth: .4, lineColor: Color = 1},
        headStyles: {
            cellPadding: padding = {top: 2, right: 0, bottom: 2, left: 0},
            fillColor: [76,132,188]
        },
        bodyStyles: { 
            
        },
        alternateRowStyles: { //Modificar stripes
            fillColor: [220,227,243],
        },
        columnStyles: {
            numInventario: {cellWidth: 28},
            marca: {cellWidth: 22},
            modelo: {cellWidth: 30},
            numSerie: {cellWidth: 40},
            baja: {cellWidth: 20}

        }
    });
    
    

    const pageCount = doc.internal.getNumberOfPages();
    for(var i = 1; i <= pageCount; i++) {
        doc.setPage(i);
        doc.setFontSize(11);
        doc.text('LAQUIN MR SA DE CV', doc.internal.pageSize.width/2, 204, { align: 'center' }); //CENTER TEXT
        doc.text(i+' de '+pageCount, doc.internal.pageSize.width/2, 209, { align: 'center' });
        doc.text("F 027-B", 260, 207, { align: 'center' });
    }
    /* doc.output('bloburl') */
    /* window.open(doc.output('bloburl')); */
    //doc.autoPrint({variant: 'non-conform'});
    /* doc.output('datauri'); */
    console.log(doc.getFontList());
    doc.save(`${fecha} F027-B`);


})

$("#btnCerrarSesion").on("click", function(){
    var datos = new FormData();
    datos.append("accion", "cerrarSesion");
    $.ajax({
        url:"ajax/login.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success : function(respuesta){
            location.reload();
        }
    });
    
})

function setEnableForm(){
    $("#sltTipoEquipo").prop("disabled", false);
    $("#sltCiudad").prop("disabled", false);
    $("#sltMarca").prop("disabled", false);
    $("#txtModelo").prop("disabled", false);
    $("#txtNumSerie").prop("disabled", false);
    $("#txtFechaCompra").prop("disabled", false);
    $("#sltEstado").prop("disabled", false);
    $("#txtLugarCompra").prop("disabled", false);
    $("#txtNumFactura").prop("disabled", false);
    $("#txtCpu").prop("disabled", false);
    $("#txtRam").prop("disabled", false);
    $("#txtAlmacenamiento").prop("disabled", false);
    $("#sltSO").prop("disabled", false);
    $("#txtDirMac").prop("disabled", false);
    $("#txtDirIp").prop("disabled", false);
    $("#sltArea").prop("disabled", false);
    $("#txtBaja").prop("disabled", false);
    $("#btnGuardar").prop("disabled", false);
    $("#txtBaja").prop("type", "text");
    $("#stnEspec").css("display", "flex");
}

/* function validarForm(){
    if($("#txtNumInventario").val() == '' || $("#sltTipoEquipo").val() == 'none' || $("#sltMarca").val() == 'none' || $("#sltMarca").val() == '' || $("#txtNumSerie").val() == '' || $("#txtFechaCompra").val() == '' || $("#sltEstado").val() == 'none' ||   $("#sltArea").val() == 'none' || $("#txtBaja").val() == ''){
        return false;
    } return true
} */







