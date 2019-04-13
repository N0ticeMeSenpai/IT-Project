<?php
    $conn=mysqli_connect('localhost','root','','sigma');
    $results_per_page = 3;

    $query = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.loan_id = payment.loan_id 
    inner join payment_info on payment.payment_id = payment_info.payment_id
    WHERE client.loan_type = 'Business'AND client.status = 'Active'";

    $result = mysqli_query($conn, $query);
    $number_of_results = mysqli_num_rows($result);
    $number_of_pages = ceil($number_of_results/$results_per_page);

    if (!isset($_GET['BusinessPage'])) {
          $page = 1;
        } else {
          $page = $_GET['BusinessPage'];
        }
    $this_page_first_result = ($page-1)*$results_per_page;

    $query = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.loan_id = payment.loan_id
    inner join payment_info on payment.payment_id = payment_info.payment_id
    WHERE client.loan_type = 'Business' AND client.status = 'Active' LIMIT " . $this_page_first_result . "," .  $results_per_page;
    $result = mysqli_query($conn, $query);

?>