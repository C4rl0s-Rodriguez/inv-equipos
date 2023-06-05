<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVENTARIO EQUIPOS</title>
    <!--##########-CSS-##########-->
    <!-- CSS Booostrap 5.0.2-->
    <link rel="stylesheet" href="vistas/assets/dist/css/bootstrap.min.css">
    <!-- CSS Custom -->
    <link rel="stylesheet" href="vistas/assets/dist/css/style.css">
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <!-- CSS DataTables Responsive Extension -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <!-- Estilo para login -->
    <link rel="stylesheet" href="vistas/assets/dist/css/style-login.css">

    <!--##########-Scripts-##########-->
    <!-- JS Booostrap 5.0.2-->
    <script src="vistas/assets/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JS JQuery-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- JS DataTables-->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <!-- JS DataTables for Bootstrap-->
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <!-- JS DataTables Responsive Extension -->
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <!-- JS Font Awesome -->
    <script src="https://kit.fontawesome.com/4a8e50e365.js" crossorigin="anonymous"></script>
    <!-- JS SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- JQueryValidation -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <!-- AutoTable JSpdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.2.3/jspdf.plugin.autotable.min.js"></script>
</head>

<body>
    <?php
    if(isset($_SESSION["estado"]) && $_SESSION["estado"]=="1"){
        
        /* HEADER*/
        include "modulos/layout/header.php";

        //Contenedor de elementos principales
        echo "<div class='container-fluid'>";
            
            //Barra Lateral
            include "modulos/layout/sidebar.php";

            //Contenedor principal
            echo "<div id='main-cont-reg' class='main-container'>";
                echo "<div class='wrapper'>";
                    //Modulo
                    include "modulos/equipos.php";
                echo "</div>";
            echo "</div>";

        echo "</div>";

    }else{
    
        include "modulos/login.php";
    }
    
    

    ?>
    <!--##########-Scripts-##########-->
    <script src="vistas/assets/dist/js/main-script.js"></script>
<script>
      function cargarContenido(contenedor,contenido){
        $("."+contenedor).load(contenido);
      }
  </script>
    
    
    
</body>
</html>