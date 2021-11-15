<?php

function isLoggedIn(){
    return 0;
}

function Register($userData){
    global $pdo;
    $username = $userData["Username"];
    if (!preg_match('/^[a-zA-Z0-9][_]{1}[a-zA-Z0-9]+$/', $username) && strlen($username) <= 2) {
        diePage("invalid username");
    }
    $email = $userData["email"];
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        diePage("invalid email");
        
    }
    $pass = password_hash($userData["Password"],PASSWORD_DEFAULT);
    if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $pass) && strlen($pass) <= 6) {
        diePage("invalid password");
    }
    $sql = "INSERT INTO `users` (username,email,password) VALUES (:username,:email,:password);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":username" => $userData["Username"],":email" => $userData["email"], ":password" => $pass]);
    return $stmt->rowCount() ? true : false;
}