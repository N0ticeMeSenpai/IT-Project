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
<?php

header('Cache-Control: no cache');

include "Include/connection.php";
    
$client_id =$_POST['client_id'];

      
?>        
    <!DOCTYPE html>
<html>
<head>
    
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    
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
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <script src="js/ajax.js"></script>
    <script src="js/bootstrap.min.js"></script>

  <title></title>
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
                  
                  <?php
                    echo navigate_right();

                  ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container pad-1">
      <h2 class="p-5 text-center">Transactions Of Client</h2>
      <form class="text-center" method="POST" action="scheduleExcel.php">
        <div class="py-3 ">
            <input style="width:20%;" class="i-3 pull-right" name="exportSchedule" type="submit" value="Export Transactions">
        </div>
        <?php
    
                       $sql1 = "SELECT * FROM client join loan on client.client_id = loan.client_id where client.client_id='".$client_id."' ORDER by maturity_date DESC;";
                        $result2 = mysqli_query($conn,$sql1);
                        $resultCheck2 = mysqli_num_rows($result2);
                        if($resultCheck2 > 0){
                        While ($row1 = mysqli_fetch_assoc($result2)){
                                        $sql2 = "SELECT due_date,remaining_balance FROM payment WHERE loan_id='".$row1['loan_id']."' ORDER by due_date ASC";
                            $first_name = htmlspecialchars($row1['first_name']);
                    $middle_name = htmlspecialchars($row1['middle_name']);
                    $last_name = htmlspecialchars($row1['last_name']);
                    $date_booked = htmlspecialchars($row1['date_booked']);
                    $interest  = htmlspecialchars($row1['interest_rate']);
                    $bi_monthly = htmlspecialchars($row1['bi_monthly']);
                    $maturity_date = htmlspecialchars($row1['maturity_date']);
                    
            
            ?> 
      
            <?php 

            $row4 = mysqli_fetch_assoc(mysqli_query($conn,$sql1));
              ?>
            <input type="hidden" name="choice" value="<?php echo $row4['first_name'] ,' ',$row4['middle_name'], ' ', $row4['last_name']; ?>">
        </form>
        
        <table class="table">
            <br>
            <p>                           
            <div class="row">
                <div class="col-sm-6" style="font-size:30px;">
                    <p><strong> Name:</strong> <a href="Profile.php?loan_id=<?php echo $row1["loan_id"]?> "> 
                      <?php echo $first_name ,' ',$middle_name, ' ', $last_name; ?></a></p>
                </div>
            </div>
            <div class="row">
                <?php if($_SESSION['user']['em_position']=='Operations Manager'){ ?>
                <div class="col-md-4">
                    <form method="post" action="transactionsHistory.php">
                       <input type="hidden" name="loan_idforR" value='<?php echo $row1['loan_id']; ?>' />
                       <input class="i-3 float-right" type="submit" value="History of Transactions" />
                    </form>
                
                </div>
              <?php }?>
          </div>
          <?php 
                if($row1['loan_status'] == 'Normal'){
                ?>
            
          <div class="row">
            <div class="col-sm-3"><strong>Date Booked: </strong><?php echo $date_booked; ?></div>
            <div class="col-sm-3"><strong>Interest: </strong><?php echo $interest,'%'; ?></div>
            <div class="col-sm-3"><span><strong>Bi-Monthly Payment:</strong> <?php echo $bi_monthly; ?></span></div>
            <div class="col-sm-3">
              <span>
                <strong>Maturity Date:</strong>  <?php echo $maturity_date; ?>
              </span>
            </div>
          </div>
            <?php 
                }else{
                    
                
            ?>
            <div class="row">
                <h2> RESTRUCTURED</h2>
            <div class="col-sm-4"><strong>Date Booked: <?php echo $date_booked; ?></strong></div>
                <div class="col-sm-4"><strong>Bi-Monthly Payment: <?php echo $bi_monthly ?></strong></div>    
            <div class="col-sm-4">
              <span>
                <strong>Maturity Date:</strong>  <?php echo $maturity_date; ?>
              </span>
            </div>
          </div>
            
            
            
            
            <?php 
                }
            ?>
           <thead class="text-white">
            <tr>
              <th class="my-bg">Date</th>
              <th class="my-bg">Check # EW</th>
              <th class="my-bg">Ref/OR#</th>
              <th class="my-bg">Payment</th>
              <th class="my-bg">Interest</th>
              <th class="my-bg">Fines</th>
              <th class="my-bg">Balance</th>
              <th class="my-bg">Other Income</th>
            </tr>
          </thead>
            
            <tbody id="myTable">
                <tr>
                    <td></td> 
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php echo $row1['loan_balance']; ?></td>
                </tr>
            <?php
                $result3 = mysqli_query($conn,$sql2);
                $resultCheck1 = mysqli_num_rows($result3);
                if($resultCheck1 > 0){
                    While ($row3 = mysqli_fetch_assoc($result3)){
                        $sqlForPayInfo = "SELECT payment.payment_id as pid,GROUP_CONCAT(payment_type) as payment_type,GROUP_CONCAT(check_no) as check_no,GROUP_CONCAT(ref_no) as ref_no,SUM(amount_paid) as amount_paid,SUM(interest) as interest,SUM(fines) as fines,GROUP_CONCAT(remarks) as remarks,SUM(other_income) as other_income FROM payment_info JOIN payment ON payment.payment_id = payment_info.payment_id WHERE (status ='updated' || status is NULL) && due_date='".$row3['due_date']."' && loan_id='".$row1['loan_id']."' group by payment.payment_id;";
                        $rowForPayInfo = mysqli_fetch_assoc(mysqli_query($conn,$sqlForPayInfo));
                        
                        $sqlForCheck = "SELECT check_no from payment_info JOIN payment on payment.payment_id = payment_info.payment_id WHERE loan_id='".$row1['loan_id']."' && check_no IS NOT NULL && status= 'Updated'";
                        
                        

            ?>
  
            <tr>
              <td><?php echo $row3['due_date']; ?></td> 
              <td><?php echo $rowForPayInfo['check_no']; ?></td>
              <td><?php echo $rowForPayInfo['ref_no']; ?></td>
              <td><?php echo $rowForPayInfo['amount_paid']; ?></td>
              <td><?php echo $rowForPayInfo['interest']; ?></td>
              <?php if($rowForPayInfo['fines']>0){
                    ?>
              <td style="color:red"> <?php echo $rowForPayInfo['fines'];?></td>
                    
                    <?php }else{ ?>
               <td> <?php echo $rowForPayInfo['fines'];
             }?></td>

              <td><?php echo $row3['remaining_balance'];?></td>
              <td><?php echo $rowForPayInfo['other_income'];?></td>

             
            <?php
                    }
                ?>
          <?php
                


                    
                    }
                      
              }
            }else{
                
                 
            ?>
            <table>
           <thead class="text-white">
            <tr>
              <th class="my-bg">Date</th>
              <th class="my-bg">Check # EW</th>
              <th class="my-bg">Ref/OR#</th>
              <th class="my-bg">Payment</th>
              <th class="my-bg">Interest</th>
              <th class="my-bg">Fines</th>
              <th class="my-bg">Balance</th>
              <th class="my-bg">Remarks</th>
              <th class="my-bg">Payment</th>

            </tr>
          </thead>
            </table>
            
            <b> NO CLIENT WITH THAT NAME</b>
            
            <?php
            } 
            ?>

        </table>
    </div>    
  </div>
      <script type="text/javascript" src="js/modal.js"></script>
    <script type="text/javascript" src="js/custom.js"></script> 
      
</body>
</html>
