<?php

include "config/init.php";


if(isset($_GET["delete_folder"]) && is_numeric($_GET["delete_folder"])){
    echo deleteFolder();
}

if (isset($_GET['delete_task']) && is_numeric($_GET['delete_task'])) {
    echo deleteTask();
}

$folders = getFolder();
$tasks = getTask();

include "template/tpl-index.php";
