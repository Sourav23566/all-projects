<?php
session_start();
function getRandom(){
 return rand(1000,9999)."-".time();
}
function generateUserId(){
  return "user-".getRandom();
}
function redirect($loc){
  echo "<script>
   window.location.href='$loc';
   </script>
  ";
}
function validate(){
  global $errors;
  global $fileType,$filesize;
  $isvalid= true;
   // No file selected
   if(empty($_POST['first'])){
  $errors['first']='FirstName is required';
  $isvalid= false;
}else if(!preg_match('/^[A-Za-z ]{3,15}$/',$_POST['fname'])){
 $errors['first']="FirstName must be min 3 to max 15 chars , doesnot allow numbers";
 $isvalid= false;
}
   if($_FILES['avater']['error'] == 4){
      $errors['avater'] = "please select an image";
      $isvalid = false;
  } // Any other upload error
  else if($_FILES['avater']['errors'] !=0){
    $errors['avater']="please select an image";
    $isvalid= false;

  }else if(!($fileType == 'image/jpg'
          || $fileType == 'image/jpeg'
          || $fileType == 'image/png'
          || $fileType == 'image/gif')){
             $errors['avater']='Only Image accepted';
             $isvalid = false;
  }else if(!($filesize <=(1000*1024))){
    //die("Image is too large to upload");
            $errors['avater']='Image is too large to upload max allowed limit is 800KB';
          $isvalid =false;
  }
  return $isvalid;
}


$method = $_SERVER['REQUEST_METHOD'];
$ext=$_FILES['avater']['name'];
$filename=substr(md5($ext),0,12).getRandom().$ext;
$fileType=$_FILES['avater']['type'];
$filesize=$_FILES['avater']['size'];
$fileTmpName=$_FILES['avater']['tmp_name'];
$picDesti="./uploads/";
$imagePath=$picDesti.$filename;
if($method=="POST"){
  // print_r($_POST);
if(validate()){
$user_id= generateUserId();
$name= $_POST['first']." ".$_POST['last'];
$email= $_POST['em1'];
$mobile= $_POST['mb1'];
$language=implode(",",$_POST['lang']);
$education=implode(",",$_POST['ch']);
$pass= $_POST['pass1'];
$hashpass =password_hash($pass,PASSWORD_BCRYPT);
move_uploaded_file($fileTmpName,$imagePath);
//insert to the db
require_once('./db.php');
$con= new mysqli(HOST,USER,PASS,DB);
if($con->connect_error) die($con->connect_error);
else{
  // echo "connected";
  $sql="insert into users(user_id,name,email,mobile,pass1,education,language,profile_pic) values(?,?,?,?,?,?,?,?)";
  $stmt = $con->prepare($sql);
  $stmt->bind_param('ssssssss',$user_id,$name,$email,$mobile,$hashpass,$education,$language,$imagePath);
  $stmt->execute();
  $rows=$stmt->affected_rows;
  $message =($rows == 1) ? "singup_success" : "signup_error";
  // echo $massage;
  $_SESSION['message']=$message;



  $stmt-> close();
  $con -> close();
  redirect("signup.php");
}
}else{
  $_SESSION['errors']=$errors;
  redirect("signup.php");
}

}else{
  redirect("signup.php");
}


?>