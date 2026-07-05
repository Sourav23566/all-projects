<?php
session_start();
function rediract($loc){
  echo "<script>window.location.href='$loc'</script>";
   exit;
}

$userid=(!empty($_GET['uid']))? $_GET['uid'] : null;
// echo $userid;
require_once('db.php');
$con= new mysqli(HOST,USER,PASS,DB);
if($con->connect_error) die($con->connect_error);
else{
  // echo "connected";
  $sql = "delete from users where user_id=?";
  $stmt = $con->prepare($sql);
  $stmt->bind_param('s',$userid);
  $stmt->execute();
  $rows=$stmt->affected_rows;
  $message=($rows == 1) ? "delete_success":"delete_error";
  $_SESSION['message']=$message;
  rediract('index');
  $stmt->close();
  $con->close();
}
?>