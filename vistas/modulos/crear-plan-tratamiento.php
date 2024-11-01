<?php
    //este codigo verifica que si es secretaria le mande al inicio , restringue que la secretaria cree un plan tratamiento//
    if ($_SESSION["perfil"] == "Secretaria") {

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
            <li class="breadcrumb-item active" aria-current="page">Crear Plan Tratamiento</li>
        </ol>

        <h1 class="mt-3">Crear Plan Tratamiento</h1> <!-- Aquí puedes agregar margen superior si es necesario -->
    </section>

    <section class="content">
        <!-- Fondo celeste claro -->
        <div class="row">

            <!-- EL FORMULARIO -->
            <div class="col-lg-5 col-xs-12">
                <div class="box box-success" style="background-color: rgba(255, 255, 255, 0.8);">
                    <!-- Borde negro y fondo transparente -->
                    <!-- Aplicar estilos aquí -->
                    <div class="box-header with-border"></div>

                    <form role="form" method="post" class="formularioPlantratamiento">
                        <div class="box-body">
                            <div class="box">

                                <!-- ENTRADA DEL VENDEDOR -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="margin-right: 16px;"><i
                                                class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" id="nuevoCajera"
                                            value="<?php echo $_SESSION['nombre']; ?>" readonly>
                                        <input type="hidden" name="idCajera" value="<?php echo $_SESSION['id']; ?>">
                                    </div>
                                </div>

                                <!-- ENTRADA DEL PACIENTE -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="margin-right: 0.5px;"><i
                                                class="fa fa-users"></i></span>
                                        <div class="col-lg-6 col-md-8 col-sm-10">
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

                                        <!-- Botón "Agregar Paciente" centrado -->
                                        <span class="input-group-addon" style="display: flex; align-items: center;">
                                            <button type="button" class="btn btn-default btn-xs mx-auto"
                                                data-toggle="modal" data-target="#modalAgregarPaciente"
                                                data-dismiss="modal" style="display: block; margin-left: 6px;">Agregar
                                                Paciente</button>
                                        </span>
                                    </div>
                                </div>

                                <!-- ENTRADA PARA AGREGAR PRODUCTO -->
                                <div class="form-group row nuevoServicio"></div>
                                <input type="hidden" id="listaServicios" name="listaServicios">

                                <hr>

                                <div class="row">
                                    <!-- ENTRADA IMPUESTOS Y TOTAL -->
                                    <div class="col-xs-8 pull-right">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Descuento</th>
                                                    <th>SubTotal</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="width: 30%">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control input-lg" min="0"
                                                                id="nuevoDescuento" name="nuevoDescuento"
                                                                placeholder="0" required>
                                                            <input type="hidden" name="nuevoPrecioDescuento"
                                                                id="nuevoPrecioDescuento" required>
                                                            <input type="hidden" name="nuevoPrecioNeto"
                                                                id="nuevoPrecioNeto" required>
                                                            <span class="input-group-addon padding-right-icon"><i
                                                                    class="fa fa-percent"></i></span>
                                                        </div>
                                                    </td>
                                                    <td style="width: 30%">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><b>Bs.</b></span>
                                                            <input type="text" class="form-control input-lg"
                                                                id="nuevosubTotalPlantratamiento"
                                                                name="nuevosubTotalPlantratamiento" subtotal=""
                                                                placeholder="00000" readonly required>
                                                            <input type="hidden" name="subtotalPlantratamiento"
                                                                id="subtotalPlantratamiento">
                                                        </div>
                                                    </td>
                                                    <td style="width: 30%">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><b>Bs.</b></span>
                                                            <input type="text" class="form-control input-lg"
                                                                id="nuevoTotalPlantratamiento"
                                                                name="nuevoTotalPlantratamiento" total=""
                                                                placeholder="00000" readonly required>
                                                            <input type="hidden" name="totalPlantratamiento"
                                                                id="totalPlantratamiento">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <br>
                            </div>
                        </div>

                        <style>
                            .padding-boton {
                                padding: 20px 0;
                                /* Ajusta el valor según lo necesites */
                            }
                        </style>

                        <div class="box-footer">
                            <div class="text-center padding-boton">
                                <!-- Clase para centrar el botón y aplicar padding -->
                                <button type="submit" class="btn btn-primary">Guardar Tratamiento</button>
                            </div>
                        </div>
                    </form>

                    <?php
                    $guardarVenta = new ControladorPlanTratamiento();
                    $guardarVenta->ctrCrearPlanTratamiento();
                    ?>
                </div>
            </div>

            <!-- LA TABLA DE PRODUCTOS -->
            <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
                <div class="box box-warning" style="background-color: rgba(255, 255, 255, 0.8);">
                    <!-- Borde negro y fondo transparente -->
                    <div class="box-header with-border"></div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped dt-responsive tablaPlantratamiento">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Nombre</th>
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
</div>


<!--=====================================
MODAL AGREGAR PACIENTE
======================================-->

<div id="modalAgregarPaciente" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar paciente</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <!-- ENTRADA PARA EL NOMBRE -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="nuevoNombre"
                                        placeholder="Ingresar nombre" required>
                                </div>
                            </div>
                            <!-- ENTRADA PARA EL APELLIDO PATERNO-->

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="nuevoApellidoP"
                                        placeholder="Ingresar Apellido Paterno" id="nuevoApellidoP" required>
                                </div>
                            </div>

                            <!-- ENTRADA PARA EL APELLIDO MATERNO-->

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="nuevoApellidoM"
                                        placeholder="Ingresar Apellido Materno" id="nuevoApellidoM" required>
                                </div>
                            </div>

                            <!-- ENTRADA PARA LA DOCUMENTACION-->

                            <div class="form-group">

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-solid fa-id-card"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="nuevoDocumentacion"
                                        placeholder="Ingresar Documentación/CI" id="nuevoDocumentacion" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- ENTRADA PARA EL SEXO-->

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-solid fa-venus-mars"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="nuevoSexo"
                                        placeholder="Ingresar Sexo" id="nuevoSexo" required>

                                </div>
                            </div>

                            <!-- ENTRADA PARA EL TELEFONO-->

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="nuevoTelefono"
                                        placeholder="Ingresar el teléfono" id="nuevoTelefono" required>
                                </div>
                            </div>

                            <!-- ENTRADA PARA EL EMAIL-->

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-solid fa-at"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="nuevoEmail"
                                        placeholder="Ingresar el Email" id="nuevoEmail" required>
                                </div>
                            </div>

                            <!-- ENTRADA PARA LA FECHA DE NACIMIENTO-->

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-solid fa-calendar"></i></span>
                                    </div>
                                    <input type="date" class="form-control input-lg" name="nuevoFechaNacimiento"
                                        placeholder="Ingresar la fecha nacimiento" id="nuevoFechaNacimiento" required>
                                </div>
                            </div>

                            <!-- ENTRADA PARA LA DIRECCION-->

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="nav-icon fas fa-columns"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="nuevoDireccion"
                                        placeholder="Ingresar Dirección" id="nuevoDireccion" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar Paciente</button>
                </div>

                <?php
                    $crearPaciente = new ControladorPacientes();
                    $crearPaciente->ctrCrearPacientes();
                ?>
            </form>
        </div>
    </div>
</div>