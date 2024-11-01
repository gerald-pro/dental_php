<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestionar Citas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

        <?php
            $item = null;
            $valor = null;

            $usuarios = ControladorUsuarios::ctrMostrarUsuariosMedico($item, $valor);
            
            foreach ($usuarios as $key => $value) {
                // Verificar si el usuario tiene perfil "medico"
                if ($value["perfil"] === "Medico") {
                    echo '<div class="col-lg-4 col-6">';
                    echo '<div class="small-box bg-info">';
                    echo '<div class="inner">';
                    echo '<h3>' . $value["nombre"] . '</h3>';
                    echo '</div>';
                    echo '<div class="icon">';
                    echo '<i class="ion ion-person-add"></i>';
                    echo '</div>';
                    echo '<a href="index.php?ruta=crear-cita&idMedico='.$value["id"].'" class="small-box-footer">Ver Citas <i class="fas fa-arrow-circle-right"></i></a>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        ?>

        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php

$borrarCita = new ControladorCitas();
$borrarCita -> ctrEliminarCita();

?>
