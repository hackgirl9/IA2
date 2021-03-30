$(document).ready(function () {
    // Registrar

    var url = localStorage.getItem('url');





    $('#cedula_cliente').change(function () {
        var cedula_cliente = $('#cedula_cliente').val();
        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                cedula_cliente: cedula_cliente
            },

            url:    url+ "Cliente/verifyCedula",
            beforeSend: function() {
                $('#register :input').attr('disabled','disabled');
            },
            success: function(response) {
                console.log(response);
                if(response){
                    swal({
                        title: "Información",
                        text: "Esté cliente ya esta registrado en el sistema.",
                        icon: "info",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        }
                    });
                    $('#cedula_cliente').val(" ");
                }
                $('#register :input').removeAttr('disabled','');
            },
            error: function(err) {
                console.log(err);
                swal({
                    title: "¡Oh no!",
                    text: "Ha ocurrido un error inesperado, refresca la página e intentalo de nuevo.",
                    icon: "error",
                    button: {
                        text: "Aceptar",
                        visible: true,
                        value: true,
                        className: "green",
                        closeModal: true
                    }
                });
            }
        });
    });


    $('#register').submit(function (e) {
        e.preventDefault();
        // Getting form data
        var tipo_documento_cliente = $('#tipo_documento_cliente').val();
        var cedula_cliente = $('#cedula_cliente').val();
        var nombre_cliente = $('#nombre_cliente').val();
        var descripcion_cliente = $('#descripcion_cliente').val();
        var direccion_cliente = $('#direccion_cliente').val();
        var telefono_cliente = $('#telefono_cliente').val();
        var representante_cliente = $('#representante_cliente').val();

        // Sending data by AJAX
        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                tipo_documento_cliente: tipo_documento_cliente,
                cedula_cliente: cedula_cliente,
                nombre_cliente: nombre_cliente,
                descripcion_cliente: descripcion_cliente,
                direccion_cliente: direccion_cliente,
                telefono_cliente: telefono_cliente,
                representante_cliente: representante_cliente
            },
            url:url+"Cliente/register",
            beforeSend: function() {
                console.log("Sending data...");
            },
            success: function(data) {
                console.log(data);
                swal({
                    title: "¡Bien hecho!",
                    text: "Se ha registrado el cliente " + nombre_cliente + " exitosamente.",
                    icon: "success",
                    button: {
                        text: "Aceptar",
                        visible: true,
                        value: true,
                        className: "green",
                        closeModal: true
                    },
                    timer: 3000
                }).then(function () {
                    window.location.href=url+"Cliente/getAll";
                });
            },
            error: function(err) {
                console.log(err);
                swal({
                    title: "¡Oh no!",
                    text: "Ha ocurrido un error inesperado, refresca la página e intentalo de nuevo.",
                    icon: "error",
                    button: {
                        text: "Aceptar",
                        visible: true,
                        value: true,
                        className: "green",
                        closeModal: true
                    }
                });
            }
        });
    });

    // Modificar
    $('#form-details-client').submit(function(e) {
        e.preventDefault();
        $('#form-details-client :input').removeAttr('disabled','');
        $('#modify').html("Guardar Cambios <i class='icon-save right'></i>");
        $('#form-details-client').attr('id','form-update');
        $('select').formSelect();

        $('#form-update').submit(function (e) {
            e.preventDefault();
            // Getting form data
            var tipo_documento_cliente = $('#tipo_documento_cliente').val();
            var cedula_cliente = $('#documento_identidad').val();
            var nombre_cliente = $('#nombre_cliente').val();
            var descripcion_cliente = $('#descripcion_cliente').val();
            var direccion_cliente = $('#direccion_cliente').val();
            var telefono_cliente = $('#telefono_cliente').val();
            var representante_cliente = $('#representante_cliente').val();

            // Sending data by AJAX
            $.ajax({
                method: "POST",
                dataType: "json",
                data: {
                    tipo_documento_cliente: tipo_documento_cliente,
                    cedula_cliente: cedula_cliente,
                    nombre_cliente: nombre_cliente,
                    descripcion_cliente: descripcion_cliente,
                    direccion_cliente: direccion_cliente,
                    telefono_cliente: telefono_cliente,
                    representante_cliente: representante_cliente
                },
                url:     url+"Cliente/update",
                beforeSend: function() {
                    console.log("Sending data...");
                },
                success: function(data) {
                    swal({
                        title: "¡Bien hecho!",
                        text: "Se ha modicado el cliente " + nombre_cliente + " exitosamente.",
                        icon: "success",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        },
                        timer: 3000
                    }).then(function () {
                        window.location.href=url+"Cliente/details/"+cedula_cliente;
                    });
                },
                error: function(err) {
                    console.log(err.responseText);
                }
            });
        });
    });


    // Actualizar

    $('#delete').click(function () {
        swal("Clave Especial:", {
            content: {
                element: "input",
                attributes: {
                    placeholder: "Clave Especial",
                    type: "password",
                },
            },
        }).then((value) => {
             var password = value;

            if(password !== null){
                $.ajax({
                    method: "POST",
                    dataType: "json",
                    data: {contrasenia_especial:password},
                    url: url+"Auditoria/verifyPasswordEspecial",
                    beforeSend: function() {
                        console.log("Sending data...");
                    },
                    success: function(data) {
                        if(data){
                            deleteCliente();
                        }else{
                            swal({
                                title: "¡La clave especial no coincide!",
                                text: "Verifique que la clave sea la correcta.",
                                icon: "info",
                                button: {
                                    text: "Aceptar",
                                    visible: true,
                                    value: true,
                                    className: "green",
                                    closeModal: true
                                }
                            });
                        }
                    },
                    error: function(err) {
                        console.log(err);
                        swal({
                            title: "¡Oh no!",
                            text: "Ha ocurrido un error inesperado, refresca la página e intentalo de nuevo.",
                            icon: "error",
                            button: {
                                text: "Aceptar",
                                visible: true,
                                value: true,
                                className: "green",
                                closeModal: true
                            }
                        });
                    }
                });
            }
        });
    });


    //Eliminar
    function  deleteCliente() {
        swal({
            title: "Eliminar Cliente ",
            text: "¿Esta seguro que desea eliminar este cliente? Si lo hace, no podrá revertir los cambios.",
            icon: "warning",
            buttons: {
                confirm: {
                    text: "Eliminar",
                    value: true,
                    visible: true,
                    className: "red"

                },
                cancel: {
                    text: "Cancelar",
                    value: false,
                    visible: true,
                    className: "grey lighten-2"
                }
            }
        }).then(function (aceptar) {
            if(aceptar){
                var cedula_cliente = $('#documento_identidad').val();
                var nombre_cliente = $('#nombre_cliente').val();
                console.log(cedula_cliente);
                $.ajax({
                    method: "POST",
                    dataType: "json",
                    data: {cedula_cliente:cedula_cliente},
                    url:     url+"Cliente/delete",
                    beforeSend: function() {
                        console.log("Sending data...");
                    },
                    success: function(data) {
                        swal({
                            title: "¡Bien hecho!",
                            text: "Se ha eliminado el cliente " + nombre_cliente + " exitosamente.",
                            icon: "success",
                            button: {
                                text: "Aceptar",
                                visible: true,
                                value: true,
                                className: "green",
                                closeModal: true
                            }
                        }).then(function () {
                            window.location.href=url+"Cliente/getAll";
                        });
                    },
                    error: function(err) {
                        console.log(err);
                        swal({
                            title: "¡Oh no!",
                            text: "Ha ocurrido un error inesperado, refresca la página e intentalo de nuevo.",
                            icon: "error",
                            button: {
                                text: "Aceptar",
                                visible: true,
                                value: true,
                                className: "green",
                                closeModal: true
                            }
                        });
                    }
                });
            }
        })
    };

    if($('#clientes').val()!==undefined){
        $('#clientes').DataTable({
            "responsive": true,
            "scrollX": true,
            "pageLength": 10,
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "No hay clientes registrados",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "<i class='icon-navigate_next'></i>",
                    "sPrevious": "<i class='icon-navigate_before'></i>"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad"
                }
            }
        });
    }



});
