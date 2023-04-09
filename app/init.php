<?php

//Se encarga de iniciar los o recibir la data de app hacia public

//cargar las librerias
require_once 'config/config.php';


/* require_once 'libraries/Database.php';
require_once 'libraries/Controller.php';
require_once 'libraries/Core.php'; */

//Autoload -> carga de las clases de libraries

spl_autoload_register(function($className){
    require_once 'libraries/'.$className.'.php';
});