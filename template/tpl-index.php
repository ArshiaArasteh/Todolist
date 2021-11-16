<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Task Manager</title>
  <link rel="stylesheet" href="<?= BASE_URL?>assets/css/style.css">
</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="pageHeader">
    <div class="title">User Panel</div>
    <div class="userPanel">
      <a href="<?= site_url("?logout=1")?>"><i class="fa fa-sign-out"></i></a>
      <span class="username"><?= $loginUser->username ?? "Unknown" ?></span>
    <img src="<?= $loginUser->image ?>" width="40" height="40"/></div>
  </div>
  <div class="main">
    <div class="nav">
      <div class="searchbox">
        <div><i class="fa fa-search"></i>
          <input type="search" placeholder="Search"/>
        </div>
      </div>
      <div class="menu">
        <div class="title">Folders</div>
        <ul class="folder-list">
        
        <li class= "<?= isset($_GET['folder_id']) ? '' : 'active' ?>"><a href = "<?= site_url() ?>"><i class="fa fa-folder"></i>All</li></a>
         
          <?php foreach ($folders as $folder): ?>
           
            <li class="<?= isset($_GET['folder_id']) == $folder->id ? 'active' : '' ?>">
              <a href="<?= site_url("?folder_id=$folder->id")?>"> <i class="fa fa-folder"></i><?= $folder->folder_name ?></a>
              <a class="remove" href="?delete_folder=<?=$folder->id?>" onclick="return confirm('Are You Sure To Delete This Folder?\n<?= $folder->folder_name ?>');"><i class="fa fa-trash-o"></i></a>
            </li>
            <?php endforeach; ?>

        </ul>
        <div>
          <input type="text" placeholder="Add New Folder" id="AddFolderInput" name="addFolder">
          <button id="AddFolderBtn" class="btn">+</button>
        </div>
      </div>
    </div>
    <div class="view">
      <div class="viewHeader">
        <div class="title">
          <input type="text" placeholder="Add New Task" id="addTaskInput">
        </div>
       
      </div>
      <div class="content">
        <div class="list">
          <div class="title">Today</div>
          <ul>
            
            <?php if (sizeof($tasks) > 0): ?>
           <?php foreach ($tasks as $task): ?>
            <li class="<?= $task->is_done ? 'checked' : '' ?>">
            <i data-taskId="<?= $task->id ?>" class="isDone fa <?= $task->is_done ? 'fa-check-square-o' : 'fa-square-o' ?>"></i>
            <span><?= $task->title ?> </span> 
            <div class="info">
              <span>created at <?= $task->created_at ?></span>
              <a href="<?= site_url("?delete_task=$task->id") ?>" class="remove" onclick="return confirm('Are You Sure To Delete This Task\n<?= $task->title?>');">
              <i class="fa fa-trash-o"></i></a>
              </div>
            </li>
            <?php endforeach; ?>
            <?php else: echo "<li>No Task Here...</li>";?>
            <?php  endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script  src="<?=BASE_URL?>assets/js/script.js"></script>
  <script>

$(document).ready(function(){
  // ajax for addFolder here
    $("#AddFolderBtn").click(function(){
      var Input = $("#AddFolderInput");
      $.ajax({
        url : "procces/ajaxHandler.php",
        method : "post",
        dataType : "text",
        data : {action : "addFolder" , name : Input.val()},
        success : function(response){
          if(response == "1"){
            $('<a  href="#" style=" text-decoration: none; color: #107797;"><i class="fa fa-folder"></i></a>').appendTo("ul.folder-list");
          location.reload();
          }else{
            alert(response);
          }
        
        }
       
      });
    });

    // ajax for addTAsk here
    $("#addTaskInput").keypress(function(e){
      var taskInput = $("#addTaskInput");
      if(e.which == 13){
        $.ajax({
          url : 'procces/ajaxHandler.php',
          method : "post",
          data : {action : 'addTask' , folderId : <?= $folder->id?> , name : taskInput.val()},
          success : function(response){
            if(response == "1"){
            location.reload();
          }
          else{
            alert(response);
          }}
          
        });
      }
    });

    $("i.isDone").click(function(){
      var tid = $(this).attr("data-taskId");
      $.ajax({
        url : "procces/ajaxHandler.php",
        method : "post",
        data : {action : 'doneSwitch' , taskId : tid},
        success : function(response){
          location.reload();
        }
      });
    });
  });

  </script>

</body>
</html>
