<?php

include "config/init.php";


if(isset($_GET["delete_folder"]) && is_numeric($_GET["delete_folder"])){
    echo deleteFolder();
}

$folders = getFolder();
include "template/tpl-index.php";
