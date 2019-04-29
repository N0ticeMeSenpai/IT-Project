<?php  
    include 'delinquentFunction.php';
    include 'navigation.php';
    include 'notification_fetch.php';
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
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link rel="stylesheet" type="text/css" href="css/notification.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min2.css">
    <link rel="stylesheet" type="text/css" href="css/navigation.css">
    <link rel="stylesheet" type="text/css" href="css/navigation2.css">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>List of Delinquents</title>

</head>

<body>
    <div class=" no-padding">
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

            <h2 class="p-5 text-center">List of Delinquents</h2>

            <form action="SearchDelinquents.php" method="post">
                <div class="pad-2" id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input type="text" name="searchDelinquents" class="  search-query form-control" placeholder="Search" id="myInput">
                        <span class="input-group-btn">
                            <input class="btn btn-success" type="submit" name="submit-delinquents" value="Search">
                        </span>
                    </div>
                </div>
            </form>


            <br><br>

            <table class="table">
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
                    $conn=mysqli_connect('localhost','root','','sigma');

                    $query = "SELECT loan.loan_id as id from loan
                              inner join client on client.client_id = loan.client_id
                              inner join payment on payment.loan_id = loan.loan_id
                              inner join co_borrower on client.client_id = co_borrower.client_id
                              WHERE maturity_date < (select curdate()) AND remaining_balance!=0 group by id ORDER BY maturity_date DESC";

                    $result = mysqli_query($conn, $query);

                    while ($id = mysqli_fetch_assoc($result)) {

                              $query1 = "SELECT loan.loan_id as loan, client.client_id 
                              as client,concat(first_name,' ',last_name) as `account_name`,
                              remaining_balance, maturity_date from loan
                              inner join client on client.client_id = loan.client_id
                              inner join payment on payment.loan_id = loan.loan_id
                              WHERE loan.loan_id = ".$id['id']." group by loan.loan_id";

                       $result1 = mysqli_query($conn, $query1);
                        
                            while($row = mysqli_fetch_assoc($result1))
                            { 
                              ?>
                                    <tr>  
                                        <td><a href="Profile.php?client_id=<?php echo $row["client"] ?>"><?php echo $row["account_name"] ?></a></td>
                                       
                                       <?php 
                                        $forCoBorrower = "SELECT co_borrower_id,concat(co_first_name,co_last_name) as name from co_borrower WHERE client_id ='".$row['client']."'";
                                        $coBorrower = mysqli_query($conn, $forCoBorrower);
                                        while($output = mysqli_fetch_array($coBorrower)){
                                          ?>

                                          <td><a href="co_profile.php?co_borrower_id=<?php echo $output["co_borrower_id"]?> "> <?php echo $output['name']?></a> </td>

                                       <?php } ?>
                                       <?php

                                       $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$row['loan']."";

                                        $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                                        $remaining = $rowRemain['rb'];

                                       ?>
                                        <td><?php echo $remaining?></td> 
                                        <td><?php echo $row["maturity_date"]?></td>
                                   </tr>

                            <?php 
                              }
                            } 
                            ?>
                    
            </table>
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
    <script type="text/javascript" src="js/Table.js"></script>
    <script type="text/javascript" src="js/modal.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
</body>

</html>
