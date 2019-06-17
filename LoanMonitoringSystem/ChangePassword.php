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

<?php
if(isset($_POST["submit"])){
  
    include 'Include/connection.php';
    $username = $_SESSION['user']['username'];
    $password = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $confirmnewpassword = $_POST['confirmnewpassword'];


    $query = "SELECT password FROM employee WHERE username ='$username'";

    $result = mysqli_query($conn, $query);

    $fetch = mysqli_fetch_assoc(mysqli_query($conn,$query));

      if($password != $fetch['password']){

            $error="<div style='color: red'>You entered an incorrect password</div>";
        
        }elseif($newpassword==$confirmnewpassword){
            
            $sql=mysqli_query($conn, "UPDATE employee SET password='$newpassword' where username='$username'");
            $error="<div style='color: green'>Congratulations You have successfully changed your password </div>";
            
       }else{
           
             $error="<div style='color: red'>Passwords do not match </div>";
           
           }

}
      
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link rel="stylesheet" type="text/css" href="css/notification.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min2.css">
    <link rel="stylesheet" type="text/css" href="css/navigation.css">
    <link rel="stylesheet" type="text/css" href="css/navigation2.css">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Change Password</title>
</head>
<body>
<div class="no-padding">
    <nav id="myNavbar" class="navbar nav-color" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="dashboard.php">SIGMA</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <?php
                echo navigate_it()
              ?>
                <ul class="nav navbar-nav navbar-right">
                  <?php
                    echo navigate_right();

                  ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container pad-1">
        <div class="login-page">
            <div class="form">
                  <form method="POST" class="login-form" action="ChangePassword.php">
                    <label class="pull-left">Current Password</label>
                      <input type="password" placeholder="Password" name="password">
                    <label class="pull-left">New Password</label>
                      <input type="password" placeholder="New Password" name="newpassword">
                    <label class="pull-left">Confirm Password</label>
                      <input type="password" placeholder="Confirm Password" name="confirmnewpassword">
                      <input type="submit" class="mybtn2" name="submit" value="Change Password">
                  </form>
                  <?php if(isset($error)){ echo $error; }?>
            </div>
        </div>
    </div>
</div>
  </body>

</html>