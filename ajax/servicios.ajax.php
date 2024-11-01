<?php

require_once "../controladores/servicios.controlador.php";
require_once "../modelos/servicios.modelo.php";


class AjaxServicios
{
    /*=============================================
    EDITAR SERVICIO
    =============================================*/


    public $idServicio;
    public $traerServicio;
    public $nombreServicio;
  
    public function ajaxEditarServicio(){
  
      if($this->traerServicio == "ok"){
  
        $item = null;
        $valor = null;
     
  
        $respuesta = ControladorServicios::ctrMostrarServicios($item, $valor);
  
        echo json_encode($respuesta);
  
  
      }else if($this->nombreServicio != ""){
  
        $item = "nombre";
        $valor = $this->nombreServicio;
        
  
        $respuesta = ControladorServicios::ctrMostrarServicios($item, $valor);
  
        echo json_encode($respuesta);
  
      }else{
  
        $item = "id";
        $valor = $this->idServicio;
        
  
        $respuesta = ControladorServicios::ctrMostrarServicios($item, $valor);
  
        echo json_encode($respuesta);
  
      }
  
    }
  
  
        /*=============================================
        ACTIVAR SERVICIO
        =============================================*/

    public $activarServicio;
    public $activarId;

    public function ajaxActivarServicio()
    {

        $tabla = "servicio";

        $item1 = "estado";
        $valor1 = $this->activarServicio;

        $item2 = "idServicio";
        $valor2 = $this->activarId;

        $respuesta = ModeloServicios::mdlActualizarServicio($tabla, $item1, $valor1, $item2);
    }
}
/*=============================================
EDITAR SERVICIOS
=============================================*/
if (isset($_POST["idServicio"])) {

    $editarServicio = new AjaxServicios();
    $editarServicio->idServicio = $_POST["idServicio"];
    $editarServicio->ajaxEditarServicio();
}

/*=============================================
TRAER SERVICIO
=============================================*/ 

if(isset($_POST["traerServicio"])){

    $traerServicio = new AjaxServicios();
    $traerServicio -> traerServicio = $_POST["traerServicio"];
    $traerServicio -> ajaxEditarServicio();
  
  }
  
  /*=============================================
  TRAER SERVICIO
  =============================================*/ 
  
  if(isset($_POST["nombreServicio"])){
  
    $traerServicio = new AjaxServicios();
    $traerServicio -> nombreServicio = $_POST["nombreServicio"];
    $traerServicio -> ajaxEditarServicio();
  
  }
/*=============================================
ACTIVAR SERVICIO
=============================================*/

if (isset($_POST["activarServicio"])) {

    $activarServicio = new AjaxServicios();
    $activarServicio->activarServicio = $_POST["activarServicio"];
    $activarServicio->activarId = $_POST["activarId"];
    $activarServicio->ajaxActivarServicio();
}
