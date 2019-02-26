<?php
    $con = mysqli_connect('127.0.0.1','root','');
    
    if(!$con){
        echo 'Not Connected To Server';
    }
    
    if(!mysqli_select_db($con,'sigma')){
        echo 'Not Selected';
    }

    $search = $_POST['search'];
    
    $sql = "SELECT * FROM person WHERE last_name='$search';";
    $result = mysqli_query($con,$sql);
    $result1 = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $resultCheck = mysqli_num_rows($result);
    

    $sql1 = "SELECT * FROM loan where customer_id='".$row['customer_id']."';";
    $result2 = mysqli_query($con,$sql1);
    $row1 = mysqli_fetch_assoc($result2);


    
 
      
?>        
    <!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/custom.css">
  <link rel="stylesheet" type="text/css" href="css/table.css">
  <link rel="stylesheet" type="text/css" href="css/modal.css">
  <link rel="stylesheet" type="text/css" href="css/navigation2.css">
  <title></title>
</head>
<body>
  <div class="container-fluid no-padding">
    <div class="topnav">
      <div class="topnav-right">
        <a href="AdminIndex.html">Home</a>
        <a href="AdminList.html">List of Clients</a>
        <a href="AdminDelinquents.html">List of Delinquents</a>
        <a href="help.html">Help</a>
      </div>
    </div> 
    <div class="container">
      <h2 class="p-5 text-center">List Of Clients</h2>
        <form action="search.php" method="post">
        <input id="myInput" type="text" placeholder="Search.." name="search">                   <input type="submit" value="Search">
        </form>    
        <br>
        <hr>
        <p> Name: <?php echo $row['first_name'] ,' ', $row['last_name']; ?></p>
        <p>Date Booked: <?php echo $row1['date_booked']; ?> <span class="float-right">Maturity Date: <?php echo $row1['maturity_date']; ?></span></p>
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

            </tr>
          </thead>
            <?php
            if($resultCheck > 0){
                While ($row2 = mysqli_fetch_assoc($result1)){
            
            ?>
            <tbody id="myTable">
            <tr>
              <td>9/17/2018</td> 
              <td>115625</td>
              <td>16189</td>
              <td><?php echo $row2['last_name']; ?></td>
              <td></td>
              <td>1967</td>
              <td>163233</td>
              <td></td>
            </tr>
            
            </tbody>
            <?php
              }
            }      
            ?>

        </table>
    </div>
  </div>
<button id="myBtn" style="font-size:24px; border-radius: 10px;"><i  class="fa fa-money"></i></button>
  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <form class="text-center" action="payment.php" method="post">
          <input type='hidden' name='loan_id' value='<?php echo $row1['loan_id']; ?>'/>
        <h2 class="p-3">Date paid</h2>
        <input class="i-2" type="input" name="date" placeholder="Date"><br>
        <h2 class="p-3">Amount paid</h2>
        <input class="i-2" type="input" name="payment" placeholder="Payment"><br>
          <h2 class="p-3">Type of Payment</h2>
        <input class="i-2" type="input" name="payment_type"><br>
        <div class="py-3 ">
          <input class="b-2" type="submit" value="Submit">
        </div>
      </form>
    </div>

  </div>
<script type="text/javascript" src="Table.js"></script>
<script type="text/javascript" src="js/modal.js"></script>
</body>
</html>
