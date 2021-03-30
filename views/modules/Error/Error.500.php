<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/materialize.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/material-gradient.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/material-components.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/icons/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/owner.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/errors.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/animate.min.css">
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>assets/images/logo-trasparente.png">
    <title>Error 404 - Inversiones A2</title>
</head>
<body class="grey">
    <!-- Main Container -->
    <div>
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div class="browser-window">
                        <div class="window-bar">
                            <div class="circles">
                                <div class="circle red"></div>
                                <div class="circle yellow"></div>
                                <div class="circle green"></div>
                            </div>
                        </div>
                        <div class="window-content blue">
                            <div class="row">
                                <div class="navigation-bar black">
                                    <span class="text-short">INTERNAL SERVER ERROR</span>
                                </div>
                                <div class="col s12 center-align">
                                    <h1 class="text-long">500</h1>
                                </div>  
                                <div class="col s12 center-align">
                                    <span class="text-low">Algo ha ido mal. Intentalo más tarde.</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 center-align">
                                    <button id="back" class="btn btn-large btn-rounded waves-effect waves-light pink">Regresar</button>
                                    <!-- <button id="home" class="btn btn-large btn-rounded waves-effect waves-light indigo">Inicio</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.2.1.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/materialize.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/sweetalert.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/error.js"></script>
</body>
</html>