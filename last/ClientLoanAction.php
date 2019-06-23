<?php
include "Include/connection.php";
$number = count($_POST["due"]);
$due = mysqli_real_escape_string($conn,$_POST['due']['0']);
$client_id = mysqli_real_escape_string($conn,$_POST['client_id']);
$amount = mysqli_real_escape_string($conn,$_POST['amount']);
$interest = mysqli_real_escape_string($conn,$_POST['interest']);
$mat_date = mysqli_real_escape_string($conn, $_POST["due"][$number-1]);
$loan_class = mysqli_real_escape_string($conn,$_POST['loan_class']);
$shf = mysqli_real_escape_string($conn,$_POST['shf']);
$insurance = mysqli_real_escape_string($conn,$_POST['insurance']);
$loan_type = mysqli_real_escape_string($conn,$_POST['loan_type']);
$id2 = mysqli_real_escape_string($conn,$_POST['loan_id']);

    $co_first_name_one = mysqli_real_escape_string($conn, $_POST['co_first_name_one']);
    $co_middle_name_one = mysqli_real_escape_string($conn, $_POST['co_middle_name_one']);
    $co_last_name_one = mysqli_real_escape_string($conn, $_POST['co_last_name_one']);
    $co_contact_no_one = mysqli_real_escape_string($conn, $_POST['co_contact_no_one']);
    $co_address_one = mysqli_real_escape_string($conn, $_POST['co_address_one']);
    $co_business_address_one = mysqli_real_escape_string($conn, $_POST['co_business_address_one']);
    $co_name_of_firm_one = mysqli_real_escape_string($conn, $_POST['co_name_of_firm_one']);
    $co_employment_one = mysqli_real_escape_string($conn, $_POST['co_employment_one']);
    $co_position_one = mysqli_real_escape_string($conn, $_POST['co_position_one']);

    //Co Borrower _two Table    
    $co_first_name_two = mysqli_real_escape_string($conn, $_POST['co_first_name_two']);
    $co_middle_name_two = mysqli_real_escape_string($conn, $_POST['co_middle_name_two']);
    $co_last_name_two = mysqli_real_escape_string($conn, $_POST['co_last_name_two']);
    $co_contact_no_two = mysqli_real_escape_string($conn, $_POST['co_contact_no_two']);
    $co_address_two = mysqli_real_escape_string($conn, $_POST['co_address_two']);
    $co_business_address_two = mysqli_real_escape_string($conn, $_POST['co_business_address_two']);
    $co_name_of_firm_two = mysqli_real_escape_string($conn, $_POST['co_name_of_firm_two']);
    $co_employment_two = mysqli_real_escape_string($conn, $_POST['co_employment_two']);
    $co_position_two = mysqli_real_escape_string($conn, $_POST['co_position_two']);

    
        $sqlForCoBow2 = "SELECT co_borrower_id from co_borrower WHERE co_first_name = '$co_first_name_two' && co_middle_name='$co_middle_name_two' && co_last_name='$co_last_name_two'";
        $CoBow2 = mysqli_fetch_assoc(mysqli_query($conn,$sqlForCoBow2));
        $co_borrower_id2 = $CoBow2['co_borrower_id'];

         $sqlForCoBow = "SELECT co_borrower_id from co_borrower WHERE co_first_name = '$co_first_name_one' && co_middle_name='$co_middle_name_one' && co_last_name='$co_last_name_one'";
        $CoBow = mysqli_fetch_assoc(mysqli_query($conn,$sqlForCoBow));
        $co_borrower_id = $CoBow['co_borrower_id'];

    
        $sqlForAmountCoBow = "SELECT coalesce(SUM(loan_balance),0) as lb from co_borrower join co_loan on co_loan.co_borrower_id = co_borrower.co_borrower_id join loan on loan.loan_id = co_loan.loan_id WHERE co_borrower.co_borrower_id ='$co_borrower_id'";
        $AmountCoBow = mysqli_fetch_assoc(mysqli_query($conn,$sqlForAmountCoBow));
        $Amount = $AmountCoBow['lb'];

        $sqlForAmountCoBow2 = "SELECT coalesce(SUM(loan_balance),0) as lb from co_borrower join co_loan on co_loan.co_borrower_id = co_borrower.co_borrower_id join loan on loan.loan_id = co_loan.loan_id WHERE co_borrower.co_borrower_id ='$co_borrower_id2'";
        $AmountCoBow2 = mysqli_fetch_assoc(mysqli_query($conn,$sqlForAmountCoBow2));
        $Amount2 = $AmountCoBow['lb'];
        $array = array();

        for ($x = 0; $x < $number; $x++) {
            $array[$x] = $_POST['due'][$x];
        }
        
         ?>
    <html>
<head>
<script type="text/javascript">
<!--
 window.onload = function() {
  confirmation();
};
function confirmation() {
	var answer = confirm("<?php echo $co_first_name_one,'- co borrowed amount is ',$Amount,'\n',$co_first_name_two,'- co borrowed amount is ',$Amount2,'\nIs this okay?'?>");
    if (answer){
		document.forLoan.submit();
    }else{
        document.resend.submit();
	}
}
//-->
</script>
</head>
<body>
<form name='forLoan' action='ClientLoanActionAction.php' method='POST'>
    <input type="hidden" value="<?php echo $number?>" name="number">
    <?php 
        foreach($array as $value)
        {
          echo '<input type="hidden" name="result[]" value="'. $value. '">';
        }
    ?>
    <input type="hidden" value="<?php echo $client_id?>" name="client_id">
    <input type="hidden" value="<?php echo $amount?>" name="amount">
    <input type="hidden" value="<?php echo $interest?>" name="interest">
    <input type="hidden" value="<?php echo $mat_date?>" name="mat_date">
    <input type="hidden" value="<?php echo $loan_class?>" name="loan_class">
    <input type="hidden" value="<?php echo $shf?>" name="shf">
    <input type="hidden" value="<?php echo $insurance?>" name="insurance">
    <input type="hidden" value="<?php echo $loan_type?>" name="loan_type">
    <input type="hidden" value="<?php echo $id2?>" name="loan_id">

    
    <input type="hidden" value="<?php echo $co_first_name_one?>" name="co_first_name_one">
    <input type="hidden" value="<?php echo $co_middle_name_one?>" name="co_middle_name_one">
    <input type="hidden" value="<?php echo $co_last_name_one?>" name="co_last_name_one">
    <input type="hidden" value="<?php echo $co_contact_no_one?>" name="co_contact_no_one">
    <input type="hidden" value="<?php echo $co_address_one?>" name="co_address_one">
    <input type="hidden" value="<?php echo $co_business_address_one?>" name="co_business_address_one">
    <input type="hidden" value="<?php echo $co_name_of_firm_one?>" name="co_name_of_firm_one">
    <input type="hidden" value="<?php echo $co_employment_one?>" name="co_employment_one">
    <input type="hidden" value="<?php echo $co_position_one?>" name="co_position_one">
    
    <input type="hidden" value="<?php echo $co_first_name_two?>" name="co_first_name_two">
    <input type="hidden" value="<?php echo $co_middle_name_two?>" name="co_middle_name_two">
    <input type="hidden" value="<?php echo $co_last_name_two?>" name="co_last_name_two">
    <input type="hidden" value="<?php echo $co_contact_no_two?>" name="co_contact_no_two">
    <input type="hidden" value="<?php echo $co_address_two?>" name="co_address_two">
    <input type="hidden" value="<?php echo $co_business_address_two?>" name="co_business_address_two">
    <input type="hidden" value="<?php echo $co_name_of_firm_two?>" name="co_name_of_firm_two">
    <input type="hidden" value="<?php echo $co_employment_two?>" name="co_employment_two">
    <input type="hidden" value="<?php echo $co_position_two?>" name="co_position_two">
</form>
 <form name='resend' action='ClientLoan.php' method='POST'>
	<input type="hidden" value="<?php echo $client_id?>" name="client_id">
    <input type="hidden" value="<?php echo $id2?>" name="loan_id">
 </form>
</body>
</html>
