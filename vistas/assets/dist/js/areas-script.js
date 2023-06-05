
var forms = document.querySelectorAll('.needs-validation')
var tablaAreas;
//VARIABLE PARA ACCIONES DE AJAX
var accion = "";
var edicion = false;
//Inicializando Tabla
tablaAreas = $('#tblAreas').DataTable({
    responsive: true,
    ajax: {
        "url": "ajax/area.ajax.php",
        "type": "POST",
        "dataSrc":""

    },
    language: {
        "decimal":        "",
        "emptyTable":     "No hay información",
        "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
        "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
        "infoFiltered":   "(Filtrado de _MAX_ registros totales)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Mostrando _MENU_ registros",
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
            "targets": 3,
            "soportable": false,
            "render": function (data, type, full, meta){
                return "<center>"+
                            "<button type='button' class='btn btn-primary btn-sm btnEditarArea mt-2' data-bs-toggle='modal' data-bs-target='#modal-gestionar-areas'> " +
                                "<i class='fas fa-pencil-alt'></i> " +
                            " </button> " +
                            "<button type='button' class='btn btn-danger btn-sm btnEliminarArea mt-2'> " +
                                "<i class='fas fa-trash'> </i> "+
                            " </button> "+
                            "<button type='button' class='btn btn-success btn-sm btnVerArea mt-2' data-bs-toggle='modal' data-bs-target='#modal-gestionar-areas'> " +
                                "<i class='fas fa-eye'> </i> "+
                            " </button>"+
                        "</center>";
            }
        }
    ],
    column:[
        {"data": "id_areas"},
        {"data": "nombre_area"},
        {"data": "ubicacion_areas"},
        {"data": "acciones"}
    ],
    dom: "<'row mb-2'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
});

//Agregar Area
$("#btnAgregarArea").on("click", function (){
    $("#ttlModalAreas").text("Agregar Area");
    setDefaultAreas();
    edicion = false;
});

$("#tblAreas tbody").on("click", ".btnEditarArea", function (){
    setDefaultAreas();
    var data;
    var dataResp = tablaAreas.row(this).data();
    var dataRows = tablaAreas.row($(this).parents('tr')).data();

    if(dataResp){
        data = dataResp;
    }else if(dataRows){
        data = dataRows;
    } 
    console.log(data);

    $("#ttlModalAreas").text("Editar Area");
    $("#txtIdArea").val(data["idareas_table"]);
    $("#txtNombreArea").val(data["nombre_area"]);
    $("#sltUbicacion").val(data["ubicacion"]);
})

$("#tblAreas tbody").on("click", ".btnEliminarArea", function (){
    setDefaultAreas();
    var data;
    var dataResp = tablaAreas.row(this).data();
    var dataRows = tablaAreas.row($(this).parents('tr')).data();
    accion = "eliminar";

    if(dataResp){
        data = dataResp;
    }else if(dataRows){
        data = dataRows;
    } 

    idArea = data.idareas_table;

    var datos = new FormData();
    datos.append("idArea", idArea);
    datos.append("accion", accion);

    console.log(accion, idArea);
    swal.fire({
        title: "¡CONFIRMAR!",
        text: "¿Está seguro que desea eliminar el area?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar"
    }).then(resultado =>{ //FUNCION A EJECUTAR DESPUES

        if(resultado.value){ //SI LA CONFIRMACION FUE POSITIVA EJECUTA
            //LLAMADO A AJAX
            $.ajax({
                url:"ajax/area.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success : function(respuesta){
                    tablaAreas.ajax.reload(null, false);
                    console.log(respuesta);
                    if(respuesta == 1){
                        Toast.fire({
                            icon: "success",
                            title: "El area se eliminó exitosamente"
                        });
                    }else{
                        Toast.fire({
                            icon: "error",
                            title: "Error, no se pudo eliminar el area"
                        });
                    }
                    
                }
            });
        }
    })
})

$("#tblAreas tbody").on("click", ".btnVerArea", function (){
    setDefaultAreas();
    var data;
    var dataResp = tablaAreas.row(this).data();
    var dataRows = tablaAreas.row($(this).parents('tr')).data();
    
    if(dataResp){
        data = dataResp;
    }else if(dataRows){
        data = dataRows;
    }

    $("#ttlModalAreas").text("Ver Area");
    $("#txtIdArea").val(data["idareas_table"]);
    $("#txtNombreArea").prop("disabled", true);
    $("#txtNombreArea").val(data["nombre_area"]);
    $("#sltUbicacion").prop("disabled", true);
    $("#sltUbicacion").val(data["ubicacion"]);
    $("#btnGuardarArea").prop("disabled", true);

})

$("#btnGuardarArea").on("click", function(){
    if($("#txtIdArea").val() == ''){
        accion = "agregar";
    }else{
        accion = "editar";
    }

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
                    let idArea = $("#txtIdArea").val();
                    let nombreArea = $("#txtNombreArea").val();
                    let ubicacion = $("#sltUbicacion").val();

                    var datos = new FormData();
                    datos.append("accion", accion);
                    datos.append("idArea", idArea);
                    datos.append("nombreArea", nombreArea);
                    datos.append("ubicacion", ubicacion);
                    
                    if(resultado.value){ //SI LA CONFIRMACION FUE POSITIVA EJECUTA
                        //LLAMADA A AJAX
                        $.ajax({
                            url:"ajax/area.ajax.php",
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success : function(respuesta){
                                console.log(respuesta);
                                console.log(accion);
                                console.log($("#txtIdArea").val());
                                $("#modal-gestionar-areas").modal("hide");
                                tablaAreas.ajax.reload(null, false);
                                if(respuesta == 1){
                                    if(accion == "agregar"){
                                        Toast.fire({
                                            icon: "success",
                                            title: "El area se agregó exitosamente"
                                        });
                                    }else{
                                        Toast.fire({
                                            icon: "success",
                                            title: "El area se actualizó exitosamente"
                                        });
                                    }
                                }else{
                                    if(accion == "agregar"){
                                        Toast.fire({
                                            icon: "error",
                                            title: "Error, no se pudo agregar el area"
                                        });
                                    }else{
                                        Toast.fire({
                                            icon: "error",
                                            title: "Error, no se pudo actualizar el area"
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
})


function setDefaultAreas(){
    $("#txtIdArea").val("");
    $("#txtNombreArea").val("");
    $("#txtNombreArea").prop("disabled", false);
    $("#sltUbicacion").val([0]);
    $("#sltUbicacion").prop("disabled", false);
    $("#btnGuardarArea").prop("disabled", false);
    $("#formAreas").removeClass("was-validated");
}