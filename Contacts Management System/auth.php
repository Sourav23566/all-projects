<?php
      // session_start();
      function rediract($loc){
        echo "<script>window.location.href='$loc'; </script> ";
  
     }

    if(!empty($_SESSION['USER'])){
      ?>
      <div class="float-right d-flex align-items-center">
          <img src="<?php echo $_SESSION['PIC']; ?>"class="rounded-circle border border-2 border-dark mr-2" width="40" height="40" alt="Profile">
           
          <!-- <?php //echo $_SESSION['PIC']; ?> -->
       <span class="mr-3 text-white">
        welcome <?php echo $_SESSION['USER'];?>
        </span>
        <a href="logout" class="btn btn-danger">Logout</a>
      </div>

  
    <?php
    }else{
       rediract('signin');
    }
    ?>