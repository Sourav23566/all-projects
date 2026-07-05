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
  <?php include('./assets/nav.php');?>
   
      <?php  if(!empty($_SESSION['message'])){
             if($_SESSION['message']=="task_update_success"){
                  echo "<div class='alert alert-info'>One Task Updated.</div>";
             }else if($_SESSION['message']=="task_update_error"){
                  echo "<div class='alert alert-danger'>Unbale to Update</div>"; 
             }
             unset($_SESSION['message']);
      } ?>
    <?php 
       $taskId = !(empty($_GET['tid'])) ? $_GET['tid'] : null;
  if ($taskId) {
    include_once("db.php");
    $con = new MYSQLi(HOST, USER, PASS, DB);
    if ($con->connect_error)
      die($con->connect_error);
    else {
      // echo "Connected";
      $SQL = "select * from tasks where task_id=?";
      $stmt = $con->prepare($SQL);
      $stmt->bind_param("s", $taskId);
      $stmt->execute();
      $resultSet = $stmt->get_result();
      $className="";
      if ($rows = $resultSet->fetch_assoc()) {
          
           if($rows['status'] =="Pending"){
            $className="badge-warning";
            }else if($rows['status'] =="Rejected"){
              $className="badge-danger";

            }else if($rows['status'] =="Completed"){
              $className="badge-success";

            }
            ?>
             <div class="container">
              <header class="modal-header">
            <h4>Showing the details of <?php echo $rows['title'];?>:</h4>
        </header>
      
              <div class="card p-3 m-3">
                <form method="POST" action="update_task">
            <p class="form-group">Title : <input type="text" name="editTitle" value="<?php echo $rows['title'];?>" class="form-control"></p>
            <p class="form-group">Descrition: <textarea name="editDesc" id="editDesc" cols="30" rows="10" class="form-control"><?php echo $rows['description'];?></textarea></p>
            <p class="form-group">Status :
            <select name="editStatus" class="form-control" required>
                <option value="">---Choose a Status ---</option>
                <option <?php if($rows['status'] =="Pending") echo "selected"; ?>>Pending</option>
                <option <?php if($rows['status'] =="Rejected") echo "selected"; ?>>Rejected</option>
                <option <?php if($rows['status'] =="Completed") echo "selected"; ?>>Completed</option>

            </select>    
           </p>
           <!--capturing taskid into the hidden field -->
           <input type="hidden" name="h_task_id" value="<?php echo $rows['task_id']; ?>"> 
            <p class="form-group">Created:<?php echo  date("d-m-y h:i:sA",strtotime($rows['created']));?></p>
            <button class="btn btn-sm btn-outline-primary">UPDATE</button> |
            <a  class="btn btn-sm btn-outline-dark" onclick="return confirm('Do You want to Delete This Task ?');" href="task_delete?tid=<?php echo $rows['task_id'];?>">DELETE</a> | 
            <a href="task" class="btn btn-sm btn-outline-danger">Back</a>
           </form>
        </div>
            <?php
           }
          
        }
        
        }
  
    ?>
      
      </div>
</body>
</html>