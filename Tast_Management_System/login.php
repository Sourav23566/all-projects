<?php
session_start();
function rediract($loc){
  echo "<script>window.location.href='$loc'; </script> ";
  
}
// print_r($_POST);
$email=$_POST['em1'];
$password=$_POST['pass3'];

// db connction
require_once("db.php");
$con=new mysqli(HOST,USER,PASS,DB);
if($con->connect_error) die($con->connect_error);
else{
  // echo "connected";
  $sql="select user_id,name,profile_pic,pass1,role from users where email=?";
  $stmt=$con->prepare($sql);
  $stmt->bind_param('s',$email);
  $stmt->execute();
  $resultset=$stmt->get_result();
   $stmt->close();
  $con->close();
  if($rows=$resultset->fetch_assoc()){
    // print"<pre>";
    // print_r($rows);
    $db_pass=$rows['pass1'];
    // die($db_pass);
    $ismatch= password_verify($password,$db_pass) ? true : false;
    if($ismatch){
    //   die($rows['profile_pic']);
    // }}}
        // echo "login success";
        $_SESSION['USER_ID']=$rows['user_id'];
        $_SESSION['ROLE']=$rows['role'];
        $_SESSION['PIC']=$rows['profile_pic'];
        $_SESSION['USER']=$rows['name'];
        $_SESSION['ID']=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/kolkata');
        $_SESSION['LOGIN_TIME']=date('d-m-y h:i:sA');
        rediract('task.php');

    }else{
      // echo "Invalid user name or password";
      $_SESSION['message']="Wrong_credentials";
      rediract('signin');
    }
  }else{
    // echo "User dosenot exists ";
    $_SESSION['message']="user_not_exists";
    rediract('signin');
  }
 
}
?>