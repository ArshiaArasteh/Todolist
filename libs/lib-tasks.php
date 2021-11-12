<?php

function getCurrentUserId(){
    return 1;
}

function getFolder(){
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "SELECT * FROM folders WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":user_id" => $currentUserId]);
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}

function deleteFolder(){
    $folderId = $_GET["delete_folder"];
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "DELETE FROM folders WHERE user_id = :user_id and  id = :folder_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["user_id" => $currentUserId,"folder_id" => $folderId]);
    $stmt->rowCount();
}

function addFolder($folderName){
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "INSERT INTO folders (folder_name,user_id) VALUES (:folder_name,:user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":folder_name" => $folderName , ":user_id" => $currentUserId]);
    return $stmt->rowCount();
}