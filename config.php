<?php


define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "akcije");


define("ROOT_PATH", "/Stock/");
define("ROOT_URL", "http://localhost:81/Stock/");


spl_autoload_register(function ($class) {
    $pathControllers = 'controllers/' . $class . '.php';
    $pathModels = 'models/' . $class . '.php';
   $pathClasses = 'classes/' . $class . '.php';
    if (file_exists($pathControllers)){
        require_once $pathControllers;
    }elseif(file_exists($pathClasses)){
        require_once $pathClasses;
    }elseif(file_exists($pathModels)){
        require_once $pathModels;
    }
    });

?>
