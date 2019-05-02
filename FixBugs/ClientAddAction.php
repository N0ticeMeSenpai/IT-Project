<?php
//Connect the database
$conn = mysqli_connect('localhost' , 'root' ,'' ,'sigma');

session_start();

if(isset($_POST['create'])){
    //Client Table
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

    //Co Borrower _one Table    
    $co_first_name_one = mysqli_real_escape_string($conn, $_POST['co_first_name_one']);
    $co_middle_name_one = mysqli_real_escape_string($conn, $_POST['co_middle_name_one']);
    $co_last_name_one = mysqli_real_escape_string($conn, $_POST['co_last_name_one']);
    $co_contact_no_one = mysqli_real_escape_string($conn, $_POST['co_contact_no_one']);
    $co_address_one = mysqli_real_escape_string($conn, $_POST['co_address_one']);
    $related_client_one = mysqli_real_escape_string($conn, $_POST['related_client_one']);
    $co_business_address_one = mysqli_real_escape_string($conn, $_POST['co_business_address_one']);
    $co_name_of_firm_one = mysqli_real_escape_string($conn, $_POST['co_name_of_firm_one']);
    $co_employment_one = mysqli_real_escape_string($conn, $_POST['co_employment_one']);
    $co_position_one = mysqli_real_escape_string($conn, $_POST['co_position_one']);

    //Co Borrower _two Table    
    $co_first_name_two = mysqli_real_escape_string($conn, $_POST['co_first_name_two']);
    $co_middle_name_two = mysqli_real_escape_string($conn, $_POST['co_middle_name_two']);
    $co_last_name_two = mysqli_real_escape_string($conn, $_POST['co_last_name_two']);
    $co_contact_no_two = mysqli_real_escape_string($conn, $_POST['co_contact_no_two']);
    $co_address_two = mysqli_real_escape_string($conn, $_POST['co_address_two']);
    $related_client_two = mysqli_real_escape_string($conn, $_POST['related_client_two']);
    $co_business_address_two = mysqli_real_escape_string($conn, $_POST['co_business_address_two']);
    $co_name_of_firm_two = mysqli_real_escape_string($conn, $_POST['co_name_of_firm_two']);
    $co_employment_two = mysqli_real_escape_string($conn, $_POST['co_employment_two']);
    $co_position_two = mysqli_real_escape_string($conn, $_POST['co_position_two']);

    $sql1="INSERT INTO client   
                (first_name,last_name, middle_name,
                 name_of_spouse, present_address,
                 contact_no, requested_amount,
                 registered_date,
                 business_address, name_of_firm,
                 employment, position) 
          VALUES
            ('$first_name', '$last_name','$middle_name',
             '$name_of_spouse', '$present_address',
             '$contact_no', '$requested_amount', NOW(),
             '$business_address', '$name_of_firm',
             '$employment', '$position');";

    $sql2="SET @client_id = LAST_INSERT_ID();";

    $sql3="INSERT INTO co_borrower
                (co_first_name, co_last_name, co_middle_name,
                 co_contact_no, co_address,
                 related_client, co_business_address,
                 co_name_of_firm, co_employment,
                 co_position, client_id)
            VALUES
                ('$co_first_name_one','$co_last_name_one','$co_middle_name_one',
                 '$co_contact_no_one', '$co_address_one',
                 '$related_client_one', '$co_business_address_one',
                 '$co_name_of_firm_one', '$co_employment_one', 
                 '$co_position_one', @client_id);";
    
    $sql4="INSERT INTO co_borrower
                (co_first_name, co_last_name, co_middle_name,
                 co_contact_no, co_address,
                 related_client, co_business_address,
                 co_name_of_firm, co_employment,
                 co_position, client_id)
            VALUES
                ('$co_first_name_two','$co_last_name_two','$co_middle_name_two',
                 '$co_contact_no_two', '$co_address_two',
                 '$related_client_two', '$co_business_address_two',
                 '$co_name_of_firm_two', '$co_employment_two', 
                 '$co_position_two', @client_id);";


    $allClient = mysqli_query($conn,"SELECT first_name, last_name, middle_name FROM client WHERE first_name = '$first_name' && last_name = '$last_name' && middle_name = '$middle_name'");

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
        echo "<script>
              alert('Client Creation Success');
              window.location.href='OPListOfPendingClient.php';
              </script>";
    }
}
?>
