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
  <link rel="stylesheet" type="text/css" href="css/dashboard.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
  <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <title></title>
</head>
<body>
  <div class=" no-padding">
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
                    <li><a href="notification.php">
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
    <div class="notificate">
      <h1 class="pad-1">SEARCH CLIENT</h1> 
    </div>
      <div class="container">
        <ul class= "list-group list-group-flush">
           <?php  
              echo search_data();  
           ?>  
        </ul>
      </div>
      <div class="footer-bottom">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 ">
              <div class="copyright-text">
                <p>CopyRight © 2019 Sigma All Rights Reserved</p>
              </div>
            </div> <!-- End Col -->
            <div class="col-sm-6">              
              <ul class="social-link pull-right">
                <li><a href=""><span class="glyphicon glyphicon-heart-empty"></span></a></li>           
                <li><a href=""><span class="glyphicon glyphicon-heart-empty"></span></a></li>
                <li><a href=""><span class="glyphicon glyphicon-heart-empty"></span></a></li>
                <li><a href=""><span class="glyphicon glyphicon-heart-empty"></span></a></li>
                <li><a href=""><span class="glyphicon glyphicon-heart-empty"></span></a></li>
              </ul>             
            </div> <!-- End Col -->
          </div>
        </div>
    </div>
  </div>
<script src="js/bootstrap.min.js"></script>
</body>
</html>