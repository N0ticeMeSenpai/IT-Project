<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min2.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/modal.css">
    <link rel="stylesheet" type="text/css" href="css/navigation2.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title>List of Pending Clients</title>

</head>

<body>
    <div class="container-fluid no-padding">
        <div class="topnav">
            <div class="topnav-right">
                <a href="AdminIndex.html">Home</a>
                <a href="OPListOfPendingClient.php" class="active">List of Pending Clients</a>
                <a href="AdminDelinquents.html">List of Delinquents</a>
            </div>
        </div>
        <div class="container">

            <h2 class="p-5 text-center">List of Pending Clients</h2>

            <hr>
            <a href="OPListOfPendingClient.php" class="btn btn-primary" style="float:right;">Back</a>
            <h3>Salary Account</h3>
            <hr>

            <br><br>

            <table>
                <thead class="text-white">
                    <tr>
                        <th class="my-bg">First Name</th>
                        <th class="my-bg">Last Name</th>
                        <th class="my-bg">Contact Number</th>
                        <th class="my-bg">Requested Amount</th>
                        <th class="my-bg">Status</th>
                        <th class="my-bg">Date Joined</th>
                    </tr>
                </thead>

                <?php
                    //Connect the database
                    $conn=mysqli_connect('localhost','root','','sigma');

                    if(isset($_POST['submit-list'])){
                        $selected_val = $_POST['client_status'];  // Storing Selected Value In Variable
                        $sql = "SELECT 
		                          *
	                           FROM
                                    sigma.client
	                           WHERE
		                          registered_status = '$selected_val'
                                    AND loan_type = 'Salary';";

                        $result = mysqli_query($conn, $sql);
                        $queryResult = mysqli_num_rows($result);

                        echo "There are ".$queryResult." results!";

                        if($queryResult > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<tbody id='myTable'>";
                                echo "<tr>";
                                echo "<td>" .$row['first_name']. "</td>";
                                echo "<td>" .$row['last_name']. "</td>";
                                echo "<td>" .$row['contact_no']. "</td>";
                                echo "<td>" .$row['requested_amount']. "</td>";
                                echo "<td>" .$row['registered_status']. "</td>";
                                echo "<td>" .$row['registered_date']. "</td>";
                                echo "</tr>";
                                echo "</tbody>";
                            }

                        }else{
                            echo "There are no results matching your search!";
                        }
                    }
                    ?>
            </table>

        </div>
    </div>

    <script type="text/javascript" src="js/Table.js"></script>
    <script type="text/javascript" src="js/modal.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
</body>

</html>
