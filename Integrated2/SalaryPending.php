<?php
    $conn=mysqli_connect('localhost','root','','sigma');
    $results_per_page = 3;

    $query = "SELECT * FROM client 
    INNER JOIN occupation
    ON client.client_id = occupation.client_id
    WHERE loan_type = 'Salary' 
    AND (registered_status = 'Denied' 
    OR registered_status = 'Pending')";

    $result = mysqli_query($conn, $query);
    $number_of_results = mysqli_num_rows($result);
    $number_of_pages = ceil($number_of_results/$results_per_page);

    if (!isset($_GET['SalaryPage'])) {
		  $page = 1;
		} else {
		  $page = $_GET['SalaryPage'];
		}
	$this_page_first_result = ($page-1)*$results_per_page;

	$query = "SELECT * FROM client 
    INNER JOIN occupation
    ON client.client_id = occupation.client_id
    WHERE loan_type = 'Salary' 
    AND (registered_status = 'Denied' 
    OR registered_status = 'Pending') LIMIT " . $this_page_first_result . "," .  $results_per_page;
    $result = mysqli_query($conn, $query);

?>