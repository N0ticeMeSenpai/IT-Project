<?php

  include 'notification_fetch.php'; 
  include 'navigation.php';

?>
<?php
session_start();
//Checking User Logged or Not
if(empty($_SESSION['user'])){
    header('location:index.php');
}


//timeout after 5 sec
if(isset($_SESSION['user'])) {
    if((time() - $_SESSION['last_time']) > 1800) {
      header("location:logout.php");  
    }
}

?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Password Change</title>
     </head>
    <body>
    <h1>Change Password</h1>
   <form method="POST" action="ChangePassword.php">
    <table>
    <tr>
    <td>Enter your existing password:</td>
    <td><input type="password" size="10" name="password"></td>
    </tr>
  <tr>
    <td>Enter your new password:</td>
    <td><input type="password" size="10" name="newpassword"></td>
    </tr>
    <tr>
   <td>Re-enter your new password:</td>
   <td><input type="password" size="10" name="confirmnewpassword"></td>
    </tr>
    </table>
    <p><input type="submit" name="submit" value="Update Password">
    </form>
   </body>
</html> 

<?php


if(isset($_POST["submit"])){
  
    $conn = mysqli_connect('localhost' , 'root' ,'' ,'sigma');
    $username = $_SESSION['user']['username'];
    $password = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $confirmnewpassword = $_POST['confirmnewpassword'];


    $query = "SELECT password FROM employee WHERE username ='$username'";

    $result = mysqli_query($conn, $query);

    $fetch = mysqli_fetch_assoc(mysqli_query($conn,$query));

      if($password != $fetch['password']){

            echo "You entered an incorrect password";
        
        }elseif($newpassword==$confirmnewpassword){
            
            $sql=mysqli_query($conn, "UPDATE employee SET password='$newpassword' where username='$username'");
            echo "Congratulations You have successfully changed your password";
            
       }else{
           
             echo "Passwords do not match";
           
           }

}
      
?>