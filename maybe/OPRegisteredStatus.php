<?php
//Connect the database
$conn=mysqli_connect('localhost','root','','sigma');

// Define variables and initialize with empty values
$registered_status = "";
$registered_status_err = "";

// Processing form data when form is submitted
if(isset($_POST["client_id"]) && !empty($_POST["client_id"])){
    // Get hidden input value
    $client_id = $_POST["client_id"];

    // Check input errors before inserting in database
    if(empty($registered_status_err)){
        // Prepare an update statement
        $sql = "UPDATE client SET registered_status=ACTIBO WHERE client_id=?";

        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_registered_status,$param_client_id);

            // Set parameters
            $param_registered_status = $registered_status;
            $param_client_id = $client_id;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: OPListOfPengingClient.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($conn);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["client_id"]) && !empty(trim($_GET["client_id"]))){
        // Get URL parameter
        $client_id =  trim($_GET["client_id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM client WHERE client_id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_client_id);

            // Set parameters
            $param_client_id = $client_id;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $registered_status = $row["registered_status"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($conn);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Client Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }

    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Client Record</h2>
                    </div>
                    <p>Approve the Client to Loan?</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($registered_status_err)) ? 'has-error' : ''; ?>">
                            Registered Status:
                            <select name="loan_type" value="<?php echo $registered_status; ?>">
                                <option>Denied</option>
                                <option>Approve</option>
                            </select>
                            <?php echo $registered_status_err;?></span>
                        </div>

                        <input type="hidden" name="client_id" value="<?php echo $client_id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="OPListOfPendingClient.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
