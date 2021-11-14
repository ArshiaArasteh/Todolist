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
  case "addTask":
    $taskName = $_POST["name"];
    $folderId = $_POST["folderId"];
    if(!isset($taskName) || strlen($taskName) < 3){
      echo "Task Name Must Have More Than 3 charactors";
      die();
    }
    echo addTask($taskName,$folderId);
    break;
    
    case "doneSwitch":
      $taskId = $_POST["taskId"];
      if(!isset($taskId) && !is_numeric($taskId)){
        echo "invalid task id";
      }
      echo isDone($taskId);
      break;
      
  default:
      diePage("invalid action");
}