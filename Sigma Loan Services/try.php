<?php
  include 'notification_fetch.php'; 
  include 'navigation.php';
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


//Restrict User or Moderator to Access Admin.php page
if($_SESSION['user']['em_position']=='Operations Manager'){
    header('location:AdminDashboard.php');
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
	<link rel="stylesheet" type="text/css" href="css/registration.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<title></title>
</head>

<body>
	<div class="container-fluid no-padding">
	    <nav id="myNavbar" class="navbar nav-color" role="navigation">
	        <div class="container">
	            <div class="navbar-header">
	                <a class="navbar-brand" href="dashboard.php">SIGMA</a>
	            </div>
	            <!-- Collect the nav links, forms, and other content for toggling -->
	            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	            	<?php
	            		echo navigate_it();
	            	?>
	                <ul class="nav navbar-nav navbar-right">
	                	 <li>
	            	 		<a href="notification.php">
	                          <?php
	                          if(count_data() > '0'){
	                            echo count_data();
	                          }
	                         ?>
	                         <img src="img/notifications-button.png" width="15px">
	                    	</a>
	                	 </li>
	                  <?php
	                  echo navigate_right();

	                  ?>
	                </ul>
	            </div>
	        </div>
	    </nav>
		<div class="container">
			<div class="login-page" action="ClientAddAction.php" method="POST">
			  <div class="form">
			  	
				    	<!-------------------------------->
				    	<h2 class="mb">CO BORROWER PERSONAL 1 INFORMATION</h2>
						
				    	<div class="row">
				    		<div class="col-lg-4">
				    			<input type="text" placeholder="Firstname" name="co_first_name_one" id="co_first_name_one" pattern="{1,}" required>
				    		</div>
				    		<div class="col-lg-4">
				    			<input type="text" placeholder="Middlename" name="co_middle_name_one" id="co_middle_name_one" pattern="{1,}" required>
				    		</div>
				    		<div class="col-lg-4">
				    			<input type="text" placeholder="Lastname" name="co_last_name_one" id="co_last_name_one" pattern="{1,}" required>
				    		</div>	
				    	</div>
						
				    	<div class="row">
	                       <div class="col-lg-5">
                                <input type="text" placeholder="Address" name="co_address_one" id="co_address_one" pattern="{1,}" required>
                           </div>
						   <div class="col-lg-4">
								<input type="text" placeholder="Relation" name="related_client_one" id="related_client_one" pattern="{1,}" required>
						   </div>
							<div class="col-lg-3">
							    <input placeholder="Contact number" type="text" name="co_contact_no_one" id="co_contact_no" required>
							</div>
				    	</div>
						
				    	<h2><i class="fa fa-angle-right"></i> CO BORROWER 1 WORK INFORMATION </h2>
						
				    	<div class="row">
				    		<div class="col-lg-6">
				    			<input type="text" placeholder="Business address" name="co_business_address_one" id="co_business_address_one" pattern="{1,}" required>
				    		</div>
				    		<div class="col-lg-6">
				    			<input type="text" placeholder="Firm name" name="co_name_of_firm_one" id="co_name_of_firm_one" pattern="{1,}" required>
				    		</div>	
				    	</div>
						
				    	<div class="row">
		                    <div class="col-lg-6">
				    			<input type="text" placeholder="Position" name="co_position_one" id="co_position_one" pattern="{1,}" required>
				    		</div>
					    	<div class="col-lg-6">
                                <select name="co_employment_one">
                                	<option selected disabled>---- Is he Employed or Own a Business? ----</option>
                                    <option>Employed</option>
                                    <option>Own Business</option>
                                </select>
	                        </div>
				    	</div>

				    	<!--------------------------------------------->
				    	<h2 class="mb">CO BORROWER PERSONAL 2 INFORMATION</h2>
						
				    	<div class="row">
				    		<div class="col-lg-4">
				    			<input type="text" placeholder="Firstname" name="co_first_name_two" id="co_first_name_two" pattern="{1,}" required>
				    		</div>
				    		<div class="col-lg-4">
				    			<input type="text" placeholder="Middlename" name="co_middle_name_two" id="co_middle_name_two" pattern="{1,}" required>
				    		</div>
				    		<div class="col-lg-4">
				    			<input type="text" placeholder="Lastname" name="co_last_name_two" id="co_last_name_two" pattern="{1,}" required>
				    		</div>	
				    	</div>
						
				    	<div class="row">
	                       <div class="col-lg-5">
                                <input type="text" placeholder="Address" name="co_address_two" id="co_address_two" pattern="{1,}" required>
                           </div>
						   <div class="col-lg-4">
								<input type="text" placeholder="Relation" name="related_client_two" id="related_client_two" pattern="{1,}" required>
						   </div>
							<div class="col-lg-3">
							    <input placeholder="Contact number" type="text" name="co_contact_no_two" id="co_contact_no_two" required>
							</div>
				    	</div>
						
				    	<h2><i class="fa fa-angle-right"></i> CO BORROWER WORK 2 INFORMATION </h2>
						
				    	<div class="row">
				    		<div class="col-lg-6">
				    			<input type="text" placeholder="Business address" name="co_business_address_two" id="co_business_address_two" pattern="{1,}" required>
				    		</div>
				    		<div class="col-lg-6">
				    			<input type="text" placeholder="Firm name" name="co_name_of_firm_two" id="co_name_of_firm_two" pattern="{1,}" required>
				    		</div>	
				    	</div>
						
				    	<div class="row">
		                    <div class="col-lg-6">
				    			<input type="text" placeholder="Position" name="co_position_two" id="co_position_two" pattern="{1,}" required>
				    		</div>
					    	<div class="col-lg-6">
                                <select name="co_employment_two">
                                	<option selected disabled>---- Is he Employed or Own a Business? ----</option>
                                    <option>Employed</option>
                                    <option>Own Business</option>
                                </select>
	                        </div>
				    	</div>

						
			      	 <center>
			      	 	<button class="btn btn-lg btn-block" type="submit" name="create">CREATE</button>
			      	 </center>

			    </form>
				
			  </div>
			</div>
		</div>
	</div>
</body>
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
</html>

