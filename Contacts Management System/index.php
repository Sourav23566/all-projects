<?php session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fetch All Data</title>
  <?php include("./assets/plugins.php");?>
</head>
<body>
  <?php include('./assets/nav.php');?>
  <?php
  if(!empty($_SESSION['message'])){
    if($_SESSION['message'] == 'delete_success'){
      echo "<div class='alert alert-success'>delete Successfully Done</div>";
    }
    else if($_SESSION['message'] == 'delete_error'){
      echo "<div class='alert alert-success'>Unable To Delete</div>";
    }
    unset($_SESSION['message']);
  }
  ?>
  <div class="container-fluid">
  
    <header class="modal-header">
    <h1>All Records:</h1>
    </header>
    <button  class="btn btn-primary my-2"><a href="signup.php" style="text-decoration: none;" class="text-light">Add User</a></button>
    <div class="card p-1 m-1">
      <div class="table table-striped">
   <table class="table table-hover">
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>phone</th>
      <th>Educational Qualification</th>
      <th>Language Known</th>
      <th>Profile Pic</th>
      <th>created</th>
    </tr>
    
  <?php
  require_once("./db.php");
 $con= new mysqli(HOST,USER,PASS,DB);
   if($con->connect_error)die($con->connect_error);
   else{
    // echo "connected";
    $isAdmin=($_SESSION['ROLE']=='admin')? true : false;
    if($isAdmin){
    $sql="select * from users";
    }else{
       $sql="select * from users where user_id='".$_SESSION['USER_ID']."'";
    }
    $stmt=$con->prepare($sql);
    $stmt->execute();
    $resultset=$stmt->get_result();
    while($rows=$resultset->fetch_assoc()){
    //  print "<pre>";
    //   print_r($rows);
    ?>
     <tr>
      <td><a class="btn btn-dark" href="view?uid=<?php echo $rows['user_id'];?>">View</a></td>
      <td><?php echo $rows['name'];?></td>
      <td><?php echo $rows['email'];?></td>
      <td><?php echo $rows['mobile'];?></td>
      <td><?php echo $rows['education'];?></td>
      <td><?php echo $rows['language'];?></td>
     <td><img src="<?php echo $rows['profile_pic'];?>" height="100px" width="100px" class="img-thumbnail" title="<?php echo $rows['name']?>'s Image"/></td>
      <td><?php echo date('d-m-y h:i:sA',strtotime($rows['created'])) ;?></td>
    </tr>



  <?php
    }
    
    // prepare statement close
    $stmt->close();
     // close the database conection
     $con->close();
   }
  
  
 
   
  ?>
    </table>
    </div>
    </div>
    </div>
</body>
</html>