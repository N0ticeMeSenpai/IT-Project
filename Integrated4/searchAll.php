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
	<link rel="stylesheet" type="text/css" href="css/custom.css">
	<link rel="stylesheet" type="text/css" href="css/notification.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min2.css">
	<link rel="stylesheet" type="text/css" href="css/navigation.css">
	<link rel="stylesheet" type="text/css" href="css/navigation2.css">
	<link rel="stylesheet" type="text/css" href="css/mysearch.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<title></title>
</head>
<body>
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
  	<div class="container pad-85">
        <form class ="line" action="search.php" method="post">
              <input class="searching" id="myInput" type="text" placeholder="Search.." name="search">
              <img src="img/search.png" width="30px"><input class="hide" type="submit" value="Search">
              <hr class="my-hr my-margin" size="30" width="90%">
        </form>    
  	</div>
</body>
<footer>
	<div class="footer-bottom">
	    <div class="container">
	    	<div class="row">
	    		<div class="text-center ">
	    			<div class="copyright-text">
	    				<p>CopyRight © 2019 Sigma All Rights Reserved</p>
	    			</div>
	    		</div> <!-- End Col -->
	    	</div>
	    </div>
	</div>
</footer>
</html>