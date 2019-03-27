<?php
//Connect the database
$conn=mysqli_connect('localhost','root','','sigma');
session_start();

if(isset($_POST['create'])){
    //Client Table
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $name_of_spouse = mysqli_real_escape_string($conn, $_POST['name_of_spouse']);
    $present_address = mysqli_real_escape_string($conn, $_POST['present_address']);
    $contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);               
    $requested_amount = mysqli_real_escape_string($conn, $_POST['requested_amount']);
    $registered_date = mysqli_real_escape_string($conn, $_POST['registered_date']);
    $loan_type = mysqli_real_escape_string($conn, $_POST['loan_type']);

    //Occupation Table
    $business_address = mysqli_real_escape_string($conn, $_POST['business_address']);
    $name_of_firm = mysqli_real_escape_string($conn, $_POST['name_of_firm']);
    $employment = mysqli_real_escape_string($conn, $_POST['employment']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $co_business_address = mysqli_real_escape_string($conn, $_POST['co_business_address']);
    $co_name_of_firm = mysqli_real_escape_string($conn, $_POST['co_name_of_firm']);
    $co_employment = mysqli_real_escape_string($conn, $_POST['co_employment']);
    $co_position = mysqli_real_escape_string($conn, $_POST['co_position']);

    //Co Borrower Table
    $co_first_name = mysqli_real_escape_string($conn, $_POST['co_first_name']);
    $co_last_name = mysqli_real_escape_string($conn, $_POST['co_last_name']);
    $co_contact_no = mysqli_real_escape_string($conn, $_POST['co_contact_no']);
    $co_address = mysqli_real_escape_string($conn, $_POST['co_address']);
    $related_client = mysqli_real_escape_string($conn, $_POST['related_client']);

    $sql1="INSERT INTO client 
	       (first_name, last_name,
	        name_of_spouse, present_address,
            contact_no, requested_amount,
            registered_date, loan_type)
          VALUES
            ('$first_name', '$last_name',
             '$name_of_spouse', '$present_address',
             '$contact_no', '$requested_amount',
             '$registered_date', '$loan_type');";

    $sql2="SET @client_id = LAST_INSERT_ID();";

    $sql3="INSERT INTO co_borrower
                (co_first_name, co_last_name,
                 co_contact_no, co_address,
                 related_client)
            VALUES
                ('$co_first_name','$co_last_name',
                 '$co_contact_no', '$co_address',
                 '$related_client');";
    
    $sql4="SET @co_borrower_id = LAST_INSERT_ID();";

    $sql5="INSERT INTO occupation 
             (client_id,business_address,
             name_of_firm,employment,
             position,co_borrower_id,
             co_business_address,co_name_of_firm,
             co_employment, co_position)
            VALUES     
				(@client_id,'$business_address',
              '$name_of_firm','$employment',
              '$position',@co_borrower_id,
              '$co_business_address','$co_name_of_firm',
              '$co_employment','$co_position');";

    $allClient = mysqli_query($conn,"SELECT first_name, last_name FROM client WHERE first_name = '$first_name' && last_name = '$last_name'");

    if(mysqli_num_rows($allClient) >= 1){
        echo "<script>
              alert('Client is already registered');
              window.location.href='ClientAdd.php';
              </script>";
    }else{
        $registerClient1 = mysqli_query($conn, $sql1);
        $registerClient2 = mysqli_query($conn, $sql2);
        $registerClient3 = mysqli_query($conn, $sql3);
        $registerClient4 = mysqli_query($conn, $sql4);
        $registerClient5 = mysqli_query($conn, $sql5);
        echo "<script>
              alert('Client Creation Success');
              window.location.href='OPListOfPendingClient.php';
              </script>";
    }
}
?>
