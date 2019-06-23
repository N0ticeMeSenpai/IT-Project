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
           <title>List Of All Types Of Delinquent Clients</title>  
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
                <h3 align="center">Delinquent List of All Types</h3>  
                <br />   
                     <table id="employee_data" class="table">  
                        <thead class="text-white">
                            <tr>
                                <th class="my-bg text-white">Account Name</th>
                                <th class="my-bg text-white" >Co Borrower</th>
                                <th class="my-bg text-white" >Co Borrower 2</th>
                                <th class="my-bg text-white">Balance</th>
                                <th class="my-bg text-white" >Date</th>
                            </tr>
                        </thead>
                    <?php 
                    include 'Include/connection.php';

                    $query = "SELECT * from client 
                    inner join loan on client.client_id = loan.client_id 
                    inner join payment on loan.loan_id = payment.loan_id
                    WHERE (maturity_date < (select curdate()) 
                    AND registered_status='Approved') AND loan_status!='Remove' group by loan.loan_id";

                    $result = mysqli_query($conn, $query);

                    while ($id = mysqli_fetch_assoc($result)) {

                      $loanID = $id['loan_id'];

                        $query1 = "SELECT loan.loan_id as loan, client.client_id 
                        as client,concat(first_name,' ',last_name) as `account_name`,
                        maturity_date from loan
                        inner join client on client.client_id = loan.client_id
                        inner join payment on payment.loan_id = loan.loan_id
                        WHERE loan.loan_id = '$loanID' group by loan.loan_id ORDER BY account_name";

                      $result1 = mysqli_query($conn, $query1);
                      
                  
                      while($row = mysqli_fetch_assoc($result1))
                      { 

                        $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(other_income),0) + COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$loanID."";
                          $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                          $remaining = $rowRemain['rb'];

                          if ($remaining > 0){
                              $account_name = htmlspecialchars($row["account_name"]);


                            echo '
                                  <tr>  
                                  <td>
                                     <form class="pull-left" name="secret" method="post" action="search.php">
                                      <a href="#" onclick="document.forms["secret"].submit();"><button style="background: transparent; border: none; outline: none;">'.$account_name.'</button>&nbsp&nbsp</a>
                                      <input type="hidden" name="loan_id" value='.$loanID.'>
                                      </form>
                                  </td>';
                 
                                  $forCoBorrower = "SELECT co_borrower.co_borrower_id,concat(co_first_name,' ', co_middle_name,' ',co_last_name) as name from co_borrower 
                                  join co_loan on co_borrower.co_borrower_id = co_loan.co_borrower_id
                                  where co_loan.loan_id ='".$row['loan']."'";
                                  $coBorrower = mysqli_query($conn, $forCoBorrower);
                                  $number_of_results = mysqli_num_rows($coBorrower);
                                  while($index = mysqli_fetch_array($coBorrower)){
                                      $co_name = htmlspecialchars($index['name']);

                                    if($number_of_results == 1){

                              echo '
                                    <td>'.$co_name.'</td>
                                    <td></td>';

                                  }else{

                                echo '
                                    <td>'.$co_name.'</td>';

                                  }
                            }

                            if (empty($number_of_results)) {

                            echo '<td></td>
                                  <td></td>';
                          }
                              $query1="SELECT date_paid,remarks from payment_info JOIN payment ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE payment.loan_id = $loanID && date_paid IS NOT NULL && date_paid=(SELECT MAX(date_paid) from payment_info JOIN payment ON payment_info.payment_id=payment.payment_id WHERE loan_id=$loanID) && (maturity_date > (select curdate()) AND loan.loan_id=$loanID) ORDER by payment_info.payment_id ASC;";
                              $datePaidRemarks = mysqli_fetch_assoc(mysqli_query($conn,$query1));  

                          echo '<td>'.$remaining.'</td> 
                                    <td>'.$row["maturity_date"].'</td>
                             </tr>';
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
                    //  append values in input fields
                      $(document).on('click','a[data-role=update]',function(){
                            var id  = $(this).data('id');
                            var status  = $('#'+id).children('td[data-target=status]').text();

                            $('#status').val(status);
                            $('#ClientId').val(id);
                            $('#myModal').modal('toggle');
                      });
                  //  append values in input fields
                      $(document).on('click','a[data-role=edit]',function(){
                            var id  = $(this).data('id');
                            var remarks  = $('#'+id).children('td[data-target=remarks]').text();

                            $('#remarks').val(remarks);
                            $('#ClientId').val(id);
                            $('#myEdit').modal('toggle');
                      });

                      // now create event to get data from fields and update in database 

                       $('#save').click(function(){
                          var id  = $('#ClientId').val(); 
                          var status =  $('#status').val();

                          $.ajax({
                              url      : 'DelinquentUpdate.php',
                              method   : 'post',  
                              data     : {id: id, status:status},

                              success  : function(response){
                                            // now update user record in table 
                                             $('#'+id).children('td[data-target=status]').text(status);
                                             $('#myModal').modal('toggle'); 
                                         }
                          });
                       });
                       $('#saveRemarks').click(function(){
                          var id  = $('#ClientId').val(); 
                          var remarks =  $('#remarks').val();

                          $.ajax({
                              url      : 'UpdateRemarks.php',
                              method   : 'post',  
                              data     : {id: id, remarks:remarks},

                              success  : function(response){
                                            // now update user record in table 
                                             $('#'+id).children('td[data-target=remarks]').text(remarks);
                                             $('#myEdit').modal('toggle'); 
                                             
                                         }
                          });
                       });
                  });
          </script> 

      </body>  
 </html>  