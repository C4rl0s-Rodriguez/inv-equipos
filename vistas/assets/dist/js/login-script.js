$("#btn-log-in").on("click",function(){
    if($("#txtUser").val() == "" && $("#txtPass").val() == ""){
        Toast.fire({
            icon: "warning",
            title: "Faltan campos por llenar"
        });
    }else{
        var datos = new FormData();
        let nombreUsuario = $("#txtUser").val();
        let password = $("#txtPass").val();

        datos.append("accion", "iniciarSesion");
        datos.append("userName",nombreUsuario);
        datos.append("pass", password);
        $.ajax({
            url:"ajax/login.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success : function(respuesta){
                if(respuesta == "wrong"){
                    Toast.fire({
                        icon: "warning",
                        title: "Usuario y/o Contraseña Incorrectos"
                    });
                    $("#txtUser").val("");
                    $("#txtPass").val("");
                }else if(respuesta == "invalid"){
                    Toast.fire({
                        icon: "warning",
                        title: "Usuario y/o Contraseña Invalidos"
                    });
                    $("#txtUser").val("");
                    $("#txtPass").val("");
                }else if(respuesta == 1){
                    location.reload();
                }
                
            }
        });
    }

    
})

