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
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link rel="stylesheet" type="text/css" href="css/modal.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/notification.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min2.css">
    <link rel="stylesheet" type="text/css" href="css/navigation.css">
    <link rel="stylesheet" type="text/css" href="css/navigation2.css">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <title>Active Account</title>

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
        <div class="container">

            <h2 class="p-5 text-center">List of Pending Clients</h2>

            <hr>
            <h3>Salary Account</h3>
            <hr>

            <br><br>

            <table class="table">
                <thead class="text-white">
                    <tr>
                        <th class="my-bg">First Name</th>
                        <th class="my-bg">Last Name</th>
                        <th class="my-bg">Contact Number</th>
                        <th class="my-bg">Requested Amount</th>
                        <th class="my-bg">Status</th>
                        <th class="my-bg">Date Joined</th>
                    </tr>
                </thead>

                <?php
                    //Connect the database
                    $conn=mysqli_connect('localhost','root','','sigma');

                    if(isset($_POST['submit-list'])){
                        $selected_val = $_POST['client_status'];  // Storing Selected Value In Variable
                        $sql = "SELECT 
		                          *
	                           FROM
                                    sigma.client
	                           WHERE
		                          registered_status = '$selected_val'
                                    AND loan_type = 'Salary';";

                        $result = mysqli_query($conn, $sql);
                        $queryResult = mysqli_num_rows($result);

                        echo "There are ".$queryResult." results!";

                        if($queryResult > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<tbody id='myTable'>";
                                echo "<tr>";
                                echo "<td>" .$row['first_name']. "</td>";
                                echo "<td>" .$row['last_name']. "</td>";
                                echo "<td>" .$row['contact_no']. "</td>";
                                echo "<td>" .$row['requested_amount']. "</td>";
                                echo "<td>" .$row['registered_status']. "</td>";
                                echo "<td>" .$row['registered_date']. "</td>";
                                echo "</tr>";
                                echo "</tbody>";
                            }

                        }else{
                            echo "There are no results matching your search!";
                        }
                    }
                    ?>
            </table>

        </div>
        <footer>
            <div class="footer-bottom">
                <div class="container">
                  <div class="text-center ">
                    <div class="copyright-text">
                      <p>CopyRight © 2019 Sigma All Rights Reserved</p>
                    </div>
                  </div> <!-- End Col -->
                </div>
            </div>
        </footer>

    <script type="text/javascript" src="js/Table.js"></script>
    <script type="text/javascript" src="js/modal.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
</body>

</html>
