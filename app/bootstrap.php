<?php

//Cargar la configuracion
require_once 'config/config.php';
//Cargar Helper functions
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';
//Cargar librerias
// require_once 'libraries/Core.php';
// require_once 'libraries/Controller.php';
// require_once 'libraries/Database.php';

//Autoload Librerias del Core
spl_autoload_register(function($className){
    require_once 'libraries/'.$className. '.php';
});

//Composer autoload
//require_once "../vendor/autoload.php";