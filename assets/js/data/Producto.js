var url = localStorage.getItem('url')+ "Producto/";
$(document).ready(function(){

    // Registrar
    $('#register').submit(function(e) {
        e.preventDefault();
        var nombre_producto = $('#nombre_producto').val();
        var formData = new FormData(this); // Creating FormData object.
        var image = $('#img_producto')[0].files[0]; // Getting file input data
        formData.append('file',image);
        // if (image == null || image == undefined) {
        //     image = null;
        // }
        var list_tallas = $("input[name='id_talla[]']");
        if(list_tallas.length === 0) {
            swal({
                title: 'Información',
                text: 'Debe agregar al menos una talla al producto.',
                icon: 'info',
                button: {
                    text: 'Aceptar',
                    className: 'green',
                    value: true,
                    visible: true,
                },
            }).then((accept) => {
                $('#btn-add-talla').addClass('tooltipped');
                var elem = document.querySelector('#btn-add-talla');
                var instance = M.Tooltip.init(elem, {
                    position: 'right',
                    html: 'Agregar Talla',
                    enterDelay: 200,
                });
                instance.open();
            });
        }
        else {
            $.ajax({
                method: "POST",
                data: formData,
                url: url + "register",
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                    console.log('Sending data');
                    $('#register :input').attr('disabled', 'disabled');
                },
                success: function (resp) {
                    console.log(resp);
                    swal({
                        title: "¡Bien hecho!",
                        text: "Se ha registrado el producto '" + nombre_producto + "' exitosamente.",
                        icon: "success",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        },
                        // timer: 3000
                    })
                    .then(redirect => {
                        location.href = url + "index";
                    });
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
            })
        }
        // Sending data by Ajax
    });

    // File type validation
    $('#img_producto').change(function() {
        var file = this.files[0];
        var mimetype = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if(!((mimetype == match[0]) || (mimetype == match[1]) || (mimetype == match[2]))){
            swal({
                text: "Por favor, elige una imagen con formato compatible. (JPG/JPEG/PNG)",
                icon: "warning",
                button: {
                    text: "Aceptar",
                    visible: true,
                    value: true,
                    className: "green",
                    closeModal: true
                }
            });
            $(this).val('');
            return false;
        }
    });

    // Modificar
    $('#modify').click(function(e) {
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
                            $('#update :input').removeAttr('disabled','disabled');
                            $('.btn.disabled').removeClass('disabled').removeClass('purple').addClass('purple-gradient');
                            $(".select-wrapper").removeClass('disabled');
                            $('select').formSelect();
                            $('#modify-btn').hide();
                            $('#delete-btn').hide();
                            $('#update-btn').show();
                            // $('#passwordUsuario').removeAttr('disabled', 'disabled');
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


    // Actualizar
    $('#update').submit(function(e) {
        e.preventDefault();
        var nombre_producto = $('#nombre_producto').val();
        var formData = new FormData(this); // Creating FormData object.

        // Sending data by AJAX
        $.ajax({
            method: "POST",
            data: formData,
            url: url + "update",
            contentType: false,
            cache: true,
            processData:false,
            beforeSend: function() {
                console.log('Sending data');
                $('#update :input').attr('disabled', 'disabled');
            },
            success: function(resp) {
                console.log(resp);
                swal({
                    title: "¡Bien hecho!",
                    text: "Se ha modificado el producto '" + nombre_producto + "' exitosamente.",
                    icon: "success",
                    button: {
                        text: "Aceptar",
                        visible: true,
                        value: true,
                        className: "green",
                        closeModal: true
                    },
                    // timer: 3000
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
                            deleteProducto();
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
     function  deleteProducto(){
        var codigo_producto = $('#codigo_producto').val();
        var nombre_producto = $('#nombre_producto').val();
        swal({
            title: "Eliminar Producto '" + nombre_producto + "'",
            text: "¿Esta seguro que desea eliminar este producto? Si lo hace, no podrá revertir los cambios.",
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
                        codigo_producto: codigo_producto
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
                    text: "Se ha eliminado el producto exitosamente.",
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
                    text: "No se ha eliminado el producto",
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


    $.ajax({
            method: 'GET',
            dataType: 'json',
            data: {},
            url: url + 'getAllTallas',
            beforeSend: function() {
                $('select.id_talla').html('<option>Cargando...</option>');
                console.log('It works');
            },
            success: function(resp) {
                var tallas = `<option value="" disabled selected>Elige una opción</option>`;
                if(resp === null) {
                    tallas = "<option disabled selected>No hay registros</option>";
                }
                else{
                    resp.forEach(function(talla,i){
                        tallas += `<option value="${ talla.id_talla }">${ talla.nombre_talla }</option>`;
                    });
                }
                $('select.list_id_talla').html(tallas);
                jQuery('select').formSelect();
            },
            error: function(err) {
                console.log(err);
            }
        });

    // function getTallas() {
    //     return
    // }

    // getTallas();

    // Add talla
    $('#btn-add-talla').click(function() {
        var id_talla = $('#list_id_talla').val();
        var nombre_talla = $('#list_id_talla option:selected').text();
        var stock_pro_talla = $('#list_stock_pro_talla').val();

        var template = ` 
            <div>
                <input type="hidden" name="id_talla[]" id="talla-${ id_talla }" value="${ id_talla }">
                <div class="input-field col s5 m5">
                    <i class="icon-straighten prefix"></i>
                    <input id="name_id_talla" type="text" name="name_id_talla" value="${ nombre_talla }" class="disabled validate" readonly>
                    <label for="name_id_talla">Talla</label>
                </div>
                <div class="input-field col s5 m5">
                    <i class="icon-call_made prefix"></i>
                    <input type="number" name="stock_pro_talla[]" id="stock_pro_talla" class="disabled " value="${ stock_pro_talla }" readonly>
                    <label for="stock_pro_talla">Cantidad por Talla</label>
                </div>
                <div class="input-field col s2 center-align">
                    <a href="#!" class="btn btn-floating red waves-effect waves-light remove">
                        <i class="icon-close"></i>
                    </a>
                </div>
            </div>
        `;
        $('#list_tallas').append(template);
        $('.remove').click(function() {
            $(this).parent().parent().text('');
        });
        $('#list_id_talla option[value=""]').prop('selected', true);
        $('#list_id_talla').prop('required', false);
        $('#list_stock_pro_talla').val('').prop('required', false);
        M.updateTextFields();
        $('select').formSelect();

    });


    $('#codigo_producto').blur(function() {
        var codigo_producto = $('#codigo_producto').val();
        $.ajax({
            method: "POST",
            dataType: 'json',
            data: { codigo_producto: codigo_producto },
            url: url + "checkCodigoProducto",
            beforeSend: function() {
                console.log('Send data');
                $('#register :input').attr('disabled','disabled');
            },
            success: function(resp) {
                console.log(resp);
                if(resp){
                    swal({
                        title: "Información",
                        text: "El producto ya se encuentra registrado en el sistema.",
                        icon: "info",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        }
                    });
                    $('#codigo_producto').val('');
                }
                $('#register :input').removeAttr('disabled','');
                $('select').formSelect();
                M.updateTextFields();
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

    $('#productos-table').DataTable({
            "responsive": true,
            "scrollX": true,
            "pageLength": 10,
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
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
