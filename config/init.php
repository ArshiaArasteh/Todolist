<?php
session_start();
include "constants.php";
include "config.php";
include BASE_PATH ."libs/helper.php";

$dsn = "mysql:host=$localhost;dbname=$dbname";
try {
    $pdo = new PDO($dsn, $user, $pass);
}catch(PDOException $e){
    diePage($e->getMessage());
}

include BASE_PATH ."libs/lib-tasks.php";
include BASE_PATH ."libs/lib-auth.php";