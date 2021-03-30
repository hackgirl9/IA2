const url = localStorage.getItem('url')+"Tela/"; // Constante global para ser usadaen las rutas de ajax

$(document).ready(function () {
    // Registro de la tela

    $('#nombre_tela').change(function (e) { //recibe el parametro register por id del formulario
        e.preventDefault();
        // Valores de los input en la vista
        var nombre=$('#nombre_tela').val();


        $.ajax({
            method: "POST",
            datatype: "JSON",
            data: {nombre:nombre},
            url: url + "search",

            beforeSend:function(){
                console.log("Sending data...");
            },

            success:function(data){

                if(data){

                    swal({
                        title: "Tela ya registrada",
                        text: "¿Quiere modificar o ver informacion de la tela?, la pagina se actualizara",
                        icon: "info",
                        buttons: {
                            confirm: {
                                text: "Detalles",
                                value: true,
                                visible: true,
                                className: "green"

                            },
                            cancel: {
                                text: "Cancelar",
                                value: false,
                                visible: true,
                                className: "grey lighten-2"
                            }
                        }
                    }).then(function(value){
                        $('#nombre_tela').val(null);
                    });

                }
            },
            error:function(err){
                console.log(err);
            }
        });
    });

    $('#register').submit(function (e) { //recibe el parametro register por id del formulario
        e.preventDefault();
        // Valores de los input en la vista
        var nombre_tela = $('#nombre_tela').val();
        var unidad_med_tela = $('#unidad_med_tela').val();
        var tipo_tela = $('#tipo_tela').val();
        var descripcion_tela = $('#descripcion_tela').val();
        // Enviar objetopor ajax
        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                    nombre_tela: nombre_tela,
                    unidad_med_tela: unidad_med_tela,
                    tipo_tela: tipo_tela,
                    descripcion_tela: descripcion_tela,
                    },
             url: url + "create",
            beforeSend: function() {
                console.log("Sending data...");
            },
            success: function(data) {
                console.log(data);
                swal({
                    title: "¡Bien hecho!",
                    text: "Se ha registrado la tela " +  nombre_tela + " exitosamente.",
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

    // Deshabilitar Campos en detalles

    $('#edit').click(function(){
        $('#update :input').removeAttr('disabled','disabled'); //Remueve la propiedad disabled a los inputs

        //desaparecen botones
        $('#delete').hide();
        $('#edit').hide();
        //aparecen botones
        $('#update-btn').show();
        $('#back').show();

        });

    // Modificar Tela

    $('#update').submit(function (e) { // recibe el parametro update por el id del formulario
        e.preventDefault();

        //Datos de los input en la vista

        var id_tela = $('#id_tela').val();
        var nombre_tela = $('#nombre_tela').val();
        var unidad_med_tela = $('#unidad_med_tela').val();
        var tipo_tela = $('#tipo_tela').val();
        var descripcion_tela = $('#descripcion_tela').val();

        // Mostrar alerta de confirmacion para modificar datos
        swal({
            title: "¿Quiere modificar la información de la tela " + nombre_tela + "?",
            text: "¿Esta seguro que desea modificar esta tela? Si lo hace, no podrá revertir los cambios.",
            icon: "warning",
            buttons: {
                confirm: {
                    text: "Actualizar",
                    value: true,
                    visible: true,
                    className: "green"

                },
                cancel: {
                    text: "Cancelar",
                    value: false,
                    visible: true,
                    className: "grey lighten-2"
                }
            }

        }).then(function(value){
            if(value == true){
                $.ajax({

                    method: "POST",
                    datatype: "JSON",
                    data: { id_tela: id_tela,
                            nombre_tela : nombre_tela,
                            unidad_med_tela: unidad_med_tela,
                            tipo_tela: tipo_tela,
                            descripcion_tela: descripcion_tela },
                    url: url + "update",

                    beforeSend: function(){
                        console.log("Sending data...");
                    },

                    success: function(data) {
                        console.log(data);
                        swal({
                            title: "¡Bien hecho!",
                            text: "Se ha actualizado la tela " +  nombre_tela + " exitosamente.",
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
                })}else {

                swal({
                    text: "La informacion de la tela no ha sido modificada.",
                    icon: "info",
                    button: {
                        text: "Aceptar",
                        className: "green"
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
                            deleteTela();
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
    function deleteTela () { // recibe el parametro eliminar por el id del formulario

        // Datos de los input en la vista

        var id_tela = $('#id_tela').val();
        var nombre_tela = $('#nombre_tela').val();

        // Mostrar alerta de confirmacion para eliminar datos

        swal({
            title: "¿Quiere eliminar la tela "+nombre_tela+"?",
            text: "¿Esta seguro que desea eliminar esta tela? Si lo hace, no podrá revertir los cambios.",
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
        }).then(function(value){
            if(value == true){
                $.ajax({
                    method: "POST",
                    datatype: "JSON",
                    data: {id_tela:id_tela},
                    url: url + "delete",
                });

                swal({
                    text: "Se ha eliminado la tela exitosamente.",
                    icon: "success",
                    button: {
                        text: "Entendido",
                        className: "green"
                    },
                    timer: 3000
                })
                .then(redirect => {
                    location.href = url + "getAll";
                });
            }else {
                swal({
                    text: "La tela no ha sido eliminado",
                    icon: "info",
                    button: {
                        text: "Aceptar",
                        className: "green"
                    }
                });
            }
        });
    };

    $('#Tela').DataTable({
        "responsive": true,
        "scrollX": true,
        "pageLength": 10,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "No hay telas registradas",
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



});

// function buscar(){
//
//     var nombre=$('#nombre_tela').val();
//
//        $.ajax({
//             method: "POST",
//             datatype: "JSON",
//             data: {nombre:nombre},
//             url: url + "search",
//
//            beforeSend:function(){
//             console.log("Sending data...");
//            },
//
//            success:function(data){
//
//            if(data){
//
//             swal({
//                 title: "Tela ya registrada",
//                 text: "¿Quiere modificar o ver informacion de la tela?, la pagina se actualizara",
//                 icon: "info",
//                 buttons: {
//                     confirm: {
//                         text: "Detalles",
//                         value: true,
//                         visible: true,
//                         className: "green"
//
//                     },
//                     cancel: {
//                         text: "Cancelar",
//                         value: false,
//                         visible: true,
//                         className: "grey lighten-2"
//                     }
//                 }
//             }).then(function(value){
//                 if(value == true){
//
//                    var id_tela= data.id_tela;
//
//                         location.href = url + "details/" + id_tela;
//
//                 }else {
//                         setTimeout('document.location.reload()', 0);
//                 }
//             });
//
//            }
//         },
//            error:function(err){
//                console.log(err);
//            }
//    });
// };
