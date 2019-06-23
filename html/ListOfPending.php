<?php

  include 'notification_fetch.php'; 
  include 'navigation.php';
  include 'Include/connection.php';
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
           <title>List Of Pending</title>  
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
                <h3 align="center">Pending Clients</h3>  
                <br />   
                     <table id="employee_data" class="table">  
                        <thead>
                            <tr class="text-white">
                                <th class="my-bg">Account Name</th>
                                <th class="my-bg">Contact Number</th>
                                <th class="my-bg">Business Address</th>
                                <th class="my-bg">Present Address</th>
                                <th class="my-bg">Requested Amount</th>
                                <th class="my-bg">Status</th>
                                <th class="my-bg">Date Joined</th>
                                <th class="my-bg">Action</th>
                            </tr> 
                          </thead>  
                          <?php
                             $query ="SELECT * FROM client
                                      WHERE registered_status = 'Pending'
                                      order by registered_status ASC;";  
                             $result = mysqli_query($conn, $query);
                             while($row = mysqli_fetch_array($result))
                              {
                                  $first_name = htmlspecialchars($row["first_name"]);
                                  $middle_name = htmlspecialchars($row["middle_name"]);
                                  $last_name = htmlspecialchars($row["last_name"]);
                                  $co_number = htmlspecialchars($row["contact_no"]);
                                  $present_address = htmlspecialchars($row["present_address"]);
                                  $business_address = htmlspecialchars($row["business_address"]);
                                  $requested_amount = htmlspecialchars($row["requested_amount"]);
                                     
                                echo '
                                      <tr id='. $row['client_id'] .'>  
                                          <td>'.$first_name.' '.$middle_name.' '.$last_name.'</td>
                                          <td>'.$co_number.'</td>
                                          <td>'.$business_address.'</td>
                                          <td>'.$present_address.'</td>
                                          <td>'.$requested_amount.'</td>
                                          <td data-target="registered">'.$row["registered_status"].'</td>
                                          <td>'.$row["registered_date"].'</td>
                                          <td>';
                                if($_SESSION['user']['em_position']=='Operations Manager'){

                                echo '
                                    <form class="pull-right" name="secret" method="post" action="ClientLoan.php">
                                    <a href="#" class="text-white" onclick="document.forms["secret"].submit();"><button class="btn"><img src="img/approved.png" width="25px"></button>&nbsp&nbsp</a>
                                    <input type="hidden" name="client_id" value='.$row["client_id"].'>
                                    </form>
                                    &nbsp&nbsp
                                    <button type="button" class="btn" data-toggle="modal" data-target="#myModal"><img src="img/deny.png" width="25px"></button>
                                        ';
                                  }
                                echo '</td>
                                     </tr>';

  
                          ?>  
                     </table>

                <div class="modal fade" id="myModal" role="dialog">
                  <div class="modal-dialog">
                  
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Are you sure?</h3>
                      </div>
                      <div class="modal-footer">
                        <form class="pull-left" name="yes" method="post" action="ClientDenied.php">
                            <a href="#" onclick="document.forms['yes'].submit();">
                              <button type="button" class="btn btn-success text-white">YES</button>
                            </a>
                            <input type="hidden" name="client_id" value='<?php echo $row["client_id"]; ?>'/>                            
                        </form>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                      </div>
                    </div>
                    
                  </div>
                </div>
                <?php
              }
                ?>
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