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

                <form action="OPSearchSalaryClient.php" method="post">
                    <input type="text" name="search" placeholder="Search Client Name">
                    <button type="submit" name="submit-search">Search</button>
                </form>
                <br>

                <form action="OPListSalaryClient.php" method="post">
                    <select name="client_status">
                        <option value="pending">Pending</option>
                        <option value="denied">Denied</option>
                    </select>
                    <button type="submit" name="submit-list">Client List</button>
                </form>
                <br><br>

                <table class="table">
                    <thead class="text-white">
                        <tr>
                            <th class="my-bg">Account Name</th>
                            <th class="my-bg">Contact Number</th>
                            <th class="my-bg">Requested Amount</th>
                            <th class="my-bg">Status</th>
                            <th class="my-bg">Date Joined</th>
                            <th class="my-bg">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            echo Salary_Pending();

                        ?>
                    </tbody>
                </table class="table">
                <div class="row">
                    <div class="col">
                        <div class="pagination-wrap pull-right">
                            <ul class="pagination pagination-v3">
                            <?php
                                echo page_pendingSalary();

                            ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
                <h3>Business Account</h3>
                <hr>

                <form action="OPSearchBusinessClient.php" method="post">
                    <input type="text" name="search" placeholder="Search Client Name">
                    <button type="submit" name="submit-search">Search</button>
                </form>
                <br>

                <form action="OPListBusinessClient.php" method="post">
                    <select name="client_status">
                        <option value="pending">Pending</option>
                        <option value="denied">Denied</option>
                    </select>
                    <button type="submit" name="submit-list">Client List</button>
                </form>
                <br><br>

                <table class="table">
                    <thead class="text-white">
                        <tr>
                            <th class="my-bg">Account Name</th>
                            <th class="my-bg">Contact Number</th>
                            <th class="my-bg">Requested Amount</th>
                            <th class="my-bg">Status</th>
                            <th class="my-bg">Date Joined</th>
                            <th class="my-bg">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            echo Business_Pending();

                        ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col">
                        <div class="pagination-wrap pull-right">
                            <ul class="pagination pagination-v3">
                            <?php
                                echo page_pendingBusiness();

                            ?>
                            </ul>
                        </div>
                    </div>
                </div>

                </table>
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

        <script type="text/javascript" src="js/Table.js"></script>
        <script type="text/javascript" src="js/modal.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>
    </body>

</html>
