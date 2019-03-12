<?php
    $con = mysqli_connect('localhost','root','');
    
    if(!$con){
        echo 'Not Connected To Server';
    }
    
    if(!mysqli_select_db($con,'sigma')){
        echo 'Not Selected';
    }

    $search = $_POST['search'];
    
    $sql = "SELECT * FROM person WHERE last_name='$search';";
    $result1 = mysqli_query($con,$sql);
    $resultCheck = mysqli_num_rows($result1);
    $ctr = 0;


      
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
        <input id="myInput" type="text" placeholder="Search.." name="search"><input type="submit" value="Search">
        </form>    
        <br>
        
        <?php
            if($resultCheck > 0){
                While ($row2 = mysqli_fetch_assoc($result1)){
                       $sql1 = "SELECT * FROM loan where customer_id='".$row2['customer_id']."';";
                        $result2 = mysqli_query($con,$sql1);
                        $resultCheck2 = mysqli_num_rows($result2);
                        if($resultCheck2 > 0){
                        While ($row1 = mysqli_fetch_assoc($result2)){
                                        $sql2 = "SELECT * FROM payment WHERE loan_id='".$row1['loan_id']."';";
                        //$row1 = mysqli_fetch_assoc($result2);
                    
            
            ?>
        <div id="modal<?php echo $ctr;?>" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <form class="text-center" action="payment.php" method="post">
          <input type='hidden' name='loan_id' value='<?php echo $row1['loan_id']; ?>'/>
         <h2 class="p-3">Due Date</h2>
         <select class="i-2" name="choice">

            <?php 
             
             $result4 = mysqli_query($con,$sql2);
             while($row4 = mysqli_fetch_array($result4)):;?>

            <option value="<?php echo $row4[10];?>"><?php echo $row4[10];?></option>

            <?php endwhile;?>

        </select>
        <h2 class="p-3">Date paid</h2>
        <input class="i-2" type="input" name="date" placeholder="Date"><br>
        <h2 class="p-3">Amount paid</h2>
        <input class="i-2" type="input" name="payment" placeholder="Payment"><br>
          <h2 class="p-3">Type of Payment</h2>
        <input class="i-2" type="input" name="payment_type"><br>
          <h2 class="p-3">Remarks</h2>
        <input class="i-2" type="input" name="remarks"><br>
        <div class="py-3 ">
          <input class="b-2" type="submit" value="Submit">
        </div>
      </form>
    </div>

  </div>
        
        <table>
            <hr>
            <br>
            <p> Name: <?php echo $row2['first_name'] ,' ', $row2['last_name']; ?></p>
        <p>Date Booked: <?php echo $row1['date_booked']; ?> <span class="float-right">Maturity Date: <?php echo $row1['maturity_date']; ?></span></p>
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
              <th class="my-bg"></th>

            </tr>
          </thead>
            <?php
                $result3 = mysqli_query($con,$sql2);
                $resultCheck1 = mysqli_num_rows($result3);
                if($resultCheck1 > 0){
                    While ($row3 = mysqli_fetch_assoc($result3)){

            ?>
            <tbody id="myTable">
            <tr>
              <td><?php echo $row3['due_date']; ?></td> 
              <td><?php echo $row3['check_no']; ?></td>
              <td><?php echo $row3['ref_no']; ?></td>
              <td><?php echo $row3['amount_paid']; ?></td>
              <td><?php echo $row3['interest']; ?></td>
              <td><?php echo $row3['fines']; ?></td>
              <td><?php echo $row3['remaining_balance']; ?></td>
              <td><?php echo $row3['remarks']; ?></td>
             
            <?php
                    }
                    echo ' <td>
                <button data-modal="modal'.$ctr.'" class="button" style="font-size:24px; border-radius: 10px;">
                <i  class="fa fa-money"></i>  
                </button>

              </td>    
            </tr>
            
            </tbody>
            ';
                    $ctr++;

                    
                    }
                        }
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
      
<script>
    var modalBtns = [...document.querySelectorAll(".button")];
modalBtns.forEach(function(btn){
  btn.onclick = function() {
    var modal = btn.getAttribute('data-modal');
    document.getElementById(modal).style.display = "block";
  }
});

var closeBtns = [...document.querySelectorAll(".close")];
closeBtns.forEach(function(btn){
  btn.onclick = function() {
    var modal = btn.closest('.modal');
    modal.style.display = "none";
  }
});

window.onclick = function(event) {
  if (event.target.className === "modal") {
    event.target.style.display = "none";
  }
}
</script>
      <script type="text/javascript" src="Table.js"></script>
</body>
</html>
