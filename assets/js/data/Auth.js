$(document).ready(function () {

    var url = localStorage.getItem('url');


    $('#email').change(function (){
        var email = $('#email').val();
        console.log()

        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                email: email
            },
            url: url+"Auth/verifyEmail",
            beforeSend: function() {
                $('#enviar :button').attr('disabled','disabled');
            },
            success: function(response) {
                console.log(response);
                if(response){
                    $('#enviar').removeAttr('disabled','');
                    swal({
                        title: "Información",
                        text: "El correo fue encontrado presione en recuperar contraseña.",
                        icon: "success",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        }
                    });
                }else{
                    swal({
                        title: "Información",
                        text: "Esté Correo no esta registrado en el sistema.",
                        icon: "warning",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        }
                    });

                    //$('#email').val(' ');
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
    })

});
