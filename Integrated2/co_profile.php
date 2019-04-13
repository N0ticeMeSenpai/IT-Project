<?php

  include 'OFFunction.php';
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

<?php
// Check existence of id parameter before processing further
if(isset($_GET["co_borrower_id"]) && !empty(trim($_GET["co_borrower_id"]))){
    //Connect the database
    $conn=mysqli_connect('localhost','root','','sigma');

    // Prepare a select statement
    $sql = 'SELECT concat(co_first_name," ",co_last_name) as co_name, employment, group_concat(co_name_of_firm separator ", ") 
    as co_name_of_firm, group_concat(co_business_address separator ", ") 
    as co_business_address, co_address, co_contact_no, related_client 
    FROM client INNER JOIN co_borrower on co_borrower.client_id = client.client_id 
    WHERE co_borrower.co_borrower_id = ?;';

    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_GET["co_borrower_id"]);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Retrieve individual field value
                $co_name = $row["co_name"];
                $name_of_firm = $row["co_name_of_firm"];
                $business_address = $row["co_business_address"];
                $present_address = $row["co_address"];
                $contact_no = $row["co_contact_no"];

            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }

        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($conn);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
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
	<link rel="stylesheet" type="text/css" href="css/profile.css">
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
                echo navigate_it()
            ?>
            <ul class="nav navbar-nav navbar-right">
                 <li><a href="notification.php">
                          <?php
                          if(count_data() > '0'){
                            echo count_data();
                          }
                         ?>
                        <img src="img/notifications-button.png" width="15px">
                    </a></li>
                <?php
                  echo navigate_right();

                ?>
            </ul>
        </div>
    </div>
</nav> 
<div class="pad-1 container">
	<div class="row">
      <div class="col-xs-12 col-sm-9">
        
        <!-- User profile -->
        <div class="panel panel-default">
          <div class="panel-heading">
          <h4 class="panel-title">Profile</h4>
          </div>
          <div class="panel-body">
            <div class="profile__avatar">
              <img src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="...">
            </div>
            <div class="profile__header">
              <div class="fz-25"><?php echo $row["co_name"]; ?></div><div class="fz-15"><?php echo $row["related_client"]; ?></div>
            </div>
          </div>
        </div>

        <!-- User info -->
        <div class="panel panel-default">
          <div class="panel-heading">
          <h4 class="panel-title">User info</h4>
          </div>
          <div class="panel-body">
            <table class="table profile__table">
              <tbody>
                <tr>
                  <th><strong>Position</strong></th>
                  <td><?php echo $row["co_business_address"]; ?></td>
                </tr>
                <tr>
                  <th><strong>Home Address</strong></th>
                  <td><?php echo $row["co_address"]; ?></td>
                </tr>
                <tr>
                  <th><strong>Contact no.</strong></th>
                  <td><?php echo $row["co_contact_no"]; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
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
</body>
</html>