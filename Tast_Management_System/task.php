<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tasks</title>
  <?php include_once('./assets/plugins.php');?>
</head>
<body>
    <?php include('./assets/nav.php');?>
     <?php  
          if(!empty($_SESSION['message'])){
              if($_SESSION['message']=="task_delete_success"){
                echo "<div class='alert alert-info'>One Task Deleted.</div>";
              }else if($_SESSION['message']=="delete_error") {
                echo "<div class='alert alert-danger'>Unable to delete</div>";
              }
              unset($_SESSION['message']);
          }
        ?>
  <div class="container">
    <header class="modal-header">
      <h1>Displaying All task</h1>
    </header>
    <button  class="btn btn-primary my-2"><a href="add_tasks.php" style="text-decoration: none;" class="text-light">Add Task</a></button>
     <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Title:</th>
                <th>Description:</th>
                <th>Status:</th>
                <th>Created:</th>
                <th>Added By:</th>
            </tr>

<?php
         include_once("db.php");
         $con = new MYSQLi(HOST,USER,PASS,DB);
    
         if($con->connect_error) die($con->connect_error);
         else {
            // echo "Connected ";
            $isAdmin=($_SESSION['ROLE']=='admin') ? true : false;
            $SQL='';
            if($isAdmin){
               $SQL = "SELECT tasks.*,users.name,users.role from tasks INNER JOIN users on(tasks.user_id=users.user_id)";

            }else{
              $SQL="SELECT tasks.*,users.name,users.role from tasks INNER JOIN users on(tasks.user_id=users.user_id) and users.user_id= '".$_SESSION['USER_ID']."'";
            }
            
             $stmt = $con->prepare($SQL);
            $stmt->execute();
            $resultSet = $stmt->get_result();
            $classname= "";
            while($rows = $resultSet->fetch_assoc()){
           if($rows['status'] =="Pending"){
               
             $className="badge-warning";
            }else if($rows['status'] =="Rejected"){
              $className="badge-danger";

            }else if($rows['status'] =="Completed"){
              $className="badge-success";

            }
               
                  ?>
                  <tr>
                 <td><a class="btn btn-sm btn-outline-dark" href="view_task.php?tid=<?php echo $rows['task_id'];?>">View</a></td>
                 <td><?php echo $rows['title'];?></td>
                 <td><?php echo $rows['description'];?></td>
                 <td> <span class="badge badge-pills <?php echo $className;?>"><?php echo $rows['status'];?></span> </td>
                <td><?php echo date("d-m-y h:i:sA",strtotime($rows['created']));?></td>
                 <td><?php echo $rows['name'];?></td>
                </tr>
     
<?php
         }
           $stmt->close();
            
            $con->close();
         }
         
?>
  </table>
  </div>
</body>
</html>