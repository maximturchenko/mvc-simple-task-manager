<?php

require_once  __DIR__ ."\autoload.php";


use app\core\Router;



session_start();  


$router = new Router();
$router->run();
  
