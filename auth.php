<?php

include 'config/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET["action"];
    $params = $_POST;
    if($action == "register"){
        $result = Register($params);
        if(!$result){
            diePage("registeration is incorrect");
        }
       
    }
    // dd($params);

}


include 'template/tpl-auth.php';