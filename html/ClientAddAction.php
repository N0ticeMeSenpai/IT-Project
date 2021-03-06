c<?php
//Connect the database
include "Include/connection.php";

session_start();

if(isset($_POST['create'])){
    //Client Table



    $stmt = $conn->prepare("INSERT INTO client   
                (first_name,last_name, middle_name,
                 name_of_spouse, present_address,
                 contact_no, requested_amount,
                 registered_date,
                 business_address, name_of_firm,
                 employment, position) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssssssss", $first_name, $last_name, $middle_name,
            $name_of_spouse, $present_address,
            $contact_no, $requested_amount, $curdate,
            $business_address, $name_of_firm,
            $employment, $position);
            $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
            $middle_name = mysqli_real_escape_string($conn, $_POST['middle_name']);
            $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
            $name_of_spouse = mysqli_real_escape_string($conn, $_POST['name_of_spouse']);
            $present_address = mysqli_real_escape_string($conn, $_POST['present_address']);
            $contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);               
            $requested_amount = mysqli_real_escape_string($conn, $_POST['requested_amount']);
            $business_address = mysqli_real_escape_string($conn, $_POST['business_address']);
            $name_of_firm = mysqli_real_escape_string($conn, $_POST['name_of_firm']);
            $employment = mysqli_real_escape_string($conn, $_POST['employment']);
            $position = mysqli_real_escape_string($conn, $_POST['position']);
            $curdate = date('Y-m-d');

    $allClient = mysqli_query($conn,"SELECT first_name, last_name, middle_name FROM client WHERE first_name = '$first_name' && last_name = '$last_name' && middle_name = '$middle_name'");

    if(mysqli_num_rows($allClient) >= 1){
        echo "<script>
              alert('Client is already registered');
              window.location.href='ClientAdd.php';
              </script>";
    }else{

        $stmt->execute();
        
        echo "<script>
              alert('Client Creation Success');
              window.location.href='ListOfPending.php';
              </script>";
        
        $stmt->close();
        $conn->close();
    }
}
?>
