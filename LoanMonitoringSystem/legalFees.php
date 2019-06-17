<?php

include 'Include/connection.php';

$fee = mysqli_real_escape_string($conn,$_POST['fee']);
$loan_id = mysqli_real_escape_string($conn,$_POST['loan_id']);
$search = mysqli_real_escape_string($conn,$_POST['search']);
//edited due date
 $sql = "INSERT INTO `payment_info`(`payment_id`,other_income,remarks,date_paid) VALUES ((SELECT MAX(payment_id) FROM (SELECT * FROM payment) AS `payment` where loan_id='$loan_id' && due_date=(SELECT MAX(due_date) from payment where loan_id='$loan_id')),$fee,'Income from legal fees',(SELECT CURRENT_DATE));";
        if(!mysqli_query($conn, $sql)){
            echo "Error: " . mysqli_error($conn);
 }
$sql1 = "SELECT due_date FROM payment WHERE loan_id='$loan_id' && payment_id IN (SELECT payment_id FROM payment_info WHERE status='updated' && loan_id='$loan_id');";
    $result = mysqli_query($conn,$sql1);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0){
        While ($row = mysqli_fetch_assoc($result)){

            $sql2 = "UPDATE payment SET remaining_balance=(SELECT CEILING((loan_balance+SUM(fines)+SUM(interest)+SUM(other_income)-(SUM(amount_paid)))) as remaining_balance FROM (SELECT * FROM payment) AS `payment` JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE due_date <= '".$row['due_date']."' && payment.loan_id='$loan_id' && status='updated') WHERE loan_id='$loan_id' && due_date='".$row['due_date']."'";
            
             if (!mysqli_query($conn,$sql2)) {
            echo "Error: " . mysqli_error($conn);

            }
        }
    }
?>
<html> 
<body>
<form name='forSearch' action='search.php' method='POST'>
<input type=hidden name='loan_id' value="<?php echo $loan_id; ?>">  
</form>
</body>    

<script type='text/javascript'>
document.forSearch.submit();
</script>
</html>