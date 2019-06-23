<?php

  include 'notification_fetch.php'; 
  include 'navigation.php';
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
           <title>Summary of Bookings</title>  
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="css/w3.css">
          <link rel="stylesheet" type="text/css" href="css/table.css">
          <link rel="stylesheet" type="text/css" href="css/custom.css">
          <link rel="stylesheet" type="text/css" href="css/modal.css">
          <link rel="stylesheet" type="text/css" href="css/style.css">
          <link rel="stylesheet" type="text/css" href="css/search.css">
          <link rel="stylesheet" type="text/css" href="css/notification.css">
          <link rel="stylesheet" type="text/css" href="css/bootstrap.min2.css">
          <link rel="stylesheet" type="text/css" href="css/navigation.css">
          <link rel="stylesheet" type="text/css" href="css/navigation2.css">
          <link rel="stylesheet" type="text/css" href="css/dashboard.css">
          <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css" /> 
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
                    <?php
                      echo navigate_right();

                      ?>
                    </ul>
                </div>
            </div>
        </nav>
           <div class="container pad-1">
                <h3 align="center">Summary of Bookings</h3>  
                <br />   
                     <table id="employee_data" class="table">    
                          <?php
                          include "Include/connection.php";
                             $query ="SELECT *  from client 
                                      INNER JOIN loan on client.client_id = loan.client_id
                                      group by loan.loan_id";  
                             $result = mysqli_query($conn, $query);

                             echo ' <thead>
                                      <tr class="text-white">
                                          <th class="my-bg text-white">Account Name</th>
                                          <th class="my-bg text-white" >Date Booked</th>
                                          <th class="my-bg text-white">Maturity Date</th>
                                          <th class="my-bg text-white" >Original Amount</th>
                                          <th class="my-bg text-white">Net Proceeds</th>
                                          <th class="my-bg text-white" >Interest (3 Month)</th>
                                          <th class="my-bg text-white" >Interest (1 Month)</th>
                                          <th class="my-bg text-white">Service Handling</th>
                                          <th class="my-bg text-white" >Other Income</th>
                                      </tr> 
                                    </thead>';

                             while($row = mysqli_fetch_array($result))
                              {         
                                 
                                $loan_id = $row['loan_id'];
                                $sql ="SELECT first_name, last_name, middle_name,date_booked, maturity_date, original_amount, 
                                loan_balance as net_proceeds,
                                ROUND(original_amount * 0.15 * (COUNT(due_date)/2), 2) as Interest_earned_3,
                                ROUND(original_amount * 0.05 * (COUNT(due_date)/2), 2) as Interest_earned_1, 
                                original_amount*0.03 as service_handling_fee, insurance +coalesce((SELECT SUM(other_income) from payment_info WHERE payment.loan_id='$loan_id' && status='Updated'),0) as other_income  from client 
                                INNER JOIN loan on client.client_id = loan.client_id
                                INNER JOIN payment on payment.loan_id = loan.loan_id 
                                WHERE loan.loan_id='$loan_id'";
                                
                                $rowSummary = mysqli_fetch_assoc(mysqli_query($conn,$sql));
                                
                                $firstName = htmlspecialchars($rowSummary['first_name']);
                                $middleName = htmlspecialchars($rowSummary['middle_name']);
                                $lastName = htmlspecialchars($rowSummary['last_name']);
                                $dateBooked = htmlspecialchars($rowSummary['date_booked']);
                                $maturityDate = htmlspecialchars($rowSummary['maturity_date']);
                                $originalAmount = htmlspecialchars($rowSummary['original_amount']);
                                $netProceeds = htmlspecialchars($rowSummary['net_proceeds']);
                                $Interest_3 = htmlspecialchars($rowSummary['Interest_earned_3']);
                                $Interest_1 = htmlspecialchars($rowSummary['Interest_earned_1']);
                                $serviceHandling = htmlspecialchars($rowSummary['service_handling_fee']);
                                $otherIncome = htmlspecialchars($rowSummary['other_income']);
                                 
                                        echo  '
                                              <tr>
                                                  <td> <a href="Profile.php?loan_id='.$row["loan_id"].'">'.$firstName.'  '.$middleName.' '.$lastName.'</a></td>
                                                  <td>'.$maturityDate.'</td>
                                                  <td>'.$dateBooked.'</td>
                                                  <td>'.$originalAmount.'</td>
                                                  <td>'.$netProceeds.'</td>
                                                  <td>'.$Interest_3.'</td>
                                                  <td>'.$Interest_1.'</td>
                                                  <td>'.$serviceHandling.'</td>
                                                  <td>'.$otherIncome.'</td>
                                             </tr>';

                              }  
                          ?>  
                     </table>
          </div>
            <script src="js/ajax.js"></script> 
            <script src="js/bootstrap.min.js"></script>
            <script src="js/jquery.dataTables.min.js"></script>  
            <script src="js/dataTables.bootstrap.min.js"></script>
            <script>
                  $(document).ready(function(){

                      $('#employee_data').DataTable();

                  });
          </script> 

      </body>  
 </html>  
