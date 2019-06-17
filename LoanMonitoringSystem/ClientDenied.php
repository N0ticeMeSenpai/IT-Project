<?php
include "Include/connection.php";


if(isset($_POST['client_id'])){
  
  $id = $_POST['client_id'];

  //  query to update data 
   
  $result  = mysqli_query($conn , "DELETE FROM client WHERE client_id='$id'");
  header("location:ListOfPending.php"); 

}
?>