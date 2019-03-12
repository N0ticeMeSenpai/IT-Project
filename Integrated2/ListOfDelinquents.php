<?php
  include 'notification_fetch.php';
  include 'ListFunctions.php'; 
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
    <link rel="stylesheet" type="text/css" href="css/modal.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link rel="stylesheet" type="text/css" href="css/notification.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min2.css">
    <link rel="stylesheet" type="text/css" href="css/navigation.css">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
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
                    <li><a href="notification.php">
                              <?php
                                  if(count_data() > '0'){
                                    echo count_data();
                                  }
                             ?>
                            Notification
                        </a></li>
                  <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid no-padding">
        <div class="container">

            <center>
                <h2>List Of Delinquents</h2>
            </center>
            
            <form action="ListOfDelinquents.php" method="post">           
                <div class="pad-2" id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input type="text" name="valueToSearchDelinquents" class="  search-query form-control" placeholder="Search" id="myInput">
                        <span class="input-group-btn">
                            <input class="btn btn-success" type="submit" name="searchDelinquents" value="Search">
                        </span>
                    </div>
                </div>
            <table class="table">
                <thead class="text-white">
                    <tr>
                        <th class="my-bg text-white">Account Name</th>
                        <th class="my-bg text-white" >Co Borrower</th>
                        <th class="my-bg text-white">Balance</th>
                        <th class="my-bg text-white" >Date</th>
                    </tr>
                    </tr>
                </thead
                <?php 
                echo ListOfDelinquents();
                ?>
            </table>
        </form>
        </div>
    </div>

    <button onclick="document.getElementById('id01').style.display='block'" class="reports">Generate Report</button>
    
        <div id="id01" class="w3-modal">
            <div class="w3-modal-content">
                <div class="w3-container p-5">
                    <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>

                    <form class="text-center" method="POST" action="excel.php">
                        <h2 class="p-3">Monthly Report</h2>
                        <input class="i-2" type="month" name="testDate" id="myMonth">
                        <div class="py-3 ">
                            <input class="b-2" name="generate_ActiveAccount" type="submit" value="Generate Report">
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
