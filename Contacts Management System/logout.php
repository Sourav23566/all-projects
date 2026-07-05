
<?php
session_start();
function rediract($loc){
  echo "<script>window.location.href='$loc'; </script> ";
  
}
session_destroy();
rediract('signin');
?>