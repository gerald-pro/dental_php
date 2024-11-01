<?php

session_start();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Consultorio Dental</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="vistas/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="vistas/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="vistas/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="vistas/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="vistas/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="vistas/plugins/summernote/summernote-bs4.min.css">
<!-- mari cambios -->
<link rel="stylesheet" href="vistas/dist/css/formulario.css">

  <!-- DataTables -->
  
  <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<!-- fullCalendar -->
  <link rel="stylesheet" href="vistas/plugins/fullcalendar/main.css">



<!-- jQuery -->
<script src="vistas/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="vistas/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->



<!-- Bootstrap 4 -->
<script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="vistas/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="vistas/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="vistas/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="vistas/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="vistas/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="vistas/plugins/moment/moment.min.js"></script>
<script src="vistas/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="vistas/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="vistas/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="vistas/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->

 <!-- Select2 -->
 <link rel="stylesheet" href="vistas/bower_components/select2/dist/css/select2.min.css">
 <!-- Select2 -->
 <script src="vistas/bower_components/select2/dist/js/select2.full.min.js"></script>


<!-- DataTables  & Plugins -->
<script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="vistas/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="vistas/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="vistas/plugins/jszip/jszip.min.js"></script>
<script src="vistas/plugins/pdfmake/pdfmake.min.js"></script>
<script src="vistas/plugins/pdfmake/vfs_fonts.js"></script>
<script src="vistas/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="vistas/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="vistas/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script src="vistas/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->


<script src="vistas/dist/js/pages/dashboard.js"></script>

  <!-- SweetAlert 2 -->
<script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
  
<!-- fullCalendar -->
<script src="vistas/plugins/moment/moment.min.js"></script>
<script src="vistas/plugins/moment/locales/locales.js"></script>
<script src="vistas/plugins/fullcalendar/main.js"></script>
<script src="vistas/plugins/fullcalendar/locales/es.js"></script>
<script src="vistas/plugins/fullcalendar/locales-all.min.js"></script>

</head>

<?php 

  if(isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion']=="ok"){
   

    echo '<body class="hold-transition sidebar-mini">';
   
    echo '<div class="wrapper">';
   
    include "modulos/cabezote.php";
    include "modulos/menu.php";
     

    if(isset($_GET["ruta"])){

      if($_GET["ruta"] == "inicio" ||
         $_GET["ruta"] == "usuarios" ||
         $_GET["ruta"] == "servicios" ||
         $_GET["ruta"] == "categorias" ||
         $_GET["ruta"] == "razonsocial"||
         $_GET["ruta"] == "horarios" ||
         $_GET["ruta"] == "pacientes" ||
         $_GET["ruta"] == "citas" ||
         $_GET["ruta"] == "crear-cita" ||
         $_GET["ruta"] == "lista-citas" ||
         $_GET["ruta"] == "pagos" ||
         $_GET["ruta"] == "crear-pagos" ||
         $_GET["ruta"] == "plantratamiento" ||
         $_GET["ruta"] == "crear-plan-tratamiento" ||
         $_GET["ruta"] == "reportes" ||
         $_GET["ruta"] == "salir"){

        include "modulos/".$_GET["ruta"].".php";

      }else{

        include "modulos/404.php";

      }

    }else{

      include "modulos/inicio.php";

    }


  include "modulos/footer.php";

    echo '</div>';
  
    echo '</body>';
    

  }else{

    echo '<body class="hold-transition login-page">';

    include "modulos/login.php";

    echo '</body>';  
} 

?>  

<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/usuarios.js"></script>
<script src="vistas/js/pacientes.js"></script>
<script src="vistas/js/categorias.js"></script>
<script src="vistas/js/servicios.js"></script>
<script src="vistas/js/razonsocial.js"></script>
<script src="vistas/js/horarios.js"></script>
<script src="vistas/js/citas.js"></script>
<script src="vistas/js/plantratamiento.js"></script>
<script src="vistas/js/pagos.js"></script>

</html>
