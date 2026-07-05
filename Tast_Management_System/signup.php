<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIGNUP:</title>
  <?php include_once('./assets/plugins.php');?>
</head>
<body>
   <nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand">Navbar</a>
   <a class="btn btn-warning" href="signin.php">Login</a>
</nav>
  <?php
  if(!empty($_SESSION['errors'])){
    foreach($_SESSION['errors'] as $err){
     echo "<div class='alert alert-danger'>". $err."</div>";
    }
  }
  unset($_SESSION['errors']);
  
  
  ?>
  <?php
  if(!empty($_SESSION['message'])){
    if($_SESSION['message'] == 'singup_success'){
      echo "<div class='alert alert-success'>SignUp Successfully Done</div>";
    }
    else if($_SESSION['message'] == 'singup_error'){
      echo "<div class='alert alert-success'>Unable To SignUp</div>";
    }
    unset($_SESSION['message']);
  }
  ?>
  <div class="container-sm">
    <header class="modal-header">
      <h1>SIGNUP:</h1>
    </header>
    <div class="card p-3 m-3">
      <form method="POST" action="submit.php" enctype="multipart/form-data" novalidate>
        <div class="form-group">
          <div class="row">
            <div class="col">
              <label for="firstname">FirstName:</label>
              <input  type="text" name="first" id="f1" required class="form-control">
            </div>
            <div class="col">
               <label for="lastname">LastName:</label>
              <input  type="text" name="last" id="l1" required class="form-control">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col">
              <label for="email">email</label>
              <input type="email" name="em1" id="em1" required class="form-control">
            </div>
            <div class="col">  
              <label for="mobile">mobile</label>
              <input type="number" name="mb1" id="mb1" required class="form-control">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col">
              <label for="language">Language Known:</label>
              <select multiple name="lang[]" id="lang1" class="form-control">
                <option >Bengali</option>
                <option >English</option>
                <option >Hindi</option>
                <option >Tamil</option>
                <option >Telegu</option>
              </select>
            </div>
            <div class="col">
              <div class="form-group">
              <label for="educational qualification">Educational Qualification:</label>
             <p><input onchange="checkAll(this)" type="checkbox" name="ch_all" id="ch_all">Select/Deselect All</p> 
              <input type="checkbox" name="ch[]" id="ch1" value="10th">10<sup>th</sup>
              <input type="checkbox" name="ch[]" id="ch2" value="12th">12 <sup>th</sup>
              <input type="checkbox" name="ch[]" id="ch3" value="graduation">Graduation
               <input type="checkbox" name="ch[]" id="ch4" value="postgraduation">Post Graduation
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
        
        <div class="form-group">
          <label for="profilepic">Upload An Image</label>
          <input type="file" name="avater" id="avater" required class="form-control" onchange="loadImage(event)">
          <script>
            function loadImage(event){
              console.log(event.target.files[0]);
              const imageBlob= URL.createObjectURL(event.target.files[0]);
              document.getElementById('d1').innerHTML=`
               <img src="${imageBlob}" height="100px" width="100px">
              `;

            }
          </script>
          <div id="d1"></div>
         
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col">
             <label for="password">password</label>
             <input type="password" name="pass1" id="pass1" required class="form-control">
            </div>
            <div class="col">
              <label for="confrimpassword">Confrimpassword</label>
             <input type="password" name="conpass" id="conpass" required class="form-control">
            </div>
          </div>
         
        </div>
        <div class="form-group">
          <button class="btn btn-success">Submit</button>
          <button class="btn btn-info" type="reset">Reset</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>