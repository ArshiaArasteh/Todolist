<?php
// function for loggin system
function isLoggedIn(){
    return isset($_SESSION["login"]) ? true : false;
}

function getLoggedInUser(){
    return $_SESSION["login"] ?? null;

}
function getUserByEmail($email){
    global $pdo;
    $sql = "SELECT * FROM  users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":email" => $email]);
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records[0] ?? null;
}
function LOGIN($email,$pass){
    $user = getUserByEmail($email);
    if(is_null($user)){
        return false;
    }
    if(password_verify($pass,$user->password)){
        $_SESSION["login"] = $user;
        $user->image = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $user->email ) ) );
        return true;
    }



    return false;
}

function Logout(){
    unset($_SESSION['login']);
}

// function for signup system
function Register($userData){
    global $pdo;
    $username = $userData["username"];
    if (!preg_match('/^[a-zA-Z0-9][_]{1}[a-zA-Z0-9]+$/', $username) && strlen($username) <= 2) {
        diePage("invalid username");
    }
    $email = $userData["email"];
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        diePage("invalid email");
        
    }
    $pass = password_hash($userData["password"],PASSWORD_DEFAULT);
    if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $pass) && strlen($pass) <= 6) {
        diePage("invalid password");
    }
    $sql = "INSERT INTO `users` (username,email,password) VALUES (:username,:email,:password);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":username" => $userData["username"],":email" => $userData["email"], ":password" => $pass]);
    return $stmt->rowCount() ? true : false;
}