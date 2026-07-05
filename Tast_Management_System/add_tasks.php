<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once("./assets/plugins.php"); ?>
</head>
<body>
    <?php include_once("./assets/nav.php"); ?>
     
    
    <?php
       if(!empty($_SESSION['message'])){
          if($_SESSION['message']=="task_add_success"){
            echo "<div class='alert alert-success'>One Task has been added Successfully.<a href='task.php'>View Tasks:</a></div>";
          }else if ($_SESSION['message']=="task_add_error"){
            echo "<div class='alert alert-danger'>Unable to add Task right Now</div>";
          }
          unset($_SESSION['message']);
       }
    ?>
      <div class="container">
    <header class="modal-header">
            <h4>Add Task :</h4>
        </header>
        <form method="POST" action="task_submit.php">
        <div class="form-group">Title : <input type="text" name="title" id="title" required class="form-control"></div>
        <div class="form-group">Description : <textarea name="desc" id="desc" cols="30" rows="10" required class="form-control"></textarea></div>
        <div class="form-group">
              Status : <select name="status" class="form-control" required>
                <option>---Choose a Status ----</option>
                <option>Pending</option>
                <option>Rejected</option>
                <option>Completed</option>
              </select>
        </div>
        <div class="form-group">
            <button class="btn btn-sm btn-outline-primary">ADD</button> |
            <button class="btn btn-sm btn-outline-success" type="reset">RESET</button>
        </div>
        </form>
      </div>
</body>
</html>