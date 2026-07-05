<?php
 session_start();
 function redirect($loc){
    echo "<script>
     window.location.href='$loc';
    </script>";
 }

 include("db.php");
  #print_r($_POST);
  #print_r($_SESSION);

  $title = $_POST['editTitle'];
  $desc =  $_POST['editDesc'];
  $status= $_POST['editStatus'];
  $user_id= $_SESSION['USER-ID'];
  $taskId = $_POST['h_task_id'];
   include_once("db.php");
   $con = new MYSQLi(HOST,USER,PASS,DB);
   if($con->connect_error) die($con->connect_error);
   else {
    $SQL ="update tasks set 
                           title=?,
                          description  =?,
                          status=?
                          where task_id=?
    ";
    $stmt= $con->prepare($SQL);
    $stmt->bind_param("ssss",$title, $desc,$status,$taskId);
      $stmt->execute();
   $rows = $stmt->affected_rows;
   
    $message = ($rows ==1) ? "task_update_success" : "task_update_error";
    $_SESSION['message']=$message;
     $stmt->close();
      $con->close();
    redirect("view_task?tid=$taskId");
 }
 
?>