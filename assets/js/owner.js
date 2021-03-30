$(document).ready(function(){
	$('.dropdown-trigger').dropdown({
        coverTrigger: false,
        constrainWidth: false,
        alignment: 'right'
    });

    if (localStorage.getItem('url') === null) {
        localStorage.setItem('url', 'http://localhost/project-IA2/');
        //localStorage.setItem('url', 'http://200.8.18.26:85/');
    }



    $('.sidenav').sidenav();
    $(".collapsible").collapsible();

    $('.fixed-action-btn').floatingActionButton();
    $('.tooltipped').tooltip({
        outDuration: 150
    });
    M.textareaAutoResize($('#descripcion_producto, #descripcion_pedido, #descripcion_cliente, #direccion_cliente , #descripcion_servicio, #descripcion_tela'));

    jQuery('select').formSelect();
    $('.tabs').tabs();
    $('.datepicker').datepicker(
        {'format':'yyyy-mm-dd'}
    );
});
