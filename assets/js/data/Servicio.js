var deleteMaterial = false;
$(document).ready(function () {
    var url = localStorage.getItem('url');


    $('#unidad_medida').attr('disabled', 'disabled');
    $('#costo_servicio').attr('disabled', 'disabled');
    $('#precio_servicio').attr('disabled', 'disabled');
    $('#descripcion_servicio').attr('disabled', 'disabled');

    $('#nombre_servicio').blur(function () {
        var nombre_servicio = $('#nombre_servicio').val();
        $.ajax({
            method: "post",
            dataType: "json",
            url: url + "Servicio/verificarServicio",
            data: {
                nombre_servicio: nombre_servicio
            },
            beforeSend: function () {
                console.log('estoy en el beforeSend');
            },
            success: function (data) {
                console.log('estoy en el success');
                console.log(data);
                if (data == true) {
                    swal({
                        title: "¡Upps!",
                        text: "Ya se encuentra un Servicio registrado con este nombre" + nombre_servicio,
                        icon: "warning",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "red",
                            closeModal: true
                        },
                        timer: 3000
                    });

                    $('#unidad_medida').attr('disabled', 'disabled');
                    $('#costo_servicio').attr('disabled', 'disabled');
                    $('#precio_servicio').attr('disabled', 'disabled');
                    $('#descripcion_servicio').attr('disabled', 'disabled');
                } else {

                    swal({
                        title: "Servicio No Registrado",
                        text: "Puedes continuar con el registro del servicio",
                        icon: "success",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        },
                        timer: 8000
                    });

                    $('#unidad_medida').removeAttr('disabled', 'disabled');
                    $('#costo_servicio').removeAttr('disabled', 'disabled');
                    $('#precio_servicio').removeAttr('disabled', 'disabled');
                    $('#descripcion_servicio').removeAttr('disabled', 'disabled');
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });


    // Registrar
    $('#register').on('submit', function (e) {
        e.preventDefault();
        var nombre_servicio = $('#nombre_servicio').val()

        $.ajax({
            method: "POST",
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            url: url + "Servicio/save",
            data: new FormData(this),
            // url: "",
            beforeSend: function () {
                console.log("Sending data...");
            },
            success: function (data) {
                console.log(data);
                if (data == true) {
                    swal({
                        title: "¡Bien hecho!",
                        text: "Se ha registrado el servicio exitosamente.",
                        icon: "success",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        },
                        timer: 3000
                    }).then(redirect => {
                        location.href = url + "Servicio/getMateriales";
                    });
                }
            },
            error: function (err) {
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

    if (deleteMaterial == false) {
        $('#deleteMaterial').on('click', function (event) {

            $('.materiales').removeAttr('disabled', '');
            // $(this).addAttr('disabled','disabled');
            deleteMaterial = true;


        });
    }

    //if (deleteMaterial==true){
    //  $('#deleteMaterial').on('click',function(event) {
    //    console.log('hola');
    //      console.log(deleteMaterial);

    //      $('.materiales').addAttr('disabled','disabled');
    //    $(this).text('Eliminar Materiales');
    //  deleteMaterial=false;

    //});
    //}


    // Registrar material
    $('#MaterialServi').on('submit', function (e) {
        e.preventDefault();
        var cantidad = $('#cantidad').val();
        var id = $('#id_material').val();
        var idServicio = localStorage.getItem('id_servicio');


        $.ajax({
            method: "POST",
            dataType: "json",

            url: url + "Servicio/saveMaterial",
            data: {
                cantidad: cantidad,
                id: id,
                idServicio: idServicio
            },
            beforeSend: function () {
                console.log("Sending data...");
            },
            success: function (data) {
                console.log(data.status);

                if (data === 'update') {
                    swal({
                        title: "¡Bien hecho!",
                        text: "Se ha actualizado el material del servicio exitosamente.\n" +
                            "¿Deseas Añadir otro material?",
                        icon: "success",
                        buttons: {
                            confirm: {
                                text: "Si",
                                value: true,
                                visible: true,
                                className: "red-45"
                            },
                            cancel: {
                                text: "Cancelar",
                                value: false,
                                visible: true,
                                className: "grey lighten-2"
                            }
                        },
                    }).then(redirect => {
                        if (redirect) {
                            location.href = url + "Servicio/getMateriales";
                        } else {
                            location.href = url + "Servicio/getAll";
                        }

                    });
                }

                if (data == true) {
                    swal({
                        title: "¡Bien hecho!",
                        text: "Se ha registrado el material al servicio exitosamente.\n" +
                            "¿Deseas Añadir otro material?",
                        icon: "success",
                        buttons: {
                            confirm: {
                                text: "Si",
                                value: true,
                                visible: true,
                                className: "red-45"
                            },
                            cancel: {
                                text: "Cancelar",
                                value: false,
                                visible: true,
                                className: "grey lighten-2"
                            }
                        },
                    }).then(redirect => {
                        if (redirect) {
                            location.href = url + "Servicio/getMateriales";
                        } else {
                            location.href = url + "Servicio/getAll";
                        }
                    });
                }

            },
            error: function (err) {
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
    var click = false;
    $('#modify').on('click', function (e) {
        e.preventDefault();

        if (click == true) {

            // Getting form data
            var id_servicio = $('#id_servicio').val();
            var nombre_servicio = $('#nombre_servicio').val();
            var unidad_medida = $('#unidad_medida').val();
            var precio_servicio = $('#precio_servicio').val();
            var costo_servicio = $('#costo_servicio').val();
            var descripcion_servicio = $('#descripcion_servicio').val();

            swal({
                title: "Actualizar Servicio",
                text: "¿Está seguro que desea actualizar el Servicio? Una vez Actualizado, no podra revertir los cambios.",
                icon: "warning",
                buttons: {
                    confirm: {
                        text: "Actualizar",
                        value: true,
                        visible: true,
                        className: "red-45"

                    },
                    cancel: {
                        text: "Cancelar",
                        value: false,
                        visible: true,
                        className: "grey lighten-2"
                    }
                }
            }).then(function (d) {
                $.ajax({
                    method: "POST",
                    dataType: "json",
                    url: url + "Servicio/update",
                    data: {
                        id_servicio: id_servicio,
                        nombre_servicio: nombre_servicio,
                        unidad_medida: unidad_medida,
                        precio_servicio: precio_servicio,
                        costo_servicio: costo_servicio,
                        descripcion_servicio: descripcion_servicio,
                    },
                    beforeSend: function () {
                        console.log("Sending data...");
                    },
                    success: function (data) {
                        console.log(data);
                        if (data == true) {
                            swal({
                                title: "¡Bien hecho!",
                                text: "Se ha Actualizado el servicio " + nombre_servicio + " exitosamente.",
                                icon: "success",
                                button: {
                                    text: "Aceptar",
                                    visible: true,
                                    value: true,
                                    className: "green",
                                    closeModal: true
                                },
                                timer: 3000
                            }).then(redirect => {
                                location.reload();
                            });

                        }
                    },
                    error: function (err) {
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
        }
        if (click == false) {
            $('#nombre_servicio').removeAttr('disabled', 'disabled');
            $('#unidad_medida').removeAttr('disabled');
            $('#precio_servicio').removeAttr('disabled');
            $('#costo_servicio').removeAttr('disabled');
            $('#descripcion_servicio').removeAttr('disabled');

            click = true;
        }
    });


    // Eliminar

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
                    url: localStorage.getItem('url')+"Auditoria/verifyPasswordEspecial",
                    beforeSend: function() {
                        console.log("Sending data...");
                    },
                    success: function(data) {
                        if(data){
                            deleteServicio();
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

   function deleteServicio() {

        // Getting form data
        var id_servicio = $('#id_servicio').val();
        var nombre_servicio = $('#nombre_servicio').val();

        swal({
            title: "Eliminar Servicio ????",
            text: "¿Esta seguro que desea eliminar este servicio? Si lo hace, no podrá revertir los cambios.",
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
        }).then(function (terminar) {
            $.ajax({
                method: "POST",
                dataType: "json",
                url: url + "Servicio/delete",
                data: {
                    id_servicio: id_servicio,
                }
            });
            console.log(terminar);
            if (terminar) {
                swal({
                    title: "¡Bien hecho!",
                    text: "Se ha Actualizado el servicio " + nombre_servicio + " exitosamente.",
                    icon: "success",
                    button: {
                        text: "Aceptar",
                        visible: true,
                        value: true,
                        className: "green",
                        closeModal: true
                    },
                    timer: 3000
                })
                    .then(redirect => {
                        location.href = url + "Servicio/getAll";
                    });
            } else {
                swal({
                    text: "Acción cancelada.",
                    icon: "info",
                    button: {
                        text: "Aceptar",
                        className: "blue-45deg-gradient-1"
                    }
                });
            }
        });
    };

    $('#addMateriales').on('click', function (e) {
        var id_servicio = $('#id_servicio').val();
        var id_materiales = $('#id_material').val();

        console.log(id_servicio, id_materiales)
        $.ajax({
            method: "POST",
            dataType: "json",
            url: url + "Servicio/update",
            data: {
                id_servicio: id_servicio,
                nombre_servicio: nombre_servicio,
                unidad_medida: unidad_medida,
                precio_servicio: precio_servicio,
                costo_servicio: costo_servicio,
                descripcion_servicio: descripcion_servicio,
            },
            beforeSend: function () {
                console.log("Sending data...");
            },
            success: function (data) {
                console.log(data);
                if (data == true) {
                    swal({
                        title: "¡Bien hecho!",
                        text: "Se ha Actualizado el servicio " + nombre_servicio + " exitosamente.",
                        icon: "success",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        },
                        timer: 3000
                    }).then(redirect => {
                        location.reload();
                    });

                }
            },
            error: function (err) {
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

    //Consultar servicios DataTables
    $('#Servicio').DataTable({
        "responsive": true,
        "scrollX": true,
        "pageLength": 10,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "No hay servicios registrados",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "<i class='icon-navigate_next'></i>",
                "sPrevious": "<i class='icon-navigate_before'></i>"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        }
    });


    $('#Materiales').DataTable({
        "responsive": true,
        "scrollX": true,
        "pageLength": 10,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "No hay materiales registrados",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "<i class='icon-navigate_next'></i>",
                "sPrevious": "<i class='icon-navigate_before'></i>"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        }
    });


    $('.materiales').on('click', function (e) {
        var id = $(this).attr('data-id');
        swal({
            title: "¿Eliminar Material ?",
            text: "¿Esta seguro que desea eliminar este material Si lo hace, no podrá revertir los cambios.",
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
        }).then(function (terminar) {
            if (terminar) {
                $.ajax({
                    method: "POST",
                    dataType: "json",
                    url: url + "Servicio/deleteMaterial",
                    data: {
                        id_material: id_material,
                    },
                    beforeSend: function () {
                        console.log("Sending data...");
                    },
                    success: function (data) {
                        console.log(data);
                        if (data == true) {
                            swal({
                                title: "¡Bien hecho!",
                                text: "Se ha Actualizado el servicio " + nombre_servicio + " exitosamente.",
                                icon: "success",
                                button: {
                                    text: "Aceptar",
                                    visible: true,
                                    value: true,
                                    className: "green",
                                    closeModal: true
                                },
                                timer: 3000
                            }).then(redirect => {
                                location.reload();
                            });

                        }
                    },
                    error: function (err) {
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
                    }});
            } else {
                swal({
                    text: "Acción cancelada.",
                    icon: "info",
                    button: {
                        text: "Aceptar",
                        className: "blue-45deg-gradient-1"
                    }
                });
            }
        });
    });


});
