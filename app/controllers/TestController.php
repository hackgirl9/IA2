<?php

include  "Helpers/StreamSteganography.php";
require_once "vendor/autoload.php";


class TestController extends BaseController {

    public function __construct() {
        parent::__construct();
    }


    public function test(){
        $this->view('Test/register');
    }
    public function save(){


    }






}
