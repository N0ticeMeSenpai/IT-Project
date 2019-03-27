<?php
  include 'notification_fetch.php'; 
  include 'navigation.php';
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
	<link rel="stylesheet" type="text/css" href="css/registration.css">
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
	            		echo navigate_it()
	            	?>
	                <ul class="nav navbar-nav navbar-right">
	                	 <li><a href="notification.php">
	                              <?php
	                              if(count_data() > '0'){
	                                echo count_data();
	                              }
	                             ?>
	                            Notification
	                        </a></li>
	                  <li><a href="logout.php">Logout</a></li>
	                </ul>
	            </div>
	        </div>
	    </nav>
		<div class="container">
			<div class="login-page" action="ClientAddAction.php" method="POST">
			  <div class="form">
			  	
				<h2><i class="fa fa-angle-right"></i> CLIENT PERSONAL INFORMATION </h2>
				<!-- WALANG present_address,  -->
			    <form action="ClientAddAction.php" method="POST">
			    
				    <div class="row">
			    		<div class="col-lg-6">
			    			<input type="text" placeholder="Firstname" name="first_name" id="first_name" pattern="{1,}" required>
			    		</div>
						
			    		<div class="col-lg-6">
			    			<input type="text" placeholder="Lastname" name="last_name" id="last_name" pattern="{1,}" required>
			    		</div>	
			    	</div>
			    	<div class="row">
			    		<div class="col-lg-4">
			    			<input placeholder="Name of spouse" type="text" name="name_of_spouse" id="name_of_spouse" required>

			    		</div>
			    		<div class="col-lg-4">
			    			<input placeholder="Present address" type="text" name="present_address" id="present_address" required>
			    		</div>
			    		<div class="col-lg-4">
			    			<input placeholder="Contact number" type="text" name="contact_no" id="contact_no" required>
			    		</div>
			    	</div>
			    	<div class="row">
			    		<div class="col-lg-6">
			    			<input  placeholder="Requested amount" name="requested_amount" id="requested_amount" type="number" min="0.25" step="0.25" max="999999999" required>
			    		</div>			    	 
			    		<div class="col-lg-3">
			    			<input type="date" name="registered_date" id="registered_date" required>
			    		</div>
						
                        <div class="col-lg-3">
                            <select name="loan_type">
                            	<option selected disabled>---- Loan Type? ----</option>
                                <option>Business</option>
                                <option>Salary</option>
                            </select>
                        </div>
			    	</div>
					
			    	<h2><i class="fa fa-angle-right"></i> CLIENT WORK INFORMATION </h2>
					
				    	<div class="row">
				    		<div class="col-lg-6">
				    			<input type="text" placeholder="Business address" name="business_address" id="business_address" pattern="{1,}" required>
				    		</div>
				    		<div class="col-lg-6">
				    			<input type="text" placeholder="Firm name" name="name_of_firm" id="name_of_firm" pattern="{1,}" required>
				    		</div>	
				    	</div>
						
				    	<div class="row">
		                    <div class="col-lg-6">
				    			<input type="text"  placeholder="Position" name="position" id="position" pattern="{1,}" required>
				    		</div>
					    	<div class="col-lg-6">
                                <select name="employment">
                                	<option selected disabled>---- Is he Employed or Own a Business? ----</option>
                                    <option>Employed</option>
                                    <option>Own Business</option>
                                </select>
	                        </div>
				    	</div>
						
				    	<h2 class="mb">CO BORROWER PERSONAL INFORMATION</h2>
						
				    	<div class="row">
				    		<div class="col-lg-6">
				    			<input type="text" placeholder="Firstname" name="co_first_name" id="co_first_name" pattern="{1,}" required>
				    		</div>
				    		<div class="col-lg-6">
				    			<input type="text" placeholder="Lastname" name="co_last_name" id="co_last_name" pattern="{1,}" required>
				    		</div>	
				    	</div>
						
				    	<div class="row">
	                       <div class="col-lg-5">
                                <input type="text" placeholder="Address" name="co_address" id="co_address" pattern="{1,}" required>
                           </div>
						   <div class="col-lg-4">
								<input type="text" placeholder="Relation" name="related_client" id="related_client" pattern="{1,}" required>
						   </div>
							<div class="col-lg-3">
							    <input placeholder="Contact number" type="text" name="co_contact_no" id="co_contact_no" required>
							</div>
				    	</div>
						
				    	<h2><i class="fa fa-angle-right"></i> CO BORROWER WORK INFORMATION </h2>
						
				    	<div class="row">
				    		<div class="col-lg-6">
				    			<input type="text" placeholder="Business address" name="co_business_address" id="co_business_address" pattern="{1,}" required>
				    		</div>
				    		<div class="col-lg-6">
				    			<input type="text" placeholder="Firm name" name="co_name_of_firm" id="co_name_of_firm" pattern="{1,}" required>
				    		</div>	
				    	</div>
						
				    	<div class="row">
		                    <div class="col-lg-6">
				    			<input type="text" placeholder="Position" name="co_position" id="co_position" pattern="{1,}" required>
				    		</div>
					    	<div class="col-lg-6">
                                <select name="co_employment">
                                	<option selected disabled>---- Is he Employed or Own a Business? ----</option>
                                    <option>Employed</option>
                                    <option>Own Business</option>
                                </select>
	                        </div>
				    	</div>
						
			      	 <button class="btn btn-primary btn-lg btn-block" type="submit" name="create">CREATE</button>

			    </form>
				
			  </div>
			</div>
		</div>
	</div>
</body>
</html>

