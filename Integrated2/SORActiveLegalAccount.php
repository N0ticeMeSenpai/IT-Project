<?php
  include 'notification_fetch.php'; 
?>
<?php

if(isset($_POST['searchSalaryAccount']))
{
    $valueToSearchSalaryAccount = $_POST['valueToSearchSalaryAccount'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM sigma.client inner join sigma.loan 
        ON client.client_id = loan.client_id inner join sigma.payment 
        ON loan.payment_id = payment.payment_id WHERE loan_type = 'Salary' && 
        concat(last_name, first_name, outstanding_balance, remarks) 
        LIKE '%".$valueToSearchSalaryAccount."%'";
    
    $search_result_salary_account = filterTableSalaryAccount($query);
    
}
 else {
    $query = "SELECT * FROM sigma.client inner join sigma.loan 
    ON client.client_id = loan.client_id inner join sigma.payment ON loan.payment_id = payment.payment_id
    WHERE loan_type = 'Salary' ";
    $search_result_salary_account = filterTableSalaryAccount($query);
}

// function to connect and execute the query for salary account
function filterTableSalaryAccount($query)
{
    $connect = mysqli_connect("localhost", "root", "", "itproject2");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>

<?php

if(isset($_POST['searchBusinessAccount']))
{
    $valueToSearchBusinessAccount = $_POST['valueToSearchBusinessAccount'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM sigma.client inner join sigma.loan 
        ON client.client_id = loan.client_id inner join sigma.payment 
        ON loan.payment_id = payment.payment_id WHERE loan_type = 'Business' && 
        concat(last_name, first_name, outstanding_balance, remarks) 
        LIKE '%".$valueToSearchBusinessAccount."%'";
    $search_result_business_account = filterTableBusinessAccount($query);
    
}
 else {
    $query = "SELECT * FROM sigma.client inner join sigma.loan 
        ON client.client_id = loan.client_id inner join sigma.payment 
        ON loan.payment_id = payment.payment_id WHERE loan_type = 
        'Business'";
    $search_result_business_account = filterTableBusinessAccount($query);
}

// function to connect and execute the query for business account
function filterTableBusinessAccount($query)
{
    $connect = mysqli_connect("localhost", "root", "", "sigma");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;  
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
        <title>Summary of Receievables</title>

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
                        <ul class="nav navbar-nav">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li><a href="notification.php">
                                      <?php
                                      if(count_data() > '0'){
                                        echo count_data();
                                      }
                                     ?>
                                    Notification
                                </a></li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Summary of Receivable <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="SORActiveAccount.php">Active Account</a></li>
                                    <li><a href="SORActiveDelinquentAccount.php">Active Delinquent</a></li>
                                    <li><a href="SORActiveLegalAccount.php">Active Legal Account</a></li>
                                    <li><a href="SORDelinquentAccount.php">Delinquent Account</a></li>
                                    <li><a href="SummaryOfBookings.php">Summary of Bookings</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                          <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container">

                <center>
                    <h2>Legal Accounts</h2>
                </center>
                <hr>

                <h3>Salary Account</h3>
                <hr>
                
            <form action="SORActiveLegalAccount.php" method="post">
                <div class="pad-2" id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input type="text" name="valueToSearchSalaryAccount" class="  search-query form-control" placeholder="Search" id="myInput">
                        <span class="input-group-btn">
                            <input class="btn btn-success" type="submit" name="searchSalaryAccount" value="Search">
                        </span>
                    </div>
                </div>

            <table class="table">
                <thead class="text-white">
                    <tr>
                        <th class="my-bg">Account Name</th>
                        <th class="my-bg">Outstanding Balance</th>
                        <th class="my-bg">Remarks</th>
                    </tr>
                </thead>

                <tbody id="myTable">
                    <tr>
                        <td>Name of the Client</td>
                        <td>Remaining payment of the salary type loan</td>
                        <td>Comments for how the client pays, problems in paying, etc</td>
                    </tr>
                </tbody>


      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result_salary_account)):?>
                <tr>
                    <td><?php echo $row['first_name']." ".$row['last_name'];?></td>
                    <td><?php echo $row['outstanding_balance'];?></td>
                    <td><?php echo $row['remarks'];?></td>
                </tr>
                <?php endwhile;?>
            </table>
        </form>

                <hr>
                <h3>Business Account</h3>
                <hr>
                
                <form action="SORActiveLegalAccount.php" method="post">
                <div class="pad-2" id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input type="text" name="valueToSearchBusinessAccount" class="  search-query form-control" placeholder="Search" id="myInput">
                        <span class="input-group-btn">
                            <input class="btn btn-success" type="submit" name="searchBusinessAccount" value="Search">
                        </span>
                    </div>
                </div>
           <table class="table">
                <thead class="text-white">
                    <tr>
                        <th class="my-bg">Account Name</th>
                        <th class="my-bg">Outstanding Balance</th>
                        <th class="my-bg">Remarks</th>
                    </tr>
                </thead>

                <tbody id="myTable">
                    <tr>
                        <td>Name of the Client</td>
                        <td>Remaining payment of the salary type loan</td>
                        <td>Comments for how the client pays, problems in paying, etc</td>
                    </tr>
                </tbody>
                
                <?php while($row = mysqli_fetch_array($search_result_business_account)):?>
                <tr>
                    <td><?php echo $row['first_name']." ".$row['last_name'];?></td>
                    <td><?php echo $row['outstanding_balance'];?></td>
                    <td><?php echo $row['remarks'];?></td>
                </tr>
                <?php endwhile;?>
            </table>
        </form><br><br>

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
                                <input class="b-2" name="generate_LegalAccount" type="submit" value="Generate Report">
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
