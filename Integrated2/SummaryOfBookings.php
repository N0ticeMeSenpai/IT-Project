<?php

  include 'OFFunction.php';
  include 'notification_fetch.php'; 
  include 'navigation.php';
  include 'DelinquentUpdate.php';

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
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <script src="js/ajax.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <title>Summary Of Bookings</title>

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

            <h2 class="p-5 text-center">Summary of Bookings</h2>


            <h3><strong>Salary Account</strong></h3>

            <br><br>

            <table class="table">
                <thead class="text-white">
                    <tr>
                        <th class="my-bg text-white">Account Name</th>
                        <th class="my-bg text-white" >Remaining Balance</th>
                        <th class="my-bg text-white">Remarks</th>
                    </tr>
                </thead>

                <?php
                    echo Salary_ActiveAccount();

                    ?>
            </table>
            <div class="row">
                <div class="col">
                    <div class="pagination-wrap pull-right">
                        <ul class="pagination pagination-v3">

                        <?php
                            echo page_Salary();

                        ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
        
                        <h3>Business Account<h3>
        
                </div>
            </div>
            <br><br>

            <table class="table">
                <thead class="text-white">
                    <tr>
                        <th class="my-bg text-white">Account Name</th>
                        <th class="my-bg text-white" >Remaining Balance</th>
                        <th class="my-bg text-white">Remarks</th>
                    </tr>
                </thead>

                <?php
                    echo  Business_ActiveAccount();
                    
                    ?>

            </table>
              <div class="row">
                <div class="col">
                    <div class="pagination-wrap pull-right">
                        <ul class="pagination pagination-v3">

                        <?php
                           echo page_Business();

                        ?>
                        </ul>
                    </div>
                </div>
            </div>
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
    </div>
    <button onclick="document.getElementById('id01').style.display='block'" class="reports"><img src="img/report.png" width="30px"></button>

    <div id="id01" class="w3-modal">
        <div class="w3-modal-content">
            <div class="w3-container p-5">
                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>

                <form class="text-center" method="POST" action="excel.php">
                    <h2 class="p-3">Monthly Report</h2>
                    <input class="i-2" type="month" name="testDate" id="myMonth">
                    <div class="py-3 ">
                        <input class="b-2" name="generate_ActiveAccount" type="submit" value="Active Account">
                    </div>
                    <div class="py-3 ">
                        <input class="b-2" name="generate_DelinquentAccount" type="submit" value="Delinquent Account">
                    </div>
                    <div class="py-3 ">
                        <input class="b-2" name="generate_ActiveDelinquent" type="submit" value="Active Delinquent Account">
                    </div>
                    <div class="py-3 ">
                        <input class="b-2" name="generate_LegalAccount" type="submit" value="Legal Account">
                    </div>
                    <div class="py-3 ">
                        <input class="b-2" name="generate_Bookings" type="submit" value="Summary of bookings">
                    </div>
                    <div class="py-3 ">
                        <input class="b-2" name="generate_all" type="submit" value="Generate All Report">
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/Table.js"></script>
    <script type="text/javascript" src="js/modal.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
</body>

</html>