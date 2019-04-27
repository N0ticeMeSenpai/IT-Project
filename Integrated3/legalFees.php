<?php
    $con = mysqli_connect('127.0.0.1','root','');
    
    if(!$con){
        echo 'Not Connected To Server';
    }
    
    if(!mysqli_select_db($con,'sigma')){
        echo 'Not Selected';
    }


$fee = mysqli_real_escape_string($con,$_POST['fee']);
$loan_id = mysqli_real_escape_string($con,$_POST['loan_id']);
$search = mysqli_real_escape_string($con,$_POST['search']);

 $sql = "INSERT INTO `payment_info`(`payment_id`,other_income,remarks) VALUES ((SELECT MAX(payment_id) FROM (SELECT * FROM payment) AS `payment` where loan_id='$loan_id'),$fee,'Income from legal fees');";
        if(!mysqli_query($con, $sql)){
            echo "Error: " . mysqli_error($con);
 }
?>
<html> 
<body>
<form name='forSearch' action='search.php' method='POST'>
<input type=hidden name='search' value="<?php echo $search; ?>">  
</form>
</body>    

<script type='text/javascript'>
document.forSearch.submit();
</script>
</html>