$(document).ready(function () {
    // Registrar

    var url = localStorage.getItem('url');


    localStorage.setItem('pedido',JSON.stringify({
        cedula_cliente:'',
        status_pedido:'',
        fecha_entrega_pedido:'',
        descripcion_pedido:'',
        total_pagar:'',
        modo_pago_factura:'',
        porcentaje_pago_factura:'',
        servicio:[],
        productos:[]
    }));


    let validationInput=(className)=>{
        let field=document.getElementsByClassName(className);
        let band=false;
        for(var i=0;i<field.length;i++){

            if(field[i].value==''){
                swal({
                    title: "Información",
                    text: "Debe completar el campo " +field[i].getAttribute('name_field') +"." ,
                    icon: "info",
                    button: {
                        text: "Esta bien",
                        className: "blue-gradient"
                    },
                });

                band=true;
                break;
            }

        }

        return band;
    }





    $('#add-services').click(function () {
        var texto = '';
        $.ajax({
            method: "POST",
            dataType: "json",
            url: url+"Pedido/getTelas",
            beforeSend: function () {

            },
            success: function (data) {
                console.log(data);
                $('input[type=checkbox]:checked').each(function () {
                    var name = $(this).attr('name');
                    var name_str = name.substr(0, 4);
                    var id_servicio=$(this).val();
                    var price_service=0;


                    data['services'].forEach(function (services,index) {
                        if(services['id_servicio']==id_servicio){
                            price_service=services['precio_servicio'];

                        }

                    });
                    texto += `<div>
                     <div class="col s12">
                                <h4 class="center-align d-inline-block title-service">${name}</h4> <i
                                        class="icon-close right close-service" id="${name}"></i>
                            </div>
                            <div class="input-field col s12 m4">
                                <i class="icon-plus_one prefix"></i>
                                <input type="number" name="cantidad_prenda_${name_str}" id="cantidad_prenda_${name_str}"
                                       class="validate" pattern="[0-9]+" min="1" title="Solo puede usar números." value="1">
                                <label for="cantidad_prenda_${name_str}">Cantidad de Prendas</label>
                            </div>
                            
                            <div class="input-field col s12 m4">
                                <i class="icon-star_border prefix"></i>
                                <input type="number" name="cantidad_medida_${name_str}" id="cantidad_medida_${name_str}"
                                       class="validate" pattern="[0-9]+" min="1" title="Solo puede usar números." value="1">
                                <label for="cantidad_prenda_${name_str}">Cantidad de Medida</label>
                            </div>
                            
                            <div class="input-field col s12 m4">
                                <i class="icon-star_border prefix"></i>
                                <input type="number" name="precio_servicio_${name_str}" id="precio_servicio_${name_str}"
                                       class="validate" pattern="[0-9]+" min="1" title="Solo puede usar números." value="${price_service}">
                                <label for="cantidad_prenda_${name_str}">Precio Servicio</label>
                            </div>
                             
                            
                            <div class="input-field col s12 m12">
                          
                                <select name="id_tela" id="id_tela_${name_str}" class="browser-default">
                                    ${data['telas'].map(tela => `
                                       <option value="${tela.id_tela}" >${tela.nombre_tela}</option>
                                       `)}
                                </select>
                                
                            </div>
                    </div>`;});
                $('#services').html(texto);
                M.updateTextFields();


                $('.close-service').click(function () {
                    var service=$(this).attr('id');
                    $('input[type=checkbox]:checked').each(function () {
                        if($(this).attr('name')===service){
                            $(this).prop("checked",false);
                        }
                    });
                    $(this).parent().parent().html("");
                });


            },
            error: function (err) {
                console.log(err.responseText);
            }
        });

    });



    $('#register-service').submit(function (e) {
        e.preventDefault();
        var servicios_seleted = [];
        var id_servicios = [];
        $('input[type=checkbox]:checked').each(function () {
            servicios_seleted.push($(this).attr('id'));
            id_servicios.push($(this).val());
        });

        console.log(servicios_seleted);
        var servicio = [];


        if(servicios_seleted.length<1){
            return swal({
                title: "Información",
                text: "Debes agregar al menos un servicio para completar esta acción.",
                icon: "info",
                button: {
                    text: "Aceptar",
                    visible: true,
                    value: true,
                    className: "green",
                    closeModal: true
                }
            })
        }



        for (var i = 0; i < servicios_seleted.length; i++) {

            servicio.push({
                id: id_servicios[i], servicio: servicios_seleted[i],
                codigo_pedido: document.querySelector('#codigo_pedido').value,
                cant_prenda: document.querySelector('#cantidad_prenda_' + servicios_seleted[i]).value,
                cant_medida: document.querySelector('#cantidad_medida_' + servicios_seleted[i]).value,
                precio_servicio:document.querySelector('#precio_servicio_' + servicios_seleted[i]).value,
                id_tela: $('#id_tela_' + servicios_seleted[i]).val()
            });
        }


        var json_text = JSON.stringify(servicio);
        var json = JSON.parse(json_text);

        let pedido=JSON.parse(localStorage.getItem('pedido'));
        pedido.servicio=json;
        localStorage.setItem('pedido',JSON.stringify(pedido));


        $('#four-tabs').removeClass('disabled');
        $('#register-service :input').attr('disabled', 'disabled');
        $('ul.tabs').tabs();
        $('ul.tabs').tabs("select", "three");





        // $.ajax({
        //     method: "POST",
        //     dataType: "json",
        //     data: {json: json},
        //     url: url+"Pedido/saveServiPedido",
        //     beforeSend: function () {
        //         console.log("Sending data...");
        //     },
        //     success: function (data) {
        //         swal({
        //             title: "¡Bien hecho!",
        //             text: "Servicios agregados al pedido  con éxito(2/4).",
        //             icon: "success",
        //             button: {
        //                 text: "Aceptar",
        //                 visible: true,
        //                 value: true,
        //                 className: "green",
        //                 closeModal: true
        //             },
        //             timer: 3000
        //         }).then(function () {
        //             $('#four-tabs').removeClass('disabled');
        //             $('#register-service :input').attr('disabled', 'disabled');
        //             $('ul.tabs').tabs();
        //             $('ul.tabs').tabs("select", "three");
        //         });
        //     },
        //     error: function (err) {
        //         console.log(err.responseText);
        //     }
        // });


    });


    $('#cedula_cliente').change(function () {
        console.log(url);
        var cedula_cliente = $('#cedula_cliente').val();
        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                cedula_cliente: cedula_cliente
            },

            url: url+"Pedido/verifyCedula",
            beforeSend: function () {
                $('#cedula_cliente').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response !== null) {
                    swal({
                        title: "¡Bien hecho!",
                        text: "Cliente encontrado con éxito.",
                        icon: "success",
                        timer: 3000
                    });

                    $('#cedula_cliente').val(response.cedula_cliente);
                    $('#nombre_cliente').val(response.nombre_cliente);
                    $('#representante_cliente').val(response.representante_cliente);


                    let pedido=JSON.parse(localStorage.getItem('pedido'));
                    pedido.cedula_cliente=response.cedula_cliente;
                    localStorage.setItem('pedido',JSON.stringify(pedido));


                    $('#cedula_cliente').removeAttr('disabled', '');
                    M.updateTextFields();
                } else {
                    swal({
                        title: "¡Oh no!",
                        text: "Cliente no encontrado,registadolo para comenzar hacer pedidos.",
                        icon: "error",
                        buttons: {
                            confirm: {
                                text: "Registrarlo",
                                value: true,
                                visible: true,
                                className: "red"

                            },
                            cancel: {
                                text: "Mejor no",
                                value: false,
                                visible: true,
                                className: "grey lighten-2"
                            }
                        }

                    }).then(function (registrar) {
                        if (registrar) {
                            location.href = url+"Cliente/create";
                        }


                        let pedido=JSON.parse(localStorage.getItem('pedido'));
                        pedido.cedula_cliente='';
                        localStorage.setItem('pedido',JSON.stringify(pedido));


                        $('#cedula_cliente').val('');
                        $('#nombre_cliente').val('');
                        $('#representante_cliente').val('');
                        $('#cedula_cliente').removeAttr('disabled', '');
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
                $('#cedula_cliente').removeAttr('disabled', '');
            }

        });
    });







    $('#porcentaje').change(function () {
        var porcentaje=0;
        var total=0;
        var porcen=0;
        porcentaje=$(this).val();

        let pedido=JSON.parse(localStorage.getItem('pedido'));



        total=$('#total_pagar_base').val();

        porcen=total*porcentaje/100;

        total=porcen+ parseInt(total);
        $('#total_pagar').val(total);


    });


    $('#form-pedido').submit(function (e) {
        e.preventDefault();

        var status_pedido = 'En proceso';
        var fecha_entrega_pedido = $('#fecha_entrega_pedido').val();
        var descripcion_pedido = $('#descripcion_pedido').val();


       let data=validationInput('validate-input');


       if(!data){
           let pedido=JSON.parse(localStorage.getItem('pedido'));
           pedido.status_pedido=status_pedido;
           pedido.fecha_entrega_pedido=fecha_entrega_pedido;
           pedido.descripcion_pedido=descripcion_pedido;
           localStorage.setItem('pedido',JSON.stringify(pedido));
                       $('#form-consul-client :input').attr('disabled', 'disabled');
                       $('#form-pedido :input').attr('disabled', 'disabled');
                       $('#two-tabs').removeClass('disabled');
                       $('#three-tabs').removeClass('disabled');
                       $('ul.tabs').tabs();
                       $('ul.tabs').tabs("select", "two");
       }
    });



    $('.four').click(function () {
        //servicio
        var total_service=0;

        var cont=0;
        var temp=1;
        //material
        var total_producto=0;



        $('#services').find('input').each(function () {
            temp=temp*$(this).val();
            cont++;

            if(cont===3){
                total_service+=temp;
                cont=0;
                temp=1;
            }
        });


        $('#register-product').find('input.calc').each(function () {
            temp=temp*$(this).val();
            cont++;
            if(cont===2){
                total_producto+=temp;
                cont=0;
                temp=1;
            }


        });



        $('#total_servicios').val(total_service);
        $('#total_producto').val(total_producto);
        $('#total_pagar').val(total_producto+total_service);
        $('#total_pagar_base').val(total_producto+total_service);

        M.updateTextFields();
    });


    $("#product-select").select({
        placeholder: "Select an option",
        allowClear: true,
    });





    $("#add-product").click(function (){
        let search= $('#product-select').val();

        let tallas=$("#product-select option:selected").attr("data-tallas");

        if(search!==null) {


            $.ajax({
                method: "POST",
                dataType: "json",
                url: url + "Pedido/productosFind",
                data:{
                    codigo_producto:search,
                    talla:tallas
                },
                beforeSend: function () {

                },
                success: function (response) {
                      let pedido=JSON.parse(localStorage.getItem('pedido'));
                      let product=pedido.productos;
                      console.log(product);
                      console.log(response[0]);
                      let productSearch = product.filter(product=> product.codigo_producto === response[0].codigo_producto && response[0].id_talla===product.id_talla);

                      if(productSearch.length<1) {
                          response[0].cant_pro_pedidos = "1";
                          product.push(response[0]);
                          pedido.productos = product;
                          localStorage.setItem('pedido', JSON.stringify(pedido));
                          addProducto(response[0]);
                      }else{
                          swal({
                              title: "Información",
                              text: "Este producto ya se encuentra en el pedido.",
                              icon: "info",
                              button: {
                                  text: "Aceptar",
                                  visible: true,
                                  value: true,
                                  className: "green",
                                  closeModal: true
                              },
                              timer: 3000
                          })
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
        }
    });


    $("#product-select").change(function (){



    });

    $('#search').keydown(function () {
        var search = $(this).val();

        console.log(search);

        if(search!==" "){


        $.ajax({
            method: "GET",
            dataType: "json",
            url: url+"Pedido/productosFind/"+search,
            beforeSend: function () {

            },
            success: function (response) {

                var product = response;
                var product_array = {};


                if(response!==null) {


                    for (var i = 0; i < response.length; i++) {
                        //console.log(countryArray[i].name);
                        product_array[product[i].codigo_producto+'|'+product[i].nombre_producto+'|'+product[i].nombre_talla]= null;
                    }


                    $('input.autocomplete').autocomplete({
                        data: product_array,
                        onAutocomplete: function (val) {
                                console.log(val);
                            var codigo_producto=val.substr(0,1);
                            addProducto(response,codigo_producto);
                            $('#search').val('');
                        }

                    });
                    $('input.autocomplete').click();
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
        }
    });


    $('#register-factura').submit(function (e) {
       e.preventDefault();
       var codigo_pedido=$('#codigo_pedido').val();
       var forma_pago=$('#forma_pago').val();
       var porcentaje=$('#porcentaje').val();


        let pedido=JSON.parse(localStorage.getItem('pedido'));


        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                cedula_cliente: pedido.cedula_cliente,
                fecha_entrega_pedido:pedido.fecha_entrega_pedido,
                descripcion_pedido:pedido.descripcion_pedido,
                productos:pedido.productos,
                servicio:pedido.servicio,
                modo_pago_factura: forma_pago,
                porcentaje_pago_factura:porcentaje,
            },
            url: url+"Pedido/register",
            beforeSend: function () {

                console.log("Sending data...");
            },
            success: function (data) {
                $('#codigo_pedido').val(data);
                swal({
                    title: "¡Bien hecho!",
                    text: "Pedido facturado y registrado con éxito.",
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
                    window.location.href=url+"Pedido/getAll";
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
        });




    });


    $('#register-product').submit(function (e) {
        e.preventDefault();

        let pedido=JSON.parse(localStorage.getItem('pedido'));

        if(pedido.productos.length<1){


            return swal({
                title: "Información",
                text: "Debes agregar al menos un producto para completar esta acción.",
                icon: "info",
                button: {
                    text: "Aceptar",
                    visible: true,
                    value: true,
                    className: "green",
                    closeModal: true
                }
            })



        }

        $('#register-product :input').attr('disabled', 'disabled');
                        $('#four-tabs').removeClass('disabled');
                        $('ul.tabs').tabs();
                        $('ul.tabs').tabs("select", "four");
                    });
    });

    // Actualizar
    $('#update').submit(function (e) {
        e.preventDefault();
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
                        deletePedido();
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
    function deletePedido () {

        swal({
            title: "Eliminar Pedido",
            text: "¿Esta seguro que desea eliminar este Pedido? Si lo hace, no podrá revertir los cambios.",
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
            var url = localStorage.getItem('url');
            if(aceptar){
                var codigo_pedido = $('#codigo_pedido').val();
                $.ajax({
                    method: "GET",
                    dataType: "json",
                    url: url+"Pedido/delete/"+codigo_pedido,
                    beforeSend: function() {
                        console.log("Sending data...");
                    },
                    success: function() {
                        swal({
                            title: "¡Bien hecho!",
                            text: "Se ha eliminado el pedido exitosamente.",
                            icon: "success",
                            button: {
                                text: "Aceptar",
                                visible: true,
                                value: true,
                                className: "green",
                                closeModal: true
                            }
                        }).then(function () {
                            window.location.href=url+"Pedido/getAll";
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




   /**Agregar product**/
    function addProducto(producto) {
                var  texto = ` <tr>
                                       <th><input type="number" name="codigo_prodcuto"  readonly class="col s4 m4 center codigo_producto" value="${producto.codigo_producto}" readonly></th>
                                       <th>${producto.nombre_producto}</th>
                                       <th>${producto.nombre_talla}</th>
                                       <th><input type="number" min="1" name="cant_producto_pedido[]" class="col s4 m4 center cant_product calc" data-talla="${producto.id_talla}" data-code="${producto.codigo_producto}"   value="${producto.cant_pro_pedidos}"></th>
                                       <th><input type="number" name="precio[]" class="col s4 m4 center precio calc"  data-code="${producto.codigo_producto}"  value="${producto.precio_producto}" readonly></th>
                                       <th><button type="button" class="delete-product btn red " data-code="${producto.codigo_producto}" ><i class="icon-delete"></button></th>
                                   </tr>`;
                $('#product-list').append(texto);
                $('.delete-product').click(function () {
                    $(this).parent().parent().text("");

                    let codigo_producto=$(this).attr('data-code');




                    let pedido=JSON.parse(localStorage.getItem('pedido'));
                    let product=pedido.productos;
                    product = product.filter(product => product.codigo_producto !== codigo_producto);
                    pedido.productos=product;
                    localStorage.setItem('pedido',JSON.stringify(pedido));

                });

                   $('.cant_product').change(function (){
                       let codigo_producto=$(this).attr('data-code');
                       let cant_product_pedidos=$(this).val();
                       let talla_id=$(this).attr('data-talla');

                       var url = localStorage.getItem('url');

                       let input=$(this);


                       $.ajax({
                               method: "POST",
                               dataType: "json",
                               data: {
                                   codigo_producto:codigo_producto,
                                   cant_pro_pedidos:cant_product_pedidos,
                                   id_talla:talla_id,
                                   },
                               url: url+"Pedido/checkStock",
                               beforeSend: function () {
                                   console.log("Sending data...");
                               },
                               success: function (data) {
                                   if(data.status==="error"){
                                       input.val(cant_product_pedidos-1);



                                       return swal({
                                           title: "Información",
                                           text: data.message,
                                           icon: "info",
                                           button: {
                                               text: "Aceptar",
                                               visible: true,
                                               value: true,
                                               className: "green",
                                               closeModal: true
                                           }
                                       })

                                   }


                                   let pedido=JSON.parse(localStorage.getItem('pedido'));
                                   let product=pedido.productos;
                                   var foundIndex = product.findIndex(product => product.codigo_producto === codigo_producto);
                                   product[foundIndex].cant_product_pedidos = cant_product_pedidos;
                                   pedido.productos=product;
                                   localStorage.setItem('pedido',JSON.stringify(pedido));


                               },
                               error: function (err) {
                                   console.log(err.responseText);
                               }
                       });




                   });

    }




    $('#form-pedido-details').submit(function (e) {
        e.preventDefault();
        swal({
            title: "Actualizar Pedido",
            text: "¿Esta seguro que desea actualizar este Pedido? Si lo hace, no podrá revertir los cambios.",
            icon: "warning",
            buttons: {
                confirm: {
                    text: "Actualizar",
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
            if (aceptar) {
                $('#form-pedido-details')[0].submit();
            }


        })
    });



    if($('#pedidos').val()!==undefined){
        $('#pedidos').DataTable({
            "responsive": true,
            "scrollX": true,
            "pageLength": 10,
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "No hay pedidos registrados",
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

    $('#facturaPedidos').DataTable({
        "responsive": true,
        "scrollX": true,
        "pageLength": 10,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "No hay pedidos registrados",
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
