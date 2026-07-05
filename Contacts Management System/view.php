<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Getting Perticular record from the Database </title>
  <?php include("./assets/plugins.php");?>
</head>
<body>
 
<?php include('./assets/nav.php');?>
<?php

if(!empty($_SESSION['message'])){
  if($_SESSION['message'] == 'update_success'){
    echo "<div class='alert alert-success'>Updated Successfully</div>";
  }else if($_SESSION['message'] == 'update_error'){
   echo "<div class='alert alert-danger'>unable to Update</div>";
  }
  unset($_SESSION['message']);
}
?>

  <?php
  if(!empty($_SESSION['message1'])){
  if($_SESSION['message1'] == 'image_size_error'){
   echo "<div class='alert alert-danger'>Image is too Large to Upload</div>";
  }else if($_SESSION['message1'] == 'invalid_image_error'){
   echo "<div class='alert alert-danger'>Invalid Image</div>";
  }
  unset($_SESSION['message1']);
}
  ?>
  <div class="container">
     <?php require_once('auth.php');?>
  <?php
  $userid= !(empty($_GET['uid']))? $_GET['uid'] : null ;
  if($userid){
  require_once("./db.php");
  $con= new mysqli(HOST,USER,PASS,DB);
  if($con->connect_error) die($con->connect_error);
  else{
    // echo "connected";
    $sql="select * from users where user_id=?";
    $stmt=$con->prepare($sql);
    
    $stmt->bind_param("s",$userid);
    $stmt->execute();
    $resultset=$stmt->get_result();
    while($rows=$resultset->fetch_assoc()){
      // print "<pre>";
      // print_r($rows);
      $namearr=explode(" ",$rows['name']);
      // print_r($namearr);
      ?>
      <div class="card m-3 p-3">
        <header class="modal-header">
          <h1>
            Showing <?php echo $rows['name'];?> 's Data
          </h1>
        </header>
        <form method="POST" action="update.php" enctype="multipart/form-data">
        <div class="row">
          <div class="col">
            <p class="form-group">
              <div class="row">
                <div class="col">
                 <label for="FirstName:">FirstName:</label>
                 <input type="text" name="editfname" id="edfn1" value="<?php echo $namearr[0];?>" class="form-control">
                </div>
                <div class="col">
                  <label for="lastName:">LastName:</label>
                 <input type="text" name="editlname" id="edln1" value="<?php echo $namearr[1];?>" class="form-control">
                </div>
              </div>
              
            </p>
            <p class="form-group">
              <div class="row">
                <div class="col">
                <label for="email">Email:</label>  
              <input type="email" name="editemail" id="edem1" class="form-control" value="<?php echo $rows['email'];?>">
             </div>
                <div class="col">
                   <label for="mobile">Mobile:</label>  
              <input type="number" name="editmobile" id="edmo1" class="form-control" value="<?php echo $rows['mobile'];?>">
                </div>
              </div>
           </p>
           
             <div class="form-group">
          <div class="row">
            <div class="col">
              <?php
              $language=explode(",",$rows['language']);
              ?>
              <label for="language">Language Known:</label>
              <select multiple name="lang[]" id="lang1" class="form-control">
                <option <?php if(in_array('Bengali',$language)){echo "selected";}?> >Bengali</option>
                <option <?php if(in_array('English',$language)){echo "selected";}?> >English</option>
                <option <?php if(in_array('Hindi',$language)){echo "selected";}?> >Hindi</option>
                <option <?php if(in_array('Tamil',$language)){echo "selected";}?> >Tamil</option>
                <option <?php if(in_array('Telegu',$language)){echo "selected";}?> >Telegu</option>
              </select>
            </div>
            <div class="col">
              <?php 
              $education=explode(",",$rows['education']);
              ?>
              <div class="form-group">
              <label for="educational qualification">Educational Qualification:</label>
             <p><input onchange="checkAll(this)" type="checkbox" name="ch_all" id="ch_all">Select/Deselect All</p> 
              <input type="checkbox" name="ch[]" id="ch1" value="10th" <?php if(in_array('10th',$education)){echo "checked";}?>>10<sup>th</sup>
              <input type="checkbox" name="ch[]" id="ch2" value="12th" <?php if(in_array('12th',$education)){echo "checked";}?>>12 <sup>th</sup>
              <input type="checkbox" name="ch[]" id="ch3" value="graduation" <?php if(in_array('graduation',$education)){echo "checked";}?>>Graduation
               <input type="checkbox" name="ch[]" id="ch4" value="postgraduation" <?php if(in_array('postgraduation',$education)){echo "checked";}?>>Post Graduation
               </div>
            </div>
            <script>
           function checkAll(checkfield){
            let ch1=document.getElementById('ch1');
            let ch2=document.getElementById('ch2');
            let ch3=document.getElementById('ch3');
            let ch4=document.getElementById('ch4');
            if(checkfield.checked){
                  ch1.checked=
                  ch2.checked=
                  ch3.checked=
                  ch4.checked=true;
            }else{
              ch1.checked=
                  ch2.checked=
                  ch3.checked=
                  ch4.checked=false;

            }
           }
        </script>
          </div>
        </div>
            <p class="form-group">Created: <?php echo date('d-m-y h:i:sA',strtotime($rows['created'])) ;?></p>
          </div>
          <input type="hidden" name="hid" id="hid" value="<?php echo $rows['user_id'];?>">
          <input type="hidden" name="h_image" value="<?php echo $rows['profile_pic']?>">
          <div class="col">
            <p ><img id="img01" src="<?php echo $rows['profile_pic'];?>" height="150px" width="150px" class="img-thumbnail" title="<?php echo $rows['name']?>'s Image"/></p>
            <div class="form-group">
              <label for="changeprofile">Change Profile Picture</label>
              <input type="file" name="editAvater" id="editAvater"  class="form-control" onchange="loadimage(event)">
              <script>
                function  loadimage(event){
                  let file = event.target.files[0];
                  let imageBLOB= URL.createObjectURL(file);
                 document.getElementById('img01').src=imageBLOB;
                }
              </script>
            </div>
          </div>
        </div>
      
      
     
        <button class="btn btn-success">Update</button>
        <a onclick="return confirm('Do You want to Delete This Record ?');" href="delete.php?uid=<?php echo $rows['user_id'];?>" class="btn btn-danger">Delete</a>
        <a class="btn btn-dark" href="index">back</a>
      </form>
      </div>
  <?php
    }
    $stmt->close();
    $con->close();
  }
  }
  ?>
</div>
</body>
</html>