<?php 
   session_start();
   function redirect($loc){
    echo "<script>
             window.location.href='$loc';
     </script>";
   }
  
   
   function generateTaskId(){
    return "tasks-".rand(1000,9999)."-".time();
   }
   $method =$_SERVER['REQUEST_METHOD'];
 if($method == "POST")
{  
   $taskId=generateTaskId();
   $userId = $_SESSION['USER_ID'];
   $title  = $_POST['title'];
   $desc   = $_POST['desc'];
   $status = $_POST['status'];

   include_once("db.php");
         $con = new MYSQLi(HOST,USER,PASS,DB);
    
         if($con->connect_error) die($con->connect_error);
         else {
            echo "Connected ";
        $SQL="insert into tasks(task_id,title,description,status,user_id)values(?,?,?,?,?)";
        $stmt = $con->prepare($SQL);
        $stmt->bind_param("sssss",$taskId,$title,$desc,$status,$userId);
        $stmt->execute();
         $rows =$stmt->affected_rows;
        $message = ($rows ==1) ? "task_add_success" : "task_add_error";
        $_SESSION['message']=$message;  
        $stmt->close();
      
        $con->close();
        redirect("add_tasks.php");
   }
     
   }else{
    redirect("add_tasks.php");
   }

?>