<?php
//este codigo verifica que si es secretaria le mande al inicio , restringue que la secretaria cree un plan tratamiento//
if($_SESSION["perfil"] == "Secretaria"){

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
            <h1>Administrar Plan Tratamiento </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar Plan Tratamiento</li>
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
        <a href="crear-plan-tratamiento">

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPaciente">
          Agregar Plan Tratamiento
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
           <th>Paciente</th>
           <th>Descuento</th>
           <th>SubTotal</th>
           <th>Total</th>

         </tr> 

        </thead>

        <tbody>

        <?php

                $item = null;
                $valor = null;

                    $respuesta = ControladorPlanTratamiento::ctrMostrarPlanTratamiento($item, $valor);

                    foreach ($respuesta as $key => $value) {

                        echo '<tr>

                        <td>' . ($key + 1) . '</td>';

                        $itemUsuario = "id";
                        $valorUsuario = $value["id_paciente"];

                        $respuestaPaciente = ControladorPacientes::ctrMostrarPacientes($itemUsuario, $valorUsuario);

                        echo '<td>' . $respuestaPaciente["nombre"] . ' '.$respuestaPaciente["apellidoP"].' '.$respuestaPaciente["apellidoM"]. '</td>

                         <td>' . $value["descuento"] . '</td>
                          <td>' . $value["subtotal"] . '</td>
                           <td>' . $value["total"] . '</td>
                            
                            

                    </tr>';
                    }
                    ?>


        </tbody>

       </table>
        </div>
        <!-- /.card-body -->

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



