<?php
session_start();
function getRandom(){
 return rand(1000,9999)."-".time();
}
function rediract($loc){
 echo "<script> window.location.href='$loc'</script>";
 exit;
}
// print "<pre>";
// print_r($_POST);
// print_r($_FILES);
// die();
// $method = $_SERVER['REQUEST_METHOD'];
$userid=$_POST['hid']; 
$imagePath = $_POST['h_image'];
// if($method !=="POST"){
  //   $_SESSION['message2']="update_at_first";
  //   rediract('view.php?uid='.$userid);
  // }
if($_FILES['editAvater']['error'] == 0){
// if(isset($_FILES['editAvater']) && $_FILES['editAvater']['error'] == 0){
  // die("image has been cheanged");
  $est=$_FILES['editAvater']['name'];
  
  $filetype=$_FILES['editAvater']['type'];
  $filesize=$_FILES['editAvater']['size'];
  $filetmp=$_FILES['editAvater']['tmp_name'];
  $allowed=[
        'image/jpeg',
        'image/jpg',
        'image/png',
        'image/gif'
    ];
  if(!in_array($filetype,$allowed)){
      $_SESSION['message1']='invalid_image_error';
                
      rediract('view.php?uid='.$userid);
      }

                if($filesize>=800*1024){
                 $_SESSION['message1']='image_size_error';
                 rediract('view.php?uid='.$userid);
                }
                // echo ("invalid");
                // die();
              
                  $filename=substr(md5($est),0,12).getRandom()."-".$est;
                   $imagePath='./uploads/'.$filename;
                   move_uploaded_file($filetmp,$imagePath);
 }
                  $name      = $_POST['editfname'].' '.$_POST['editlname'];
                  $email     = $_POST['editemail'];
                  $mobile    = $_POST['editmobile'];
                  $education = implode(",",$_POST['ch']);
                  $language  = implode(',',$_POST['lang']);

                  require_once('db.php');
                  $con = new mysqli(HOST,USER,PASS,DB);
                  if($con->connect_error) die($con->connect_error);
                  else{
                  //  echo 'connected';
                   $sql='update users set
                      name=?,
                      email=?,
                      mobile=?,
                      education=?,
                      language=?,
                      profile_pic=?
                      where user_id=?;';
                  $stmt=$con->prepare($sql);
                  $stmt->bind_param("sssssss",$name,$email,$mobile,$education,$language,$imagePath,$userid);
                  $stmt->execute();
                  $rows=$stmt->affected_rows;
                  $message=($rows == 1) ? "update_success":"update_error";
                  $_SESSION['message']=$message;
                  $stmt->close();
                  $con->close();
                  rediract('view.php?uid='.$userid);

                   }


 

?>
