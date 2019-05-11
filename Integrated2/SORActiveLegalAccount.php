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


    <title>Active Legal Account</title>

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

            <h2 class="p-5 text-center"> Active Legal Account</h2>


            <h3>Salary Account</h3>

            <br><br>

            <table class="table">
                <thead class="text-white">
                    <tr>
                        <th class="my-bg text-white">Account Name</th>
                        <th class="my-bg text-white" >Remaining Balance</th>
                        <th class="my-bg text-white">Action</th>
                    </tr>
                </thead>

                <?php
                    echo Salary_ActiveLegalAccount();

                    ?>
            </table>
            <div class="row">
                <div class="col">
                    <div class="pagination-wrap pull-right">
                        <ul class="pagination pagination-v3">

                        <?php
                            echo page_SalaryLegal();

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
                        <th class="my-bg text-white">Action</th>
                    </tr>
                </thead>

                <?php
                    echo  Business_ActiveLegalAccount();
                    
                    ?>

            </table>
            <div class="row">
                <div class="col">
                    <div class="pagination-wrap pull-right">
                        <ul class="pagination pagination-v3">

                        <?php
                            echo page_BusinessLegal();

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
                <!-- Modal Update-->
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
                <a href="SORActiveLegalAccount.php" id="save" class="btn btn-primary pull-right">Update</a>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>

    <script type="text/javascript" src="js/Table.js"></script>
    <script type="text/javascript" src="js/modal.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script>
      $(document).ready(function(){

        //  append values in input fields
          $(document).on('click','a[data-role=update]',function(){
                var id  = $(this).data('id');
                var status  = $('#'+id).children('td[data-target=status]').text();

                $('#status').val(status);
                $('#ClientId').val(id);
                $('#myModal').modal('toggle');
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
      });
    </script>
</body>

</html>
