<?php

// php code to Update data from mysql database Table

if(isset($_POST['update']))
{
    
   $hostname = "localhost";
   $username = "root";
   $password = "";
   $databaseName = "sigma";
   
   $connect = mysqli_connect($hostname, $username, $password, $databaseName);
   
   // get values form input text and number
   
   $interest = $_POST['interest'];
   $service_handling_fee = $_POST['service_handling_fee'];
   $penalty_not_maturity = $_POST['penalty_not_maturity'];
   $penalty_maturity = $_POST['penalty_maturity'];
   $penalty_maturity_payontime = $_POST['penalty_maturity_payontime'];
           
   // mysql query to Update data
   $query = "UPDATE `rates` SET `interest`='".$interest."',`service_handling_fee`='".$service_handling_fee."',
   `penalty_not_maturity`= '".$penalty_not_maturity."',`penalty_maturity`= '".$penalty_maturity."',`penalty_maturity_payontime`= '".$penalty_maturity_payontime."'
   
   
   WHERE `rate_id` = 1";
   
   $result = mysqli_query($connect, $query);
   
   if($result)
   {
       echo 'Data Updated';
   }else{
       echo 'Data Not Updated';
   }
   mysqli_close($connect);
}

?>


  




<!DOCTYPE html>

<html>

    <head>

        <title> update rate</title>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body>

        <form action="" method="post">

            Update Interest: <input type="text" name="interest" required><br><br>
            Update service handling fee:<input type="text" name="service_handling_fee" required><br><br>
            Update Penalty not maturity: <input type="text" name="penalty_not_maturity" required><br><br>
            Update Penalty maturity: <input type="text" name="penalty_maturity" required><br><br>            
            Update Penalty maturity pay on time: <input type="text" name="penalty_maturity_payontime" required><br><br>         
            
            

            <input type="submit" name="update" value="Update Data">

        </form>

    </body>


</html>