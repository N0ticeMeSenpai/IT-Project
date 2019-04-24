<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
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
                <h3>Salary Account</h3>
                <hr>

                <form action="OPSearchSalaryClient.php" method="post">
                    <input type="text" name="search" placeholder="Search Client Name">
                    <button type="submit" name="submit-search">Search</button>
                </form>
                <br>

                <form action="OPListSalaryClient.php" method="post">
                    <select name="client_status">
                        <option value="pending">Pending</option>
                        <option value="denied">Denied</option>
                    </select>
                    <button type="submit" name="submit-list">Client List</button>
                </form>
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
                            <th class="my-bg">Action</th>
                        </tr>
                    </thead>

                    <?php
                    //Connect the database
                    $conn=mysqli_connect('localhost','root','','sigma');

                    // Attempt select query execution
                    $sql = "SELECT 
                                *
                            FROM
                                client
                            WHERE
                                loan_type = 'Salary' 
                                AND (registered_status = 'Denied' OR registered_status = 'Pending');";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){

                                echo "<tbody id='myTable'>";
                                echo "<tr>";
                                echo "<td>" .$row['first_name']. "</td>";
                                echo "<td>" .$row['last_name']. "</td>";
                                echo "<td>" .$row['contact_no']. "</td>";
                                echo "<td>" .$row['requested_amount']. "</td>";
                                echo "<td>" .$row['registered_status']. "</td>";
                                echo "<td>" .$row['registered_date']. "</td>";
                                echo "<td>";
                                echo "<a href='OPViewSalaryClient.php?client_id=". $row['client_id'] ."'>View Client Info<span class='glyphicon glyphicon-eye-open'></span></a><br>";
                                echo "<a href='OPRegisteredStatus.php?client_id=". $row['client_id'] ."'>Update Registered Status<span class='glyphicon glyphicon-eye-open'></span></a><br>";
                                echo "<a href='OPDeleteSalaryClient.php?client_id=". $row['client_id'] ."'>Delete Client Record<span class='glyphicon glyphicon-trash'></span></a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";

                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No pending clients were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                    }

                    // Close connection
                    mysqli_close($conn);
                    ?>
                </table>

                <hr>
                <h3>Business Account</h3>
                <hr>

                <form action="OPSearchBusinessClient.php" method="post">
                    <input type="text" name="search" placeholder="Search Client Name">
                    <button type="submit" name="submit-search">Search</button>
                </form>
                <br>

                <form action="OPListBusinessClient.php" method="post">
                    <select name="client_status">
                        <option value="pending">Pending</option>
                        <option value="denied">Denied</option>
                    </select>
                    <button type="submit" name="submit-list">Client List</button>
                </form>
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
                            <th class="my-bg">Action</th>
                        </tr>
                    </thead>

                    <?php
                    //Connect the database
                    $conn=mysqli_connect('localhost','root','','sigma');

                    // Attempt select query execution
                    $sql = "SELECT 
                                *
                            FROM
                                client
                            WHERE
                                loan_type = 'Business'
                                AND (registered_status = 'Denied' OR registered_status = 'Pending');";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){

                                echo "<tbody id='myTable'>";
                                echo "<tr>";
                                echo "<td>" .$row['first_name']. "</td>";
                                echo "<td>" .$row['last_name']. "</td>";
                                echo "<td>" .$row['contact_no']. "</td>";
                                echo "<td>" .$row['requested_amount']. "</td>";
                                echo "<td>" .$row['registered_status']. "</td>";
                                echo "<td>" .$row['registered_date']. "</td>";
                                echo "<td>";
                                echo "<a href='OPViewBusinessClient.php?client_id=". $row['client_id'] ."'>View Client Info<span class='glyphicon glyphicon-eye-open'></span></a><br>";
                                
                                echo "<a href='OPDeleteBusinessClient.php?client_id=". $row['client_id'] ."'>Delete Client Record<span class='glyphicon glyphicon-trash'></span></a>";
                                echo "</td>";    
                                echo "</tr>";
                            }
                            echo "</tbody>";

                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No pending clients were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                    }

                    // Close connection
                    mysqli_close($conn);
                    ?>

                </table>
            </div>
        </div>

        <script type="text/javascript" src="js/Table.js"></script>
        <script type="text/javascript" src="js/modal.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>
    </body>

</html>
