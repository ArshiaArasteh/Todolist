<?php

include 'config/init.php';
$index = site_url();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET["action"];
    $params = $_POST;
    if($action == "register"){
        $result = Register($params);
        if(!$result){
            diePage("registeration is incorrect");
        }
     
    }
    if ($action == "login") {
       $result = LOGIN($params["email"],$params["password"]);
       if(!$result){
           diePage("Email or Password is incorrect");
       }else{
           header("location:$index");
       }
    }
    
}

include 'template/tpl-auth.php';