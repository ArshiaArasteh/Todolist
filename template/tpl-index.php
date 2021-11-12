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
    <div class="userPanel"><i class="fa fa-chevron-down"></i><span class="username">John Doe </span><img src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/73.jpg" width="40" height="40"/></div>
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

            <li class="<?= ($_GET['folder_id'] == $folder->id) ? 'active' : '' ?>">
              <a href="<?= site_url("?folder_id=$folder->id")?>"> <i class="fa fa-folder"></i><?= $folder->folder_name ?></a>
              <a class="remove" href="?delete_folder=<?=$folder->id?>" onclick="return confirm('Are You Sure To Delete This Folder?');"><i class="fa fa-trash-o"></i></a>
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
        <div class="title">Manage Tasks</div>
        <div class="functions">
          <div class="button active">Add New Task</div>
          <div class="button">Completed</div>
          <div class="button inverz"><i class="fa fa-trash-o"></i></div>
        </div>
      </div>
      <div class="content">
        <div class="list">
          <div class="title">Today</div>
          <ul>
            <li class="checked"><i class="fa fa-check-square-o"></i><span>Update team page</span>
              <div class="info">
                <div class="button green">In progress</div><span>Complete by 25/04/2014</span>
              </div>
            </li>
            <li><i class="fa fa-square-o"></i><span>Design a new logo</span>
              <div class="info">
                <div class="button">Pending</div><span>Complete by 10/04/2014</span>
              </div>
            </li>
            <li><i class="fa fa-square-o"></i><span>Find a front end developer</span>
              <div class="info"></div>
            </li>
          </ul>
        </div>
        <div class="list">
          <div class="title">Tomorrow</div>
          <ul>
            <li><i class="fa fa-square-o"></i><span>Find front end developer</span>
              <div class="info"></div>
            </li>
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
  });

  </script>

</body>
</html>
