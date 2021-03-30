<?php
 use PHPUnit\Framework\TestCase;
 use App\Model\Example; // Puedes llamar a tu modelo sin usar require

 class SlugTest extends TestCase {

     public function test_render(){

        $slug = new Example("Pruebas Laravel");

        $this->assertEquals($slug->render(), "pruebas-laravel");
     }

 }