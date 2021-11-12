<?php

include "../config/init.php";

if(!isAjaxRequest()){
  diePage("invalid Request");
}

if(!isset($_POST["action"]) && empty($_POST["action"])){
  diePage("Invalid action");
}

switch ($_POST["action"]) {
  case 'addFolder':
    $folderName = $_POST["name"];
    if (!isset($folderName) || strlen($folderName) <= 2) {
      echo "folder name must have more than 2 charactors";
      die();
    }
    echo addFolder($folderName);
    break;
  
  default:
      diePage("invalid action");

}