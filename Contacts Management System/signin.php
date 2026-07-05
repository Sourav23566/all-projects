<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIGNIN</title>
  <?php include("./assets/plugins.php");?>
</head>
<body>
  <body>
  <nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand">Navbar</a>
   <a class="btn btn-info" href="signup.php">Signup</a>
</nav>
  <div class="container">
    <?php
    if(!(empty($_SESSION['message']))){
      if($_SESSION['message']=='Wrong_credentials' ){
        echo "<div class='alert alert-danger'>Invalid Username or Password</div>";
      }else if($_SESSION['message']=='user_not_exists' ){
        echo "<div class='alert alert-danger'>Email is not Registered</div>";
      }
      unset($_SESSION['message']);
    }
    ?>
    <header class="modal-header">
      <h1>Signin:</h1>
    </header>
    <div class="card m-3 p-3">
      <form method="POST" action="login">
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" name="em1" id="em1" required class="form-control">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" name="pass3" id="pass3" required class="form-control">
        </div>
        <div class="form-group">
          <button class="btn btn-info">LOGIN</button>
        </div>
      </form>
      <div>
       
      </div>
    </div>
  </div>
</body>
</html>