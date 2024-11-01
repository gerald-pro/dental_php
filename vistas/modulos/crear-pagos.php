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
        <ol class="breadcrumb mb-4">
            <!-- Aquí se agrega la clase mb-4 -->
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crear Pagos</li>
        </ol>

        <h1 class="mt-3">Crear Pagos</h1> <!-- Aquí puedes agregar margen superior si es necesario -->


    </section>

    <section class="content">
        <!-- Fondo celeste claro -->
        <div class="row">

      <!--=====================================
                EL FORMULARIO
            ======================================-->
            <div class="col-lg-5 col-xs-12">
                <div class="box box-success" style="background-color: rgba(255, 255, 255, 0.8);">
                    <!-- Borde negro y fondo transparente -->
                    <!-- Aplicar estilos aquí -->
                    <div class="box-header with-border"></div>

                    <form role="form" method="post" class="formularioPagos">
                        <div class="box-body">
                            <div class="box">
                            <!--=====================================
                                ENTRADA CAJERA
                                ======================================-->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="margin-right: 16px;"><i
                                                class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" id="nuevoCajera"
                                            value="<?php echo $_SESSION['nombre']; ?>" readonly>
                                        <input type="hidden" name="idCajera" value="<?php echo $_SESSION['id']; ?>">
                                    </div>
                                </div>

                            <!--=====================================
                                ENTRADA DEL NUMERO PAGO
                                ======================================-->

                            <div class="form-group">

                                <div class="input-group">

                                    <span class="input-group-addon" style="margin-right: 16px;"><i class="fa fa-key"></i></span>

                                    <?php

                                        $item = null;
                                        $valor = null;

                                        $pagos = ControladorPagos::ctrMostrarPagos($item, $valor);

                                        if(!$pagos){

                                        echo '<input type="text" class="form-control" id="idRazonSocial" name="idRazonSocial" value="1" readonly>';

                                        }else{

                                        foreach ($pagos as $key => $value) {

                                        }

                                        $numeroPago = $value["id"];

                                        echo '<input type="text" class="form-control" id="idRazonSocial" name="idRazonSocial" value="'.$numeroPago.'" readonly>';

                                        }
                                        ?>
                                </div>

                            </div>
                            <!--=====================================
                                    ENTRADA Trabajador
                                    ======================================-->
                            <div class="form-group">
                                <div class="input-group">

                                    <span class="input-group-addon" style="margin-right: 16px;"><i class="fa fa-users"></i></span>
                                    
                                    <select class="form-control" id="seleccionarCliente"
                                                name="seleccionarCliente" required>
                                                <option selected="selected">Seleccionar Paciente</option>
                                                <?php
                                                $item = null;
                                                $valor = null;
                                                $clientes = ControladorPacientes::ctrMostrarPacientes($item, $valor);
                                                foreach ($clientes as $key => $value) {
                                                    echo '<option value="' . $value['id'] . '">' . $value['nombre'] . ' ' . $value['apellidoP'] . ' ' . $value['apellidoM'] . '</option>';
                                                }
                                            ?>
                                            </select>
                                        
                                </div>
                            </div>
                            <!--=====================================
                            ENTRADA PARA AGREGAR TRATAMIENTO
                            ======================================-->
                            <div class="form-group row nuevoTratamiento">

                            </div>

                            <input type="hidden" id="listaTratamiento" name="listaTratamiento" required>

                            <div class="row">
                                <div class="col-md-6 offset-md-6">
                                    <div class="x_content">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>TOTAL A PAGAR:</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="input-group">

                                                            <span class="input-group-addon"><b>Bs.</b></span>
                                                            <input type="text" class="form-control input-lg"
                                                                id="nuevoTotalPago" name="nuevoTotalPago" total=""
                                                                placeholder="00000" readonly required>
                                                            <input type="hidden" name="totalPago" id="totalPago">

                                                        </div>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <hr>

                            <div class="form-group row">

                                <div class="col-xs-6" style="padding-right:0px">

                                    <div class="input-group">

                                        <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago"
                                            required>
                                            <option value="">Seleccione método de pago</option>
                                            <option value="Efectivo">Efectivo</option>
                                            <option value="TC">Tarjeta Crédito</option>
                                            <option value="TD">Tarjeta Débito</option>
                                        </select>

                                    </div>

                                </div>

                                <div class="cajasMetodoPago"></div>

                                <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                            </div>

                            </br>

                        </div>
                        <div class="box-footer">
                           <div class="pull-right">
               
                             <button type="submit" class="btn btn-primary pull-right">Guardar Pago </button>
                           </div>

                        </div>

                    </form>

                        <?php

                        $guardarPago = new ControladorPagos();
                        $guardarPago -> ctrCrearPago();

                        ?>
                </div>

            </div>
        </div>
        <!--=====================================
            TABLA DE PLAN TRATAMIENTO 
            ======================================-->
            <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
                <div class="box box-warning" style="background-color: rgba(255, 255, 255, 0.8);">
                    <!-- Borde negro y fondo transparente -->
                    <div class="box-header with-border"></div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped dt-responsive tablaPago">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Tratamiento</th>
                                    <th>Precio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
    
</div>
</section>
    <!-- /.content -->
</div>
<!--=====================================
MODAL AGREGAR Cliente
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

<div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post" enctype="multipart/form-data">

            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->

            <div class="modal-header  bg-info">

                <h5 class="text-white">Agregar Cliente</h5>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>

            <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

            <div class="modal-body">
                <div class="container-fluid">

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" min="0" class="form-control input-lg" name="carnetP"
                                placeholder="Ingresar cedula identidad">

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control input-lg" name="nombreP"
                                placeholder="Ingresar nombres" required>

                        </div>
                    </div>


                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control input-lg" name="apellidoP"
                                placeholder="Ingresar apellidos" required>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="number" class="form-control input-lg" name="telefonoP" min="0"
                                placeholder="Ingresar telefono">

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                            <input type="text" class="form-control input-lg" name="domicilioP"
                                placeholder="Ingresar domicilio">

                        </div>

                    </div>
                    <div class="form-group row">

                        <div class="col-xs-12 col-sm-6">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-genderless"></i></span>

                                <select class="form-control input-lg" name="sexoP">

                                    <option value="">Selecionar sexo</option>

                                    <option value="masculino">Masculino</option>

                                    <option value="femenino">Feminino</option>

                                    <option value="otros">otros</option>

                                </select>

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-6">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <input type="date" class="form-control input-lg" name="fechaNacimientoP"
                                    placeholder="Fecha Nacimiento" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask
                                    required>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!--=====================================
            PIE DEL MODAL
            ======================================-->

            <div class="modal-footer">

                <button type="button" class="btn btn-outline-info" data-dismiss="modal"
                    style="width:100PX">Salir</button>
                <button type="submit" class="btn btn-outline-info"><span class="fa fa-save"></span>Guardar</button>

            </div>

      </form>

      <?php

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();

      ?>

    </div>

  </div>

</div>
