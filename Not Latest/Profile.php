<?php
  include 'notification_fetch.php'; 
  include 'navigation.php';
  include 'Include/connection.php';
?>

<?php
session_start();
//Checking User Logged or Not
if(empty($_SESSION['user'])){
    header('location:Login.php');
}


//timeout after 5 sec
if(isset($_SESSION['user'])) {
    if((time() - $_SESSION['last_time']) > 1800) {
      header("location:logout.php");  
    }
}

?>

<?php

if(isset($_POST['id'])){
  
  $position = $_POST['position'];
  $employment = $_POST['employment'];
  $number = $_POST['number'];
  $presentAddress = $_POST['presentAddress'];
  $firmName = $_POST['firmName'];
  $spouse = $_POST['spouse'];
  $businessAddress = $_POST['businessAddress'];
  $id = $_POST['id'];

  //  query to update data 
   
  $result  = mysqli_query($conn , "UPDATE client SET position='$position', contact_no='$number', name_of_firm = '$firmName', present_address='$presentAddress', name_of_spouse='$spouse', business_address='$businessAddress' WHERE client_id='$id'");

  if($result){
    echo 'data updated';
  }

}
?>

<?php
// Check existence of id parameter before processing further
if(isset($_GET["client_id"]) && !empty(trim($_GET["client_id"]))){

    // Prepare a select statement
    $sql = 'SELECT client.client_id, first_name, middle_name, 
    last_name, position, group_concat(concat(co_first_name," ",co_last_name) separator ", ")  
    AS co_name, employment, name_of_firm, business_address, 
    present_address, contact_no, name_of_spouse 
    FROM client INNER JOIN co_borrower 
    on co_borrower.client_id = client.client_id
    inner join loan on loan.client_id = client.client_id
    WHERE client.client_id = ? AND registered_status="Approved" group by client.client_id;';

    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_GET["client_id"]);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Retrieve individual field value
                $first_name = $row["first_name"];
                $last_name = $row["last_name"];
                $position = $row["position"];
                $co_name = $row["co_name"];

                $employment = $row["employment"];
                $name_of_firm = $row["name_of_firm"];
                $business_address = $row["business_address"];

                $present_address = $row["present_address"];
                $contact_no = $row["contact_no"];
                $name_of_spouse = $row["name_of_spouse"];

            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }

        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($conn);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>


    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link rel="stylesheet" type="text/css" href="css/modal.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/notification.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min2.css">
    <link rel="stylesheet" type="text/css" href="css/navigation.css">
    <link rel="stylesheet" type="text/css" href="css/navigation2.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <script src="js/ajax.js"></script>
    <script src="js/bootstrap.min.js"></script>
  
  <title></title>
</head>
<body>

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
<div class="pad-1 container">
  <div class="row">
      <div class="col-xs-12">
        
        <!-- User profile -->
        <div class="panel panel-default">
          <div class="panel-heading">
          <h4 class="panel-title">Profile
              <a class="text-white pull-right" href="ClientLoan.php?client_id=<?php echo $row["client_id"]; ?>">
              Add Loan</a>
          </div>
          </h4>
          <div class="panel-body">
            <div class="profile__avatar">
              <img src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="...">
            </div>
            <div class="profile__header">
              <div class="fz-25"><?php echo $row["first_name"]. ' '.$row["middle_name"].' ' .$row["last_name"]; ?></div>
              <div class="fz-15"><?php echo $row["employment"]; ?></div>
            </div>
          </div>
        </div>

        <!-- User info -->
        <div class="panel panel-default">
          <div class="panel-heading">
          <h4 class="panel-title">User info
            <a href="#" data-role="update" class="pull-right" data-id="<?php echo $row['client_id'] ;?>">
              <img src="img/edit.png" width="20px"></a>
          </h4>
          
          </div>
          <div class="panel-body">
            <table class="table profile__table">
              <tbody>
                <tr style="display: none;" id="<?php echo $row['client_id']; ?>">
                  <td data-target="position"><?php echo $row["position"]; ?></td>
                  <td data-target="employment"><?php echo $row["employment"]; ?></td>
                  <td data-target="number"><?php echo $row["contact_no"]; ?></td>
                  <td data-target="presentAddress"><?php echo $row["present_address"]; ?></td>
                  <td data-target="firmName"><?php echo $row["name_of_firm"]; ?></td>
                  <td data-target="spouse"><?php echo $row["name_of_spouse"]; ?></td>
                  <td data-target="businessAddress"><?php echo $row["business_address"]; ?></td>
                </tr>
                <tr>
                  <th><strong>Position</strong></th>
                  <td><?php echo $row["position"]; ?></td>
                  <th><strong>Work Number</strong></th>
                  <td ><?php echo $row["contact_no"]; ?></td>
                </tr>
                <tr>
                  <th><strong>Home Address</strong></th>
                  <td><?php echo $row["present_address"]; ?></td>
                  <th><strong>Name of Firm</strong></th>
                  <td><?php echo $row["name_of_firm"]; ?></td>
                </tr>
                <tr>
                  <th><strong>Name of Spouse</strong></th>
                  <td><?php echo $row["name_of_spouse"]; ?></td>
                  <th><strong>Business Address</strong></th>
                  <td><?php echo $row["business_address"]; ?></td>
                </tr>
                
                  <?php 

                        $conn=mysqli_connect('localhost','root','','sigma');

                          $count = 1;
                          $client = $row["client_id"];



                          $forCoBorrower = "SELECT co_borrower_id,concat(co_first_name,' ',co_last_name) as name from co_borrower WHERE client_id ='$client'";
                          $coBorrower = mysqli_query($conn, $forCoBorrower);
                          while($output = mysqli_fetch_array($coBorrower)){


                            ?>
                          <tr>
                          <th><strong>Co Borrower<?php echo " ".$count++?></strong></th>
                           <td>
                            <a href="co_profile.php?co_borrower_id=<?php echo $output["co_borrower_id"]?> "> <?php echo $output['name']?></a>
                    <?php } ?></td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="width: 100%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Profile</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label>Employment</label>
            <input type="text" id="employment" class="form-control">
          </div>
          <div class="form-group">
            <label>Position</label>
            <input type="text" id="position" class="form-control">
          </div>
          <div class="form-group">
            <label>Contact number</label>
            <input type="text" id="number" class="form-control">
          </div>
          <div class="form-group">
            <label>Present Address</label>
            <input type="text" id="presentAddress" class="form-control">
          </div>
          <div class="form-group">
            <label>Name of Firm</label>
            <input type="text" id="firmName" class="form-control">
          </div>
          <div class="form-group">
            <label>Spouse</label>
            <input type="text" id="spouse" class="form-control">
          </div>
          <div class="form-group">
            <label>Business Address</label>
            <input type="text" id="businessAddress" class="form-control">
          </div>
          <input type="hidden" id="ClientId" class="form-control">
      </div>
      <div class="modal-footer">
        <a href="Profile.php?client_id=<?php echo $row['client_id']; ?>" id="save" class="btn btn-primary pull-right">Update</a>
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
  $(document).ready(function(){

    //  append values in input fields
      $(document).on('click','a[data-role=update]',function(){

            var id  = $(this).data('id');
            var employment  = $('#'+id).children('td[data-target=employment]').text();
            var position  = $('#'+id).children('td[data-target=position]').text();
            var number  = $('#'+id).children('td[data-target=number]').text();
            var presentAddress = $('#'+id).children('td[data-target=presentAddress]').text();
            var firmName  = $('#'+id).children('td[data-target=firmName]').text();
            var businessAddress  = $('#'+id).children('td[data-target=businessAddress]').text();
            var spouse = $('#'+id).children('td[data-target=spouse]').text();

            $('#position').val(position);
            $('#employment').val(employment);
            $('#number').val(number);
            $('#presentAddress').val(presentAddress);
            $('#firmName').val(firmName);
            $('#spouse').val(spouse);
            $('#businessAddress').val(businessAddress);
            $('#ClientId').val(id);
            $('#myModal').modal('toggle');
      });

      // now create event to get data from fields and update in database 

       $('#save').click(function(){
          var id  = $('#ClientId').val(); 
          var employment =  $('#employment').val();
          var position =  $('#position').val();
          var number =  $('#number').val();
          var presentAddress = $('#presentAddress').val();
          var firmName = $('#firmName').val();
          var spouse = $('#spouse').val();
          var businessAddress = $('#businessAddress').val();


          $.ajax({
              url      : 'Profile.php',
              method   : 'post',  
              data     : {id: id, 
                          position:position,
                          employment:employment,
                          number:number, 
                          presentAddress:presentAddress, 
                          firmName:firmName, 
                          spouse: spouse, 
                          businessAddress:businessAddress},

              success  : function(response){
                            // now update user record in table 
                             $('#'+id).children('td[data-target=position]').text(position);
                             $('#'+id).children('td[data-target=employment]').text(employment);
                             $('#'+id).children('td[data-target=number]').text(number);
                             $('#'+id).children('td[data-target=presentAddress]').text(presentAddress);
                             $('#'+id).children('td[data-target=firmName]').text(firmName);
                             $('#'+id).children('td[data-target=businessAddress]').text(businessAddress);
                             $('#'+id).children('td[data-target=spouse]').text(spouse);
                             $('#myModal').modal('toggle'); 

                         }
          });
       });
  });

</script>

</body>
</html>