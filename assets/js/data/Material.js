
var url = localStorage.getItem('url')+"Material/";

$(document).ready(function () {

    $('#nombre_material').change(function (e) {
        e.preventDefault();
        // Valores de los input en la vista
        var nombre=$('#nombre_material').val();

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
                        title: "Material ya registrado",
                        text: "¿Quiere modificar o ver informacion del Material?, la pagina se actualizara",
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
                        $('#nombre_material').val(null);
                    });

                }
            },
            error:function(err){
                console.log(err);
            }
        });
    });

    // Registro del Material

    $('#register').submit(function (e) { //recibe el parametro register por id del formulario
        e.preventDefault();
        // Valores de los input en la vista
        var nombre_material = $('#nombre_material').val();
        var unidad_material = $('#unidad_material').val();
        var precio_material = $('#precio_material').val();
        var descripcion_material = $('#descripcion_material').val();
        // Enviar objetopor ajax
        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                nombre_material: nombre_material,
                unidad_material: unidad_material,
                precio_material: precio_material,
                descripcion_material: descripcion_material,
            },
            url: url + "create",
            beforeSend: function () {
                console.log("Sending data...");
            },
            success: function (data) {
                console.log(data);
                swal({
                        title: "¡Bien hecho!",
                        text: "Se ha registrado el material " + nombre_material + " exitosamente.",
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

    $('#edit').click(function(){
        $('#update :input').removeAttr('disabled','disabled'); //Remueve la propiedad disabled a los inputs

        //desaparecen botones
        $('#delete').hide();
        $('#edit').hide();
        //aparecen botones
        $('#update-btn').show();
        $('#back').show();

        });

    // Modificar Material
    $('#update').submit(function (e) { // recibe el parametro update por el id del formulario
        e.preventDefault();

        //Datos de los input en la vista
        var id_material = $('#id_material').val();
        var nombre_material = $('#nombre_material').val();
        var unidad_material = $('#unidad_material').val();
        var precio_material = $('#precio_material').val();
        var descripcion_material = $('#descripcion_material').val();

        // Mostrar alerta de confirmacion para modificar datos
        swal({
            title: "¿Quiere modificar la información del material " + nombre_material + "?",
            text: "¿Esta seguro que desea modificar este material? Si lo hace, no podrá revertir los cambios.",
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
                    data: { id_material: id_material,
                            nombre_material : nombre_material,
                            unidad_material: unidad_material,
                            precio_material: precio_material,
                            descripcion_material: descripcion_material },
                    url: url + "update",

                    beforeSend: function(){
                        console.log("Sending data...");
                    },

                    success: function(data) {
                        console.log(data);
                        swal({
                            title: "¡Bien hecho!",
                            text: "Se ha modificado la información del material " +  nombre_material + " exitosamente.",
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
                    text: "La informacion del material no ha sido modificada.",
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
                            deleteMaterial();
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
   function deleteMaterial() { // recibe el parametro eliminar por el id del formulario

        // Datos de los input en la vista
        var id_material = $('#id_material').val();
        var nombre_material = $('#nombre_material').val();

        // Mostrar alerta de confirmacion para eliminar datos
        swal({
            title: "¿Quiere eliminar el material "+nombre_material+"?",
            text: "¿Esta seguro que desea eliminar este material? Si lo hace, no podrá revertir los cambios.",
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
                    data: {id_material:id_material},
                    url: url + "delete",
                });

                swal({
                    text: "Se ha eliminado el material exitosamente.",
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
                    text: "El material no ha sido eliminado",
                    icon: "info",
                    button: {
                        text: "Aceptar",
                        className: "green"
                    }
                });
            }
        });
    };

    $('#Material').DataTable({
        "responsive": true,
        "scrollX": true,
        "pageLength": 10,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "No hay materiales registrados",
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
//     var nombre=$('#nombre_material').val();
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
//                 title: "Material ya registrado",
//                 text: "¿Quiere modificar o ver informacion del Material?, la pagina se actualizara",
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
//                    var id_material= data.id_material;
//
//                         location.href = url + "details/" + id_material;
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
