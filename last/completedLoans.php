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
           <title>List Of Completed Loans</title>  
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
                <h3 align="center">Completed Loans</h3>  
                <br />   
                     <table id="employee_data" class="table">  
                          <thead>  
                               <tr class="my-bg text-white">  
                                    <th class="my-bg">Name</th>
                                    <th class="my-bg">Remaining Balance</th>
                                    <th class="my-bg">Maturity Date</th>
                                    <th class="my-bg">Date Completed</th>
                               </tr>  
                          </thead>  
                    <?php                     
                            $sql1 = "SELECT loan_id,client_id from loan;";
                            $result = mysqli_query($conn,$sql1);
                            $resultCheck = mysqli_num_rows($result);

                            if($resultCheck > 0){
                                While ($row = mysqli_fetch_assoc($result)){
                                    $sql2 = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$row['loan_id']."";
                                    $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sql2));  
                                    $remaining = $rowRemain['rb']; 
                                    
                                    if($remaining <= 0){
                                        $sqlForList = "SELECT concat(first_name,' ',middle_name,' ',last_name) as name,maturity_date,MAX(date_paid) as date_complete from client JOIN loan on client.client_id = loan.client_id JOIN payment on loan.loan_id = payment.loan_id JOIN payment_info on payment.payment_id = payment_info.payment_id WHERE payment.loan_id=".$row['loan_id']."";
                                    
                                        $rowList = mysqli_fetch_assoc(mysqli_query($conn,$sqlForList));
                                            $name = htmlspecialchars($rowList['name']);


                                        ?>

                                        <tr>
                                        <td>
                                           <form class="pull-left" name="secret" method="post" action="transactions.php">
                                            <a href="#" onclick="document.forms['secret'].submit();"><button style="background: transparent; border: none; outline: none;"><?php echo $name?></button>&nbsp&nbsp</a>
                                            <input type="hidden" name="loan_id" value=<?php echo $row['loan_id']; ?>>
                                            </form>
                                        </td>
                                        <td>0</td>
                                        <td><?php echo $rowList['maturity_date']?></td>
                                        <td><?php echo $rowList['date_complete']?></td>   
                                        </tr>
                        <?php
                                    }
                                }
                            }
                        
                        
                        ?>
                     </table>
        <!-- Modal Update Delinquent-->
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Delinquent Status</h4>
                  </div>
                  <div class="modal-body">
                      <select id="status" class="form-control">
                        <option selected disabled>---- status ----</option>
                        <option>Active</option>
                        <option>Inactive</option>
                        <option>Legal</option>
                      </select>
                      <input type="hidden" id="ClientId" class="form-control">
                  </div>
                  <div class="modal-footer">
                    <a href="#" id="save" class="btn btn-primary pull-right">Update</a>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>
            <!-- Modal Update Remarks-->
            <div id="myEdit" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Remarks</h4>
                  </div>
                  <div class="modal-body">
                     <input type="text" id="remarks" class="form-control">
                  </div>
                  <div class="modal-footer">
                    <a href="#" id="saveRemarks" class="btn btn-primary pull-right">Update</a>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div> 
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