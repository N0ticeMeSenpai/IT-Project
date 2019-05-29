<?php
	include 'EditPaymentAction.php';
    $loan_idforR = mysqli_real_escape_string($db,$_POST['loan_idforR']);

?>

<!DOCTYPE html>
<html lang="en">

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

    <title>Edit Payment</title>
<div class="container">

            <h2 class="p-5 text-center">History of Transactions</h2>
            <br><br>

            <table>
                    <thead class="text-white">
                        <tr>
                        <th class="my-bg">Remaining Balance</th>
                        <th class="my-bg" width="10%"><?php echo $loan_idforR ?></th>
                        <th class="my-bg">Amount Paid</th>
                        <th class="my-bg">Payment Type</th>
                        <th class="my-bg">Account Number</th>
                        <th class="my-bg">Check Number</th>
                        <th class="my-bg">Ref Number</th>
                        <th class="my-bg">Interest</th>
                        <th class="my-bg">Fines</th>
                        <th class="my-bg" width="30%">Remarks</th>
                        <th class="my-bg">Status</th>
                        <th class="my-bg">Action</th>
                        </tr>
                    </thead>
  
  <!-- populate table from mysql database -->
                <?php
                $paymentInfo = mysqli_query($db, "SELECT payment_info_id,payment.remaining_balance, payment_info.payment_id, payment.due_date, payment.loan_id, payment_info.date_paid, payment_info.amount_paid, payment_info.payment_type, payment_info.account_number, payment_info.check_no, payment_info.ref_no, payment_info.interest, payment_info.fines, payment_info.remarks, payment_info.status FROM payment INNER JOIN payment_info ON payment_info.payment_id=payment.payment_id WHERE loan_id=".$loan_idforR."");
                while($row = mysqli_fetch_array($paymentInfo)) { ?>
                <tr>
                    <td><?php echo $row['remaining_balance'];?></td>
                    <td><?php echo $row['date_paid'];?></td>
                    <td><?php echo $row['amount_paid'];?></td>
                    <td><?php echo $row['payment_type'];?></td>
                    <td><?php echo $row['account_number'];?></td>
                    <td><?php echo $row['check_no'];?></td>
                    <td><?php echo $row['ref_no'];?></td>
                    <td><?php echo $row['interest'];?></td>
                    <td><?php echo $row['fines'];?></td>
                    <td><?php echo $row['remarks'];?></td>
                    <td><?php echo $row['status'];?></td>
                    <td>
                    <form method="post" action="EditPaymentUpdate.php">
                       <input type="hidden" name="loan_idforR" value='<?php echo $loan_idforR ?>' />
                       <input type="hidden" name="edit" value='<?php echo $row['payment_info_id']; ?>' />
                       <input type="submit" value="Edit" />
                    </form>
                    </td>
                </tr>
                <?php } ;?>
            </table>
        </div>
        
    <!-- OJT PROJECT CSS-->
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
</head>

<body>
                   

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->

    <script>
        //custom select box

        $(function() {
            $('select.styled').customSelect();
        });

    </script>

</body>

</html>
