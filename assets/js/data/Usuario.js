
$(document).ready(function(){
var url = localStorage.getItem('url')+"Usuario/";
    // Registrar
    $('#register').submit(function(e) {
        e.preventDefault(); // Disable submit event
        // Getting form data
        var id_imagen_select = $("input[name='image']:checked").attr('id-imagen');
        var nick_usuario = $('#nick_usuario').val();
        var nombre_usuario = $('#nombre_usuario').val();
        var apellido_usuario = $('#apellido_usuario').val();
        var email_usuario = $('#email_usuario').val();
        var contrasenia_usuario = $('#contrasenia_usuario').val();
        var contrasenia_especial = $('#contrasenia_especial').val();
        var pregunta = $('#id_pregunta').val();
        var respuesta=$('#respuesta').val();
        var image = $("input[name='image']:checked").val();
        var id_rol = $('#id_rol').val();

        if(pregunta==null){
            return swal({
                title: "¡Información!",
                text: "Debe elegir una pregunta de seguridad para completar el registro.",
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


        if(id_rol==null){
            return swal({
                title: "¡Información!",
                text: "Debe elegir un rol para completar el registros",
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


        if(image===undefined){
            return swal({
                title: "¡Información!",
                text: "Debe elegir una imagen de seguridad para completar el registro.",
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



        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                    nick_usuario: nick_usuario,
                    nombre_usuario: nombre_usuario,
                    apellido_usuario: apellido_usuario,
                    email_usuario: email_usuario,
                    contrasenia_usuario: contrasenia_usuario,
                    pregunta:pregunta,
                    respuesta:respuesta,
                    image:image,
                    contrasenia_especial:contrasenia_especial,
                    id_imagen_select:id_imagen_select,

                    // repeat_password_usuario: repeat_password_usuario,
                    id_rol: id_rol
                    },
            url: url + "register",
            beforeSend: function() {
                console.log("Sending data...");
                $('#register :input').attr('disabled', 'disabled');
            },
            success: function(data) {
                console.log(data);
                swal({
                    title: "¡Bien hecho!",
                    text: "Se ha registrado el usuario '" + nick_usuario + "' exitosamente.",
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
                    location.href = url + "index";
                })
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

    $('#modify').click(function () {
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
                            modify();
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

    // Modificar
    function modify() {
        $('#update :input').removeAttr('disabled','disabled');
        // $("#nick_usuario").removeAttr("disabled", "disabled");
        // $("#nombre_usuario").removeAttr("disabled", "disabled");
        // $("#apellido_usuario").removeAttr("disabled", "disabled");
        // $("#email_usuario").removeAttr("disabled", "disabled");
        // $("#contrasenia_usuario").removeAttr("disabled", "disabled");
        $("#id_rol").removeAttr("readonly", "false");
        $(".select-wrapper").removeClass('disabled');
        $('select').formSelect();
        $('#modify-btn').hide();
        $('#delete-btn').hide();
        $('#change-password').hide();
        $('#reset-password').hide();
        $('#update-btn').show();
        $('#reset-buttons').show();
        // $('#passwordUsuario').removeAttr('disabled', 'disabled');

    };

    $('#reset-buttons').click(() => {
        $('#form-user').show();
        $('#update :input').attr('disabled',true);
        // $('#form-password').hide();
        $('#modify').show();
        $('#update-btn').hide();
        // $('#change-password').hide();
        $('#form-password').hide();
        $('#modify-btn').show();
        $('#delete-btn').show();
        $('#change-password').show();
        $('#reset-buttons').hide();
        $('#update-password').hide();
        $('select').formSelect();
    });


    $('#change-password').click(function () {
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
                            changePassword();
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

    function changePassword(e) {
        $('#update :input').removeAttr('disabled','disabled');
        $('#form-password').show();
        $('#form-user').hide();
        $('#modify').hide();
        $('#modify-btn').hide();
        $('#delete-btn').hide();
        $('#change-password').hide();
        $('#reset-password').hide();
        // $('#update-btn').show();
        $('#update-password').show();

        $('#reset-buttons').show();
        $(this).hide();
    };

    $('#update-password-btn').click(function () {
        var contrasenia_usuario = $('#contrasenia_usuario').val();
        var repeat_contrasenia_usuario = $('#repeat_contrasenia_usuario').val();
        var nick_usuario = $('#nick_usuario').val();
        console.log(nick_usuario);
        if(contrasenia_usuario !== '' && repeat_contrasenia_usuario !== '') {
            $.ajax({
                method: "POST",
                dataType: "json",
                data: {
                    contrasenia_usuario: contrasenia_usuario,
                    repeat_contrasenia_usuario: repeat_contrasenia_usuario,
                    nick_usuario: nick_usuario,
                },
                url: localStorage.getItem('url') + "Usuario/updatePassword",
                beforeSend: function() {
                    console.log("Sending data...");
                    $('#update :input').attr('disabled', 'disabled');
                },
                success: function(data) {
                    console.log(data);
                    swal({
                        title: "¡Bien hecho!",
                        text: "Se ha cambiado la contraseña del usuario '" + nick_usuario + "' exitosamente.",
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
                            location.reload();
                        })
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


    $('#update').submit(function(e) {
        e.preventDefault(); // Disable submit event
        // Getting form data
        var nick_usuario = $('#nick_usuario').val();
        var nombre_usuario = $('#nombre_usuario').val();
        var apellido_usuario = $('#apellido_usuario').val();
        var email_usuario = $('#email_usuario').val();
        var contrasenia_usuario = $('#contrasenia_usuario').val();
        var id_rol = $('#id_rol').val();
        var status = $('#status').val();

        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                    nick_usuario: nick_usuario,
                    nombre_usuario: nombre_usuario,
                    apellido_usuario: apellido_usuario,
                    email_usuario: email_usuario,
                    contrasenia_usuario: contrasenia_usuario,
                    // repeat_password_usuario: repeat_password_usuario,
                    id_rol: id_rol,
                    status: status
                    },
            url: url + "update",
            beforeSend: function() {
                console.log("Sending data...");
                $('#update :input').attr('disabled', 'disabled');
            },
            success: function(data) {
                console.log(data);
                swal({
                    title: "¡Bien hecho!",
                    text: "Se ha modificado el usuario '" + nick_usuario + "' exitosamente.",
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
                    location.reload();
                })
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
                            deleteUser();
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

    // Eliminar
   function deleteUser () {
        var nick_usuario = $('#nick_usuario').val();
        swal({
            title: "Eliminar Usuario " + nick_usuario,
            text: "¿Esta seguro que desea eliminar este usuario? Si lo hace, no podrá revertir los cambios.",
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
        })
        .then(promise => {
            if(promise) {
                $.ajax({
                    method: "POST",
                    dataType: "json",
                    data: {
                        nick_usuario: nick_usuario
                    },
                    url: url + "delete",
                    beforeSend: function() {
                        console.log('Sending data...');
                    },
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
                swal({
                    title: "Eliminación exitosa",
                    text: "Se ha eliminado el usuario exitosamente.",
                    icon: "success",
                    // timer: 3000,
                    buttons: {
                        confirm: {
                            text: "¡Listo!",
                            className: "green"
                        }
                    }
                })
                .then(exit => {
                    location.href = url + "index";
                });
            }
            else {
                swal({
                    text: "No se ha eliminado el usuario",
                    icon: "info",
                    buttons: {
                        confirm: {
                            text: "¡Esta bien!",
                            className: "blue"
                        }
                    }
                });
            }
        });
    };

    $('#repeat_contrasenia_usuario').blur(function () {
        var contrasenia_usuario = $('#contrasenia_usuario').val();
        var repeat_contrasenia_usuario = $('#repeat_contrasenia_usuario').val();
        if (contrasenia_usuario !== repeat_contrasenia_usuario) {
            swal({
                title: "¡Oh no!",
                text: "¡Las contraseñas no coinciden! Vuelve a intentarlo.",
                icon: "warning",
                button: {
                    text: "Vale",
                    className: "red"
                }
            });
        }
        else {
            swal({
                title: "¡Genial!",
                text: "¡Las contraseñas coinciden!",
                icon: "success",
                button: {
                    text: "Vale",
                    className: "green"
                }
            });
        }
    });

    $('#nick_usuario').blur(function() {
        var nick_usuario = $('#nick_usuario').val();
        $.ajax({
            method: "POST",
            dataType: 'json',
            data: { nick_usuario: nick_usuario },
            url: url + "checkNickUsuario",
            beforeSend: function() {
                console.log('Send data');
                $('#register :input').attr('disabled','disabled');
            },
            success: function(resp) {
                console.log(resp);
                if(resp){
                    swal({
                        title: "Información",
                        text: "El nick '" + nick_usuario + "' ya se encuentra registrado en el sistema.",
                        icon: "info",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        }
                    });
                    $('#nick_usuario').val('');
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

    $('#email_usuario').blur(function() {
        var email_usuario = $('#email_usuario').val();
        $.ajax({
            method: "POST",
            dataType: 'json',
            data: { email_usuario: email_usuario },
            url: url + "checkEmailUsuario",
            beforeSend: function() {
                console.log('Send data');
                $('#register :input').attr('disabled','disabled');
            },
            success: function(resp) {
                console.log(resp);
                if(resp){
                    swal({
                        title: "Información",
                        text: "El E-mail '" + email_usuario + "' ya se encuentra registrado en el sistema.",
                        icon: "info",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        }
                    });
                    $('#email_usuario').val('');
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

    $('#usuarios-table').DataTable({
            responsive: true,
            "scrollX": true,
            "pageLength": 10,
            language: {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "<i class='icon-first_page'></i>",
                    "sLast":     "<i class='icon-last_page'></i>",
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
});
