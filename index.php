<?php
session_start();
require_once 'autoload.php';
require_once 'core/FrontController.php';
require_once 'config/parameters.php';
require_once 'config/modules.php';
require_once 'config/actions.php';
require_once 'core/Helpers.php';
require_once 'core/BaseModel.php';
require_once 'core/BaseController.php';



$frontController=new FrontController();
if(isset($_GET['controller'])&&!empty($_GET['controller'])){
   if($_GET['controller']!=='Auth'&&!isset($_SESSION['nick_usuario'])){
        $objController=$frontController->loadController('Auth');
    }else {
       $objController = $frontController->loadController($_GET['controller']);
   }
}else{
    $objController=$frontController->loadController(DEFAULT_CONTROLLER);
}
$frontController->setAction($objController);