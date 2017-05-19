<?php

/**
 * Initial class for MVC model 
 * and exucting scriptss service
 * refeshed from header
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

    // get Data from Db and process to xml data set
       $trade = new Trade();
    
    // set xml data set to the ZIPed file
    $trade->zipUp();
  
    // unZip file gets xml data and randomly change value
    $change= new Service();
 }
}
