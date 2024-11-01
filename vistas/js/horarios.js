/*=============================================
ACTIVAR SERVICIO
=============================================*/
$(".tablas").on("click", ".btnActivarHora", function () {

    var idHorario = $(this).attr("idHorario");
    var estadoHorario = $(this).attr("estadoHorario");

    var datos = new FormData();
    datos.append("activarId", idHorario);
    datos.append("activarHorario", estadoHorario);

    $.ajax({

        url: "ajax/horarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {

            if (window.matchMedia("(max-width:767px)").matches) {

                swal({
                    title: "El horario ha sido actualizado",
                    type: "success",
                    confirmButtonText: "¡Cerrar!"
                }).then(function (result) {
                    if (result.value) {

                        window.location = "horarios";
                    }
                });
            }
        }
    })

    if (estadoHorario == 0) {

        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoHorario', 1);

    } else {

        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoHorario', 0);
    }
})


/*=============================================
CAPTURANDO LA CATEGORIA PARA ASIGNAR CÓDIGO
=============================================*/
$("#nuevoNombre").change(function () {

    var idUsuario = $(this).val();

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({

        url: "ajax/horarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            if (!respuesta) {

                var nuevoCodigo = idUsuario + "01";
                $("#nuevoCodigo").val(nuevoCodigo);

            } else {

                var nuevoCodigo = Number(respuesta["codigo"]) + 1;
                $("#nuevoCodigo").val(nuevoCodigo);

            }

        }

    })

})

/*=============================================
EDITAR PRODUCTO
=============================================*/
$(".tablas").on("click", ".btnEditarHorario", function () {

    var idHorario = $(this).attr("idHorario");

    var datos = new FormData();
    datos.append("idHorario", idHorario);

    $.ajax({
        url: "ajax/horarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);

            var idUsuario = respuesta["id_medico"];

            // Aquí debes crear un nuevo FormData con el idEmpleado
            var datosMedico = new FormData();
            datosMedico.append("idUsuario", idUsuario);

            $.ajax({

                url: "ajax/usuarios.ajax.php",
                method: "POST",
                data: datosMedico,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    console.log(respuesta);


                    $("#editarMedico").val(respuesta["id"]);
                    $("#editarMedico").html(respuesta["nombre"]);

                }

            })

            $("#IdHorario").val(respuesta["id"]);
            $("#editarEntrada").val(respuesta["entrada"]);
            $("#editarSalida").val(respuesta["salida"]);
            $("#editarDia").val(respuesta["dia"]);




        }

    })


})


/*=============================================
ELIMINAR PRODUCTO
=============================================*/
$(".tablas").on("click", ".btnEliminarHorario", function () {

    var idHorario = $(this).attr("idHorario");

    swal({
        title: '¿Está seguro de borrar el Horario?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Horario!'
    }).then(function (result) {

        if (result.value) {

            window.location = "index.php?ruta=horarios&idHorario=" + idHorario;

        }

    })

})


