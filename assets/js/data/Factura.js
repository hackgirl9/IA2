$(document).ready(function () {
    var url = localStorage.getItem('url');
	var status_factura = $('#status_factura').val();

	if (status_factura==="Vigente"){

        $('#anular').click(function () {
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
                                anularFactura();
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

	function anularFactura () {
        // Getting form data
        var codigo_factura = $('#codigo_factura').val();
        var status_factura = $('#status_factura').val();


        swal({
            title: "Anular Facura ????",
            text: "¿Esta seguro que desea anular esta factura? Si lo hace, no podrá revertir los cambios.",
            icon: "warning",
            buttons: {
                confirm: {
                    text: "Anular",
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
        }).then(function(terminar){
            $.ajax({
                method: "POST",
                dataType: "json",
                url:url+"Factura/anular",
                data: {
                    codigo_factura: codigo_factura,
                    status_factura: status_factura,
                }
            });
            console.log(terminar);
            if(terminar){
            swal({
                title: "¡Bien hecho!",
                text: "Se ha Anulado la factura " + codigo_factura + " exitosamente.",
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
                location.href = url+"Factura/getAll";
            });
            }
            else{
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
	}
	else{
		$('#anular').on('click',function () {
		 swal({
                title: "¡Uppps!",
                text: "No puedes Anular esta factura " + " Ya ha sido Anulada",
                icon: "warning",
                button: {
                    text: "Aceptar",
                    visible: true,
                    value: true,
                    className: "orange",
                    closeModal: true
                },
                timer: 30000
        });
		});
	}

    $('#Factura').DataTable({
        "responsive": true,
        "scrollX": true,
        "pageLength": 10,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "No hay facturas registradas",
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
