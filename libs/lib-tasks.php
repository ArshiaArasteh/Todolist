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

// function for tasks

function getTask(){
    global $pdo;
    $CurrentUserId = getCurrentUserId();
    $folderCondition = "";
    if (isset($_GET['folder_id']) && is_numeric($_GET["folder_id"])) {
        $folder = $_GET["folder_id"];
        $folderCondition = "and folder_id=$folder";
    }
    $sql = "SELECT * FROM tasks WHERE user_id = :user_id $folderCondition";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":user_id" => $CurrentUserId]);
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}

function deleteTask(){
    global $pdo;
    $delete_task = $_GET["delete_task"];
    $currentUserId = getCurrentUserId();
    $sql = "DELETE FROM tasks WHERE user_id = :user_id and id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":user_id" => $currentUserId, ":id" => $delete_task]);
    $stmt->rowCount();
}

function addTask($taskName,$folderId){
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "INSERT INTO tasks (title,folder_id,user_id) VALUES (:title,:folder_id,:user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":title" => $taskName ,":folder_id" => $folderId, ":user_id" => $currentUserId]);
    return $stmt->rowCount();
}

function isDone($taskId){
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "UPDATE tasks SET is_done = 1-is_done WHERE user_id = :user_id and id = :taskId";
    $stmt = $pdo->prepare($sql);
$stmt->execute([":user_id" => $currentUserId,":taskId" => $taskId]);
    return $stmt->rowCount();
}