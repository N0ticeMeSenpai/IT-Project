<?php
  include 'notification_fetch.php';
  include 'navigation.php';
?>

<?php
session_start();
//Checking User Logged or Not
if(empty($_SESSION['user'])){
    header('location:Login.php');
}


//timeout after 5 sec
if(isset($_SESSION['user'])) {
    if((time() - $_SESSION['last_time']) > 1800) {
      header("location:logout.php");  
    }
}


?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link rel="stylesheet" type="text/css" href="css/notification.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min2.css">
    <link rel="stylesheet" type="text/css" href="css/navigation.css">
    <link rel="stylesheet" type="text/css" href="css/navigation2.css">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <script type="js/navigation2.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
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
                        echo navigate_it();
                    ?>
                    <ul class="nav navbar-nav navbar-right">
                         <li>
                            <a href="notification.php">
                              <?php
                              if(count_data() > '0'){
                                echo count_data();
                              }
                             ?>
                             <img src="img/notifications-button.png" width="15px">
                            </a>
                         </li>
                      <?php
                      echo navigate_right();

                      ?>
                    </ul>
                </div>
            </div>
        </nav>
		<div class="container">
			<div class="login-page">
			  <div class="form">
			  	<h2 class="pad-2">Change Password</h2>
			    <form method="post" class="login-form">
			     <span class="pull-left">Current Password</span>
			     <input type="password" name="oldpwd" />
			     <span class="pull-left">New Password</span>
			     <input type="password" name="newpwd" />
			     <span class="pull-left">Confirm Password</span>
			     <input type="password" name="confirmpwd" />
			     <button type="submit" name="submit" value="Change password" >Change Password</button>
			    </form>
			  </div>
			</div>
		</div>
	</div>
</body>
</html>

<?php
    
    $conn=mysqli_connect('localhost','root','','sigma');
    if(isset($_SESSION["username"])){
      $username = $_SESSION['username'];
    }
    
if($_SESSION['user']['em_position']=='Office Staff'){

    if(isset($_POST['submit'])) {
		$oldpwd=$_POST['oldpwd'];
		$newpwd=$_POST['newpwd'];
		$confirmpwd=$_POST['confirmpwd'];
		$query = "SELECT password from employee WHERE username='ofstaff'"; //temp fix for ofstaff ONLY
		$result=mysqli_query($conn,$query); 
        
        while($row=mysqli_fetch_array($result)){
            $pass=$row['password'];
            
            if($pass==$oldpwd){
                
                if($newpwd==$confirmpwd){
                    $q="UPDATE employee SET password='$confirmpwd' WHERE username='ofstaff'"; //tempfix for ofstaff ONLY
                    $update=mysqli_query($conn,$q);
                    
                    if($update){
                        
                        echo "<script>alert['Successfully changed']</script>";
                    }else {
                        echo "<script>alert['New and Confirm password do not match']</script>";
                    }
                }else {
                    echo "<script>alert['Old password do not match!']</script>";
                }
            }else {
                echo"<script>alert['New and Confirm password do not match']</script>";
            }
        }
        
    }
}elseif($_SESSION['user']['em_position']=='Operations Manager'){


    if(isset($_POST['submit'])) {
        $oldpwd=$_POST['oldpwd'];
        $newpwd=$_POST['newpwd'];
        $confirmpwd=$_POST['confirmpwd'];
        $query = "SELECT password from employee WHERE username='opmanager'"; //temp fix for opmanager ONLY
        $result=mysqli_query($conn,$query); 
        
        while($row=mysqli_fetch_array($result)){
            $pass=$row['password'];
            
            if($pass==$oldpwd){
                
                if($newpwd==$confirmpwd){
                    $q="UPDATE employee SET password='$confirmpwd' WHERE username='opmanager'"; //tempfix for ofstaff ONLY
                    $update=mysqli_query($conn,$q);
                    
                    if($update){
                        
                        echo "<script>alert['Successfully changed']</script>";
                    }else {
                        echo "<script>alert['New and Confirm password do not match']</script>";
                    }
                }else {
                    echo "<script>alert['Old password do not match!']</script>";
                }
            }else {
                echo"<script>alert['New and Confirm password do not match']</script>";
            }
        }
        
    }


}
        
?>