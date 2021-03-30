<header>
    <nav class="black">
        <div class="nav-wrapper container-fluid">
            <a href="" class="brand-logo"><img src="<?php echo BASE_URL ?>/assets/images/brand-logo.jpg" alt="" class="responsive-logo"></a>
            <!-- Sidenav trigger -->
            <a href="#" data-target="sidenav-menu" class="sidenav-trigger"><i class="icon-menu"></i></a>
            <!-- Navbar menu -->
            <ul id="nav-movile" class="right hide-on-med-and-down">
                <li><a href="<?php echo Helpers::url('Home','index'); ?>"><i class="icon-home"></i></a></li>
                <li><a href="<?php echo Helpers::url('Notificacion','index'); ?>"><i class="icon-notifications"></i></a></li>
                <!-- User drowpdown trigger -->
                <li>
                    <a href="#" class="dropdown-trigger avatar-trigger" data-target="user-dropdown">
                        <i class="icon-arrow_drop_down right"></i>
						<img src="<?php echo BASE_URL ?>assets/images/user-white.svg" alt="" class="avatar">
                    </a>
                </li>
                <!-- User dropdown trigger -->
                <ul class="dropdown-content" id="user-dropdown">
		        	<!-- <li><a href="<?php //echo Helpers::url('Home','account'); ?>"><i class="icon-account_box"></i>Cuenta</a></li>
		        	<li><a href="<?php// echo Helpers::url('Home','settings'); ?>"><i class="icon-settings"></i>Configuración</a></li> -->		        	
		        	<li><a href="<?php echo Helpers::url('Auth','logout'); ?>"><i class="icon-exit_to_app"></i>Cerrar Sesión</a></li>
		        </ul>
            </ul>
        </div>
        <!-- Sidenav menu -->
        <ul class="sidenav sidenav-fixed show-on-large grey-text text-darken-2" id="sidenav-menu">
            <li><a href="" class="logo-container">IA2</a></li>
            <li><a href="<?php echo Helpers::url('Auth','profile'); ?>/<?php echo $_SESSION['user']->nick_usuario; ?>" class="waves-effect waves-black"><i class="icon-person left"></i><?php echo $_SESSION['user']->nick_usuario; ?></a></li>
            <li class="divider"></li>
            <li class="hide-on-large-only"><a href="<?php echo Helpers::url('Home','index'); ?>" class="waves-effect waves-black"><i class="icon-home left"></i>Inicio</a></li>
            <li class="hide-on-large-only"><a href="<?php echo Helpers::url('Home','account'); ?>"><i class="icon-account_box"></i> Cuenta</a></li>
            <li class="hide-on-large-only"><a href="<?php echo Helpers::url('Notificacion','index'); ?>"><i class="icon-notifications"></i>Notificaciones</a></li>
            <li class="hide-on-large-only"><a href="<?php echo Helpers::url('Home','settings'); ?>"><i class="icon-settings"></i>Configuración</a></li>
            <li class="hide-on-large-only"><a href="<?php echo Helpers::url('Auth','logout'); ?>"><i class="icon-exit_to_app"></i>Cerrar Sesión</a></li>
            <li class="divider hide-on-large-only"></li>
            <li><a href="#!" class="subheader"><i class="icon-dashboard left"></i>Módulos:</a></li>
            <?php if (Helpers::hasPermissions('2')): ?>
            <li><a href="<?php echo Helpers::url('Producto','index'); ?>"><i class="icon-loyalty left"></i>Gestionar Productos</a></li>
            <?php endif; ?>
            <?php if (Helpers::hasPermissions('4')): ?>
            <li><a href="<?php echo Helpers::url('Cliente','index'); ?>"><i class="icon-contact_phone left"></i>Gestionar Clientes</a></li>
            <?php endif; ?>

            <?php if (Helpers::hasPermissions('3')): ?>
            <li><a href="<?php echo Helpers::url('Pedido','index'); ?>"><i class="icon-library_books left"></i>Gestionar Pedidos</a></li>
            <?php endif; ?>

            <?php if (Helpers::hasPermissions('6')): ?>
            <li><a href="<?php echo Helpers::url('Factura','index'); ?>"><i class="icon-event_available left"></i>Facturación de Ventas</a></li>
            <?php endif; ?>
            <?php if (Helpers::hasPermissions('5') || Helpers::hasPermissions('8') || Helpers::hasPermissions('9')): ?>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li class="bold">
                        <div class="collapsible-header">
                            <i class="icon-build left" style="margin-left:15px;"></i>Configuración<i class="icon-arrow_drop_down right" style="margin-left:50px;"></i>
                        </div>
                        <div class="collapsible-body">
                            <ul>
                                <?php if (Helpers::hasPermissions('5')): ?>
                                <li><a href="<?php echo Helpers::url('Servicio','index'); ?>"><i class="icon-star left"></i>Gestionar Servicios</a></li>
                                <?php endif; ?>

                                <?php if (Helpers::hasPermissions('8')): ?>
                                <li><a href="<?php echo Helpers::url('Tela','index'); ?>"><i class="icon-layers left"></i>Gestionar Telas</a></li>
                                <?php endif; ?>

                                <?php if (Helpers::hasPermissions('9')): ?>
                                <li><a href="<?php echo Helpers::url('Material','index'); ?>"><i class="icon-streetview left"></i>Gestionar Materiales</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <?php endif ?>

            <?php if (Helpers::hasPermissions('7')): ?>
            <li><a href="<?php echo Helpers::url('Reporte','Reporteindex'); ?>"><i class="icon-report left"></i>Gestionar Reportes</a></li>
            <?php endif; ?>
            <li class="divider"></li>
            <?php if (Helpers::hasPermissions('1')): ?>
            <li><a href="<?php echo Helpers::url('Usuario','index'); ?>"><i class="icon-group_add left"></i>Gestionar Usuarios</a></li>
            <?php endif; ?>

            <?php if (Helpers::hasPermissions('11')): ?>
            <li><a href="<?php echo Helpers::url('Seguridad','index'); ?>"><i class="icon-security left"></i>Seguridad</a></li>
            <?php endif; ?>


            <!-- <?php // if (Helpers::hasPermissions('12')): ?>
            <li><a href="<?php //echo Helpers::url('Mantenimiento','index'); ?>"><i class="icon-perm_data_setting left"></i>Mantenimiento</a></li>
            <?php// endif; ?> -->
            <!-- <li><a href=""><i class="icon-event_available left"></i></a></li> -->
        </ul>
    </nav>
</header>