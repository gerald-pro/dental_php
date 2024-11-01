<?php
//este codigo verifica que si es secretaria le mande al inicio , restringue que la secretaria cree un plan tratamiento//
if($_SESSION["perfil"] == "Secretaria"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}
?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Pagos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Pagos</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
        
        <div class="card-header">

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPagos">
                  Agregar Pagos
          </button>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>

        <div class="card-body">
      
        <table class="table table-bordered table-hover table-striped dt-responsive tablas" width="100%" >
         
        <thead>
         
         <tr>
           

                <th style="width:10px">#</th>
                <th>Plan Tratamiento</th>
                <th>Razon Social</th>
                <th>Secretaria</th>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

                $item = null;
                $valor = null;

                    $respuesta = ControladorPagos::ctrMostrarPagos($item, $valor);

                    foreach ($respuesta as $key => $value) {

                        echo '<tr>

                        <td>' . ($key + 1) . '</td>

                        <td style="text-align:center">'.$value["numeroPago"].'</td>';

                        $itemUsuario = "id";
                        $valorUsuario = $value["idcajera"];

                        $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                        echo '<td>' . $respuestaUsuario["nombre"] . '</td>';

                        $itemUsuario = "id";
                        $valorUsuario = $value["idtrabajador"];

                        $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                        echo '<td>' . $respuestaUsuario["nombre"] . '</td>';

                        $itemCliente = "idcliente";
                        $valorCliente = $value["idcliente"];

                        $respuestaCliente = ControladorPacientes::ctrMostrarPacientes($itemCliente, $valorCliente);
                        echo '<td>' .$respuestaCliente["nombres"].' '.$respuestaCliente["apellidos"]. '</td>

                        <td>' . $value["fecha"] . '</td>

                        <td style="text-align:center">Bs '.number_format($value["total"],2). '</td>

                        <td>' . $value["metodo_pago"] . '</td>

                        <td>

                            <div class="btn-group">
                                <button class="btn btn-info btnImprimirPago" boletaPago="'.$value["numeroPago"].'"><i class="fa fa-print"></i></button>
                                <button class="btn btn-info btnDescargarPago" boletaPago="'.$value["numeroPago"].'" style="width:90%; margin-left:1%"><i class="fa fa-download"></i></button>
                                <button class="btn btn-danger btnPago" idPago="'.$value["idpagoservicio"].'" style="width:90%; margin-left:1%"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>

                    </tr>';
                    }
                    ?>

        </tbody>
    </table>

    <?php

    $eliminarPago = new ControladorPagos();
    $eliminarPago -> ctrEliminarPago();

    ?>




    </div>

  </div>

</div>

