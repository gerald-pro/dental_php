<style>
   .x_panel {
     
       background-color: #e0f7fa; /* Celeste claro */
       border-radius: 5px; /* Bordes redondeados */
       padding: 15px; /* Espacio interno */
   }

   .x_title {
       display: block; /* Usar flexbox para alinear elementos */
       justify-content: space-between; /* Espacio entre los elementos */
       padding-left: 71%;
       
      /*  align-items: center; /* Alinear verticalmente */ */
   }

   .btn-reporte {
       position: relative; /* Para permitir el posicionamiento absoluto del borde */
   }

</style>

<div class="content-wrapper">

   <section class="content-header">
      <h3>Reportes</h3>
   </section>

   <section class="content">
      <div class="row">
         <!-- Primera columna - Reporte de Citas -->
         <div class="col-md-6 col-sm-12">
            <div class="x_panel">
            <h3>Citas</h3>
               <div class="x_title">
                  <button type="button" class="btn btn-info pull-right btnReporteCita btn-reporte no-line ">
                     <i class="fa fa-print"></i> Generar reporte
                  </button>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <form role="form" method="post" class="formularioFichaEntreFecha">
                     <div class="form-group">
                        <label>SELECCIONA PERIODO</label>
                        <select class="form-control select2" name="periodo" required>
                           <option value="dia">DÍA</option>
                           <option value="semana">SEMANA</option>
                           <option value="mes">MES</option>
                           <option value="año">AÑO</option>
                        </select>
                        
                     </div>

                     <div class="row">
                        <div class="col-md-6 form-group">
                           <label>FECHA (Día)</label>
                           <input type="date" class="form-control" name="fechaDia" id="fechaDia">
                        </div>
                        <div class="col-md-6 form-group">
                           <label>SEMANA</label>
                           <input type="week" class="form-control" name="fechaSemana" id="fechaSemana">
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-6 form-group">
                           <label>MES</label>
                           <input type="month" class="form-control" name="fechaMes" id="fechaMes">
                        </div>
                        <div class="col-md-6 form-group">
                           <label>AÑO</label>
                           <input type="number" class="form-control" name="fechaAnio" id="fechaAnio" min="2000" max="2100">
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>

         <!-- Segunda columna - Otro Reporte -->
         <div class="col-md-6 col-sm-12">
            <div class="x_panel">
            <h3>Pagos</h3>
               <div class="x_title">
                  
                  <button type="button" class="btn btn-info pull-right btnReporteOtro btn-reporte no-line">
                     <i class="fa fa-print"></i> Generar reporte
                  </button>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <form role="form" method="post" class="formularioOtroReporte">
                     <div class="form-group">
                        <label>SELECCIONA PERIODO</label>
                        <select class="form-control" name="periodoOtro" required>
                           <option value="dia">DÍA</option>
                           <option value="semana">SEMANA</option>
                           <option value="mes">MES</option>
                           <option value="año">AÑO</option>
                        </select>
                     </div>

                     <div class="row">
                        <div class="col-md-6 form-group">
                           <label>FECHA (Día)</label>
                           <input type="date" class="form-control" name="fechaDiaOtro" id="fechaDiaOtro">
                        </div>
                        <div class="col-md-6 form-group">
                           <label>SEMANA</label>
                           <input type="week" class="form-control" name="fechaSemanaOtro" id="fechaSemanaOtro">
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-6 form-group">
                           <label>MES</label>
                           <input type="month" class="form-control" name="fechaMesOtro" id="fechaMesOtro">
                        </div>
                        <div class="col-md-6 form-group">
                           <label>AÑO</label>
                           <input type="number" class="form-control" name="fechaAnioOtro" id="fechaAnioOtro" min="2000" max="2100">
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>

           <!-- tercer columna - Otro Reporte -->
         <div class="col-md-6 col-sm-12">
            <div class="x_panel">
               <h3>Pacientes por Fecha de Nacimiento</h3>
               <div class="x_content">
                  <form role="form" method="post" class="formularioReporteNacimiento">
                     <div class="form-group">
                        <label>RANGO DE FECHAS DE NACIMIENTO</label>
                     </div>
                     <div class="x_title">
                  <button type="button" class="btn btn-info pull-right btnReporteNacimiento btn-reporte no-line">
                     <i class="fa fa-print"></i> Generar reporte
                  </button>
                  <div class="clearfix"></div>
               </div>
                     <div class="row">
                        <div class="col-md-6 form-group">
                           <label>FECHA INICIAL</label>
                           <input type="date" class="form-control" name="fechaNacimientoInicio" id="fechaNacimientoInicio" required>
                        </div>
                        <div class="col-md-6 form-group">
                           <label>FECHA FINAL</label>
                           <input type="date" class="form-control" name="fechaNacimientoFin" id="fechaNacimientoFin" required>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
     
      </div>
   </section>
</div>
