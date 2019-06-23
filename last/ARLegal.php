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
           <title>List Of Legal Account</title>  
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
                <h3 align="center">List Of Legal Account</h3>  
                <br />   
                     <table id="employee_data" class="table">  
                          <thead>  
                               <tr class="my-bg text-white">  
                                    <th>Account Name</th>  
                                    <th>Remaining</th>
                                    <th>Remarks</th>
                                    <th>Date (As Of)</th>
                                    <th>Interval</th> 
                                    <th>Loan Type</th>
                               </tr>  
                          </thead>  
                          <?php
                          include "Include/connection.php";
                             $query ="SELECT * from client 
                                inner join loan on client.client_id = loan.client_id 
                                inner join payment on loan.loan_id = payment.loan_id
                                WHERE registered_status='Approved' AND loan_status!='Remove' 
                                AND delinquent_status = 'Legal' group by loan.loan_id;";  
                             $result = mysqli_query($conn, $query);

                          while($row = mysqli_fetch_array($result))
                            {         
                              $id = $row['loan_id'];
                              $output='';
                              $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(other_income),0) + COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id='$id'";

                                  $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                                  $remaining = $rowRemain['rb'];
                                  $remarks= $row['loan_remarks'];
                                  $remarking = htmlspecialchars($remarks);
                                  $first_name = htmlspecialchars($row["first_name"]);
                                  $middle_name = htmlspecialchars($row["middle_name"]);
                                  $last_name = htmlspecialchars($row["last_name"]);


                          if ($remaining > 0){

                          $query1="SELECT date_paid,remarks from payment_info JOIN payment ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE payment.loan_id = $id && date_paid IS NOT NULL && date_paid=(SELECT MAX(date_paid) from payment_info JOIN payment ON payment_info.payment_id=payment.payment_id WHERE loan_id=$id) AND loan.loan_id=$id AND loan.delinquent_status = 'Legal' ORDER by payment_info.payment_id ASC;";
                            $datePaidRemarks = mysqli_fetch_assoc(mysqli_query($conn,$query1));
                            $date_paid=$datePaidRemarks['date_paid'];

                          if (!empty($date_paid)) {
                            
                                $query2="SELECT DATE_ADD('$date_paid', INTERVAL 30 DAY) as date_paid FROM sigma.payment_info";
                                $interval1 = mysqli_fetch_assoc(mysqli_query($conn,$query2));
                                $query3="SELECT DATE_ADD('$date_paid', INTERVAL 60 DAY) as date_paid FROM sigma.payment_info";
                                $interval2 = mysqli_fetch_assoc(mysqli_query($conn,$query3));
                                $query4="SELECT DATE_ADD('$date_paid', INTERVAL 90 DAY) as date_paid FROM sigma.payment_info";
                                $interval3 = mysqli_fetch_assoc(mysqli_query($conn,$query4));
                                $query5="SELECT DATE_ADD('$date_paid', INTERVAL 120 DAY) as date_paid FROM sigma.payment_info";
                                $interval4 = mysqli_fetch_assoc(mysqli_query($conn,$query5));

                                    echo '
                                          <tr id='. $row['loan_id'] .'>
                                              <td>
                                                 <form class="pull-left" name="secret" method="post" action="search.php">
                                                  <a href="#" onclick="document.forms["secret"].submit();"><button style="background: transparent; border: none; outline: none;">'.$first_name.' '.$middle_name.' '.$last_name.'</button>&nbsp&nbsp</a>
                                                  <input type="hidden" name="loan_id" value='.$row["loan_id"].'>
                                                  </form>
                                              </td>
                                              <td>'.$remaining.'</td>
                                              <td data-target="remarks">'.$remarking.'</td>
                                              <th>'.$date_paid.'</th>
                                              <td>';

                                        if ($interval1['date_paid'] >= date("Y-m-d")) {
                                          echo "30 days";

                                        
                                        }elseif (date("Y-m-d") > $interval1['date_paid'] AND $interval2['date_paid'] >= date("Y-m-d")){
                                          echo "60 days";

                                        }elseif(date("Y-m-d") > $interval2['date_paid'] AND $interval3['date_paid'] >= date("Y-m-d")){
                                          echo "90 days";                                                   

                                        }elseif($interval3['date_paid'] < date("Y-m-d")){
                                          echo "120 days & over";
                                        

                                        }
                                    echo  '   </td>
                                              <td>'.$row["loan_type"].'</td>
                                          </tr>';
                                  }
                                }
                              }  
                          ?>  
                     </table>
                     <table class="table" style="margin-top: 50px;">  
                          <thead>  
                               <tr class="my-bg text-white">  
                                    <th></th>  
                                    <th>30 days</th>
                                    <th>60 days</th>
                                    <th>90 days</th>
                                    <th>120 & Over</th> 
                                    <th>Total of All interval</th>
                               </tr>  
                          </thead>  
                          <?php
                          $count1=0;
                          $count2=0;
                          $count3=0;
                          $count4=0;
                          $countA=0;
                         include "Include/connection.php";
                             $query ="SELECT * from client 
                                inner join loan on client.client_id = loan.client_id 
                                inner join payment on loan.loan_id = payment.loan_id
                                WHERE registered_status='Approved' AND loan_status!='Remove'
                                AND delinquent_status = 'Legal' group by loan.loan_id;";  
                             $result = mysqli_query($conn, $query);

                          while($row = mysqli_fetch_array($result))
                            {         
                              $id = $row['loan_id'];
                              $output='';
                              $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=$id";
                                  $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                                  $remaining = $rowRemain['rb'];

                          if ($remaining > 0){

                          $query1="SELECT date_paid,remarks from payment_info JOIN payment ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE payment.loan_id = $id && date_paid IS NOT NULL && date_paid=(SELECT MAX(date_paid) from payment_info JOIN payment ON payment_info.payment_id=payment.payment_id WHERE loan_id=$id) AND loan.loan_id=$id AND loan.delinquent_status = 'Legal' ORDER by payment_info.payment_id ASC;";
                            $datePaidRemarks = mysqli_fetch_assoc(mysqli_query($conn,$query1));
                            $date_paid=$datePaidRemarks['date_paid'];

                          if (!empty($date_paid)) {
                            
                                $query2="SELECT DATE_ADD('$date_paid', INTERVAL 30 DAY) as date_paid FROM sigma.payment_info";
                                $interval1 = mysqli_fetch_assoc(mysqli_query($conn,$query2));
                                $query3="SELECT DATE_ADD('$date_paid', INTERVAL 60 DAY) as date_paid FROM sigma.payment_info";
                                $interval2 = mysqli_fetch_assoc(mysqli_query($conn,$query3));
                                $query4="SELECT DATE_ADD('$date_paid', INTERVAL 90 DAY) as date_paid FROM sigma.payment_info";
                                $interval3 = mysqli_fetch_assoc(mysqli_query($conn,$query4));
                                $query5="SELECT DATE_ADD('$date_paid', INTERVAL 120 DAY) as date_paid FROM sigma.payment_info";
                                $interval4 = mysqli_fetch_assoc(mysqli_query($conn,$query5));

                                if ($interval1['date_paid'] >= date("Y-m-d")) {

                                    $count1+=$remaining;
                                              
                                  }elseif(date("Y-m-d") > $interval1['date_paid'] AND $interval2['date_paid'] >= date("Y-m-d")){

                                    $count2+=$remaining;

                                  }elseif(date("Y-m-d") > $interval2['date_paid'] AND $interval3['date_paid'] >= date("Y-m-d")){
           
                                    $count3+=$remaining;

                                  }else{
                                              
                                    $count4+=$remaining;

                                    }
                                  }
                                }
                              }
                                $countA = $count1+$count2+$count3+$count4;
                                echo '<tr>
                                          <td>Total</td>
                                          <td>'.$count1.'</td>
                                          <td>'.$count2.'</td>
                                          <td>'.$count3.'</td>
                                          <td>'.$count4.'</td>
                                          <td>'.$countA.'</td>
                                      </tr>';  
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