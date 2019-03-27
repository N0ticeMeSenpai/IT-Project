<?php
    $conn=mysqli_connect('localhost','root','','sigma');
    $results_per_page = 3;

    $query = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.client_id = payment.client_id 
    inner join payment_info on payment.payment_id = payment_info.payment_id
    where client.loan_type = 'Salary' 
    and registered_status = 'Approved'";

    $result = mysqli_query($conn, $query);
    $number_of_results = mysqli_num_rows($result);
    $number_of_pages = ceil($number_of_results/$results_per_page);

    if (!isset($_GET['SalaryPage'])) {
		  $page = 1;
		} else {
		  $page = $_GET['SalaryPage'];
		}
	$this_page_first_result = ($page-1)*$results_per_page;

	$query = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.client_id = payment.client_id 
    inner join payment_info on payment.payment_id = payment_info.payment_id
    where client.loan_type = 'Salary' 
    and registered_status = 'Approved' LIMIT " . $this_page_first_result . "," .  $results_per_page;
    $result = mysqli_query($conn, $query);

?>