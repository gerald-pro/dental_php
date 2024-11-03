<?php

require_once "conexion.php";

class ModeloRazonSocial
{
    /*=============================================
	MOSTRAR SERVICIO
	=============================================*/

    static public function mdlMostrarRazonSocial($tabla, $item, $valor)
    {

        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            $resultados = $stmt->fetch();
            $stmt = null;
            return $resultados;
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            $resultados = $stmt->fetchAll();
            $stmt = null;
            return $resultados;
        }
    }

    static public function listar()
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM razonsocial");
        $stmt->execute();
        $resultados = $stmt->fetchAll();
        $stmt = null;
        return $resultados;
    }


    /*=============================================
	CREAR SERVICIO
	=============================================*/

    static public function mdlIngresarRazonSocial($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nit, nombre) VALUES (:nit,:nombre)");

        $stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);


        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }


        $stmt = null;
    }


    /*=============================================
	EDITAR SERVICIO
	=============================================*/

    static public function mdlEditarRazonSocial($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nit = :nit, nombre = :nombre  WHERE id = :id");

        $stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }


        $stmt = null;
    }

    /*=============================================
	ACTUALIZAR SERVICIO
	=============================================*/

    static public function mdlActualizarRazonSocial($tabla, $item1, $valor1, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    /*=============================================
        ELIMINAR SERVICIO
        =============================================*/

    static public function mdlBorrarRazonSocial($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }
}
