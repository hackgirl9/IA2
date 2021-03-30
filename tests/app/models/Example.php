<?php

namespace App\Model; // Asignarle el namespace cada que crees una clase nueva

 class Example{

     protected $original;

     public function __construct($original){

         $this->original= $original;
     }

     public function render (){
         $slug = str_replace(" ", "-", $this->original);
         return strtolower($slug);
     }

 }