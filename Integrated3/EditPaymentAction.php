<?php

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'sigma');


// initialize variables
    $id = 0;
    $payID = 0;
    $datePaid = "";
    $amtPaid = "";
    $paymentType = "";
    $accNumber = "";
    $checkNumber = "";
    $refNumber = "";
    $inter= "";
    $fines= "";
    $marks ="";
    $loan_idforR = "";
    $update = false;

//save

    //Update Start
    if(isset($_POST['update'])){
        $loan_id = $_POST['loan_id'];
        $payID = $_POST['id'];
        $datePaid = $_POST['datePaid'];
        $amtPaid = $_POST['amountPaid'];
        $paymentType = $_POST['paymentType'];
        $accNumber = $_POST['accountNo'];
        $checkNumber = $_POST['checkNo'];
        $refNumber = $_POST['refNo'];
        $marks = $_POST['remarks'];
        if($datePaid != ""){
       $sql = "UPDATE payment INNER JOIN payment_info ON payment.payment_id=payment_info.payment_id SET payment_info.date_paid='$datePaid', payment_info.amount_paid='$amtPaid', payment_info.payment_type='$paymentType', payment_info.account_number='$accNumber', payment_info.check_no='$checkNumber', payment_info.ref_no='$refNumber', payment_info.remarks='$marks', payment_info.status='Updated' WHERE payment_info.payment_info_id='$payID'"; 
            if(!mysqli_query($db, $sql)){
            echo "Error: " . mysqli_error($db);
        }
        }
    ?>
    //Update End
<html> 
<body>
<form name='forSearch' action='EditPayment.php' method='POST'>
<input type=hidden name='loan_idforR' value="<?php echo $loan_id; ?>">  
</form>
</body>    

<script type='text/javascript'>
document.forSearch.submit();
</script>
</html>

<?php }
?>  

