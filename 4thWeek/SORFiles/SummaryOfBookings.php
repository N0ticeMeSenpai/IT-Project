<?php

if(isset($_POST['searchSalaryAccount']))
{
    $valueToSearchSalaryAccount = $_POST['valueToSearchSalaryAccount'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `summary_of_bookings_sa` WHERE CONCAT(`id`, `account_name`, `outstanding_balance`, `remarks`) LIKE '%".$valueToSearchSalaryAccount."%'";
    $search_result_salary_account = filterTableSalaryAccount($query);
    
}
 else {
    $query = "SELECT * FROM `summary_of_bookings_sa`";
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
    $query = "SELECT * FROM `summary_of_bookings_ba` WHERE CONCAT(`id`, `account_name`, `outstanding_balance`, `remarks`) LIKE '%".$valueToSearchBusinessAccount."%'";
    $search_result_business_account = filterTableBusinessAccount($query);
    
}
 else {
    $query = "SELECT * FROM `summary_of_bookings_ba`";
    $search_result_business_account = filterTableBusinessAccount($query);
}

// function to connect and execute the query for business account
function filterTableBusinessAccount($query)
{
    $connect = mysqli_connect("localhost", "root", "", "itproject2");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;  
}

?>

<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
        <link rel="stylesheet" type="text/css" href="css/table.css">
        <link rel="stylesheet" type="text/css" href="css/modal.css">
        <link rel="stylesheet" type="text/css" href="css/navigation2.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <title>Summary of Bookings</title>

    </head>

    <body>
        <div class="container-fluid no-padding">
            <div class="topnav">
                <div class="topnav-right">
                    <a href="index.html">Home</a>
                    <a href="ClientAdd.html">Add a Client</a>
                    <a href="SummaryOfBookings.html">Summary of Bookings</a>
                    <a href="SORActiveAccount.html">Summary of Receivables</a>
                    <a href="ARMovingAccount.html">Aging of Receivables</a>
                    <a href="DelinquentReport.html">Delinquents Reports</a>
                </div>
            </div>
            <div class="container">

                <h2 class="p-5 text-center">Summary of Bookings</h2>

                <hr>
                <h3>Salary Account</h3>
                <hr>

               <form action="SummaryOfBookings.php" method="post">
            <input type="text" name="valueToSearchSalaryAccount" placeholder="Search" id="myInput">
            <input type="submit" name="searchSalaryAccount" value="Search"><br><br>
            

                <table>
                    <thead class="text-white">
                        <tr>
                            <th class="my-bg">Booking Date</th>
                            <th class="my-bg">Maturity Date</th>
                            <th class="my-bg">Account Name</th>
                            <th class="my-bg">Original Amount</th>
                            <th class="my-bg">Net Proceeds</th>
                            <th class="my-bg">Interest Earned</th>
                            <th class="my-bg">Service Charge Fee</th>
                            <th class="my-bg">Other Income</th>
                            <th class="my-bg">Previous Loan Balance</th>
                        </tr>
                    </thead>

                    <tbody id="myTable">
                        <tr>
                            <td>Time stamp</td>
                            <td>Assumed date when the transaction will be finished </td>
                            <td>Name of Client</td>
                            <td>Amount of money originally borrowed</td>
                            <td>Amount that will be given to the client</td>
                            <td>Profit earned by the company</td>
                            <td>Extra charge fee assessed from the service</td>
                            <td>Insurance</td>
                            <td>The last outstanding balance of Client after the last payment</td>
                        </tr>
                    </tbody>
  
  <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result_salary_account)):?>
                <tr>
                    <td><?php echo $row['booking_date'];?></td>
                    <td><?php echo $row['maturity_date'];?></td>
                    <td><?php echo $row['account_name'];?></td>
                    <td><?php echo $row['original_amount'];?></td>
                    <td><?php echo $row['net_proceeds'];?></td>
                    <td><?php echo $row['interest_earned'];?></td>
                    <td><?php echo $row['service_charge_fee'];?></td>
                    <td><?php echo $row['other_income'];?></td>
                    <td><?php echo $row['previous_loan_balance'];?></td>
                </tr>
                <?php endwhile;?>
            </table>
            </form>

                <hr>
                <h3>Business Account</h3>
                <hr>

        <form action="SummaryOfBookings.php" method="post">
            <input type="text" name="valueToSearchBusinessAccount" placeholder="Search" id="myInput">
            <input type="submit" name="searchBusinessAccount" value="Search"><br><br>

                <table>
                    <thead class="text-white">
                        <tr>
                            <th class="my-bg">Booking Date</th>
                            <th class="my-bg">Maturity Date</th>
                            <th class="my-bg">Account Name</th>
                            <th class="my-bg">Original Amount</th>
                            <th class="my-bg">Net Proceeds</th>
                            <th class="my-bg">Interest Earned</th>
                            <th class="my-bg">Service Charge Fee</th>
                            <th class="my-bg">Other Income</th>
                            <th class="my-bg">Previous Loan Balance</th>
                        </tr>
                    </thead>

                    <tbody id="myTable">
                        <tr>
                            <td>Time stamp</td>
                            <td>Assumed date when the transaction will be finished </td>
                            <td>Name of Client</td>
                            <td>Amount of money originally borrowed</td>
                            <td>Amount that will be given to the client</td>
                            <td>Profit earned by the company</td>
                            <td>Extra charge fee assessed from the service</td>
                            <td>Insurance</td>
                            <td>The last outstanding balance of Client after the last payment</td>
                        </tr>
                    </tbody>
 <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result_business_account)):?>
                <tr>
                    <td><?php echo $row['booking_date'];?></td>
                    <td><?php echo $row['maturity_date'];?></td>
                    <td><?php echo $row['account_name'];?></td>
                    <td><?php echo $row['original_amount'];?></td>
                    <td><?php echo $row['net_proceeds'];?></td>
                    <td><?php echo $row['interest_earned'];?></td>
                    <td><?php echo $row['service_charge_fee'];?></td>
                    <td><?php echo $row['other_income'];?></td>
                    <td><?php echo $row['previous_loan_balance'];?></td>
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

                    <form class="text-center" action="/action_page.php">
                        <!--Exporting Data from CSV File-->
                        <!-- Additional Notes for Back End Functionality in Exporting Data 
https://makitweb.com/how-to-export-mysql-table-data-as-csv-file-in-php/ -->
                        <h2 class="p-3">Monthly Report</h2>
                        <input class="i-2" type="month" id="myMonth" value="2014-05">
                        <div class="py-3 ">
                            <input class="b-2" type="submit" value="Generate Report">
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
