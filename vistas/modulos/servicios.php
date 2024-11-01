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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar servicios </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar servicios</li>
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

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarServicio">
                  Agregar Servicios
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
      
        <table class="table table-bordered table-hover table-striped dt-responsive tablaServicio" width="100%" >
         
        <thead>
         
         <tr>
           

           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Precio</th>
           <th>Acciones</th>

         </tr> 

        </thead>

       </table>


        </div>
        <!-- /.card-body -->

      </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--=====================================
MODAL AGREGAR SERVICIO
======================================-->

   <div id="modalAgregarServicio" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" >
          <h5 class="modal-title">Agregar servicio</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
            
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->



        <div class="modal-body">
          

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
                <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user"></i></span> 
                </div>
                  <input type="text" class="form-control input-lg" name="nuevoNombreServicio" placeholder="Ingresar nombre servicio" 
                  onkeypress="return soloLetras(event)" required>
                </div>

            </div>

            <!-- ENTRADA PARA EL PRECIO-->

             <div class="form-group">
              
                <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-key"></i></span> 
                </div>
                  <input type="text" class="form-control input-lg" name="nuevoPrecio" placeholder="Ingresar Precio" id="nuevoPrecio" 
                  maxlength="8" onkeypress="return soloNumeros(event)" oninput="validarLongitud()" required>

                </div>

              </div>

     </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->


        <div class="modal-footer justify-content-end">

          <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar servicio</button>
        </div>
        <?php

          $crearServicio = new ControladorServicios();
          $crearServicio -> ctrCrearServicio();

        ?>

      </form>
      </div>

    </div>

</div>     

<!--=====================================
MODAL EDITAR SERVICIO
======================================-->

   <div id="modalEditarServicio" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" >
          <h5 class="modal-title">Editar servicio</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
            
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->


        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE SERVICIO -->
  
              <div class="form-group">
    
               <div class="input-group">
                 <div class="input-group-prepend">
                 <span class="input-group-text"><i class="fa fa-user"></i></span> 
                </div>
               <input type="text" class="form-control input-lg" id="editarNombreServicio" name="editarNombreServicio" value="" required>
   
              </div>

          </div>

          <input type="hidden" id="IdServicio" name="IdServicio">
         <!-- ENTRADA PARA EL PRECIO-->

          <div class="form-group">
    
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-key"></i></span> 
               </div>
              <input type="text" class="form-control input-lg" name="editarPrecio" placeholder="Ingresar Precio" id="editarPrecio" required>

            </div>

          </div>


          </div>

        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->


        <div class="modal-footer">

          <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar Servicio</button>
        </div>
        <?php

          $editarServicio = new ControladorServicios();
          $editarServicio -> ctrEditarServicio();

        ?>

      </form>


    </div>

  </div>

</div>

<?php

  $borrarServicio = new ControladorServicios();
  $borrarServicio -> ctrBorrarServicio();

?>