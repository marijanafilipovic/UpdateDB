<?php

/**
 * Created by PhpStorm.
 * User: Marijana
 * Date: 5/10/2017
 * Time: 11:01 PM
 */
class startApp
{
public function __construct(){

    $bootstrap = new Bootstrap($_GET);
    $controller = $bootstrap->createController();
    if($controller){
        $controller->executeAction();

    }

    $trade = new Trade();
    $trade->zipUp();
  /*  $trade->unZip();
    $trade->update();*/

$change= new Service();
//$change->update();
}
}