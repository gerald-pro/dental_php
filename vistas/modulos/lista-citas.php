<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar Citas </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar Citas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        
        <div class="card-header">
        <a href="citas">

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPaciente">
          Agregar Cita
          </button>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
            </a>
          </div>
        </div>

        <div class="card-body">
      
        <table class="table table-bordered table-hover table-striped example2 tablas">
         
        <thead>
         
         <tr>
           

           <th style="width:10px">#</th>
           <th>Medico</th>
           <th>Secretaria</th>
           <th>Paciente</th>
           <th>Fecha Inicio</th>
           <th>Fecha Fin</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

$item = null;
$valor = null;

    $respuesta = ControladorCitas::ctrMostrarCita($item, $valor);

foreach ($respuesta as $key => $value) {

echo '<tr>

  <td>'.($key+1).'</td>';

  $itemUsuario = "id";
  $valorUsuario = $value["id_medico"];

  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

  echo '<td>'.$respuestaUsuario["nombre"].'</td>';

  $itemUsuario = "id";
  $valorUsuario = $value["id_secretaria"];

  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);
  echo '<td>' . $respuestaUsuario["nombre"] .'</td>';

  $itemPaciente = "id";
  $valorPaciente = $value["id_paciente"];

  $respuestaPaciente = ControladorPacientes::ctrMostrarPacientes($itemPaciente, $valorPaciente);

 echo '<td>' .$respuestaPaciente["nombre"].' '.$respuestaPaciente["apellidoP"].' '.$respuestaPaciente["apellidoM"]. '</td>

  <td>' . $value["inicio"] . '</td>

  <td>' . $value["fin"] . '</td>


   <td>

             <div class="btn-group">
        
                <button class="btn btn-warning btnEditarLis" idCita="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarServicio"><i class="fa fa-inverse fa-pencil-alt"></i></button>

                <button class="btn btn-danger btnEliminarLis" idCita="'.$value["id"].'"><i class="fa fa-trash-alt"></i></button>

            </div>  
        </td>

</tr>';
}

?>


        </tbody>

       </table>
       <?php

      $eliminarVenta = new ControladorPagos();
      $eliminarVenta -> ctrEliminarPago();

      ?>
        </div>
        <!-- /.card-body -->

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



