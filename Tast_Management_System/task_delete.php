<?php
   session_start();
   function redirect($loc){
      echo "<script>
        window.location.href='$loc';
      </script>";
   } 
   $taskId = (!empty($_GET['tid'])) ? $_GET['tid']: null;
   include_once("db.php");
   $con = new MYSQLi(HOST,USER,PASS,DB);
   if($con->connect_error) die($con->connect_error);
   else {
    echo "Connected";
    $SQL="delete from tasks where task_id=?";
    $stmt = $con->prepare($SQL);
    $stmt->bind_param("s",$taskId);
    $stmt->execute();
    $rows =$stmt->affected_rows;
    $message = ($rows == 1) ? "task_delete_success" : "delete_error";
    $_SESSION['message'] = $message;
    redirect("task.php");
    $stmt->close();
    $con->close();


   }
?>