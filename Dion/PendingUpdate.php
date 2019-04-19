<?php    
//Connect the database
$conn=mysqli_connect('localhost','root','','sigma');

if(isset($_POST['update'])){
    $registered_status = $_POST['registered_status'];
    $date_modified = $_POST['date_modified'];
    $client_id = $_POST['client_id'];
    $query = mysqli_query($conn, "UPDATE client SET registered_status = '$registered_status' , date_modified = '$date_modified' WHERE client_id = '$client_id'");
    
    if ($query) {
        header("location:OFListOfRegisteredClient.php");
    }else{
        echo "<script>alert('Sorry update query not work')</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Pa Edit na lng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>

<body>
    <div class="container" style="margin-top: 70px;">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center">
                <?php
                    if(isset($_GET['update_id'])): ?>
                <?php $id = $_GET['update_id']; ?>
                <?php $query = mysqli_query($con, "SELECT * FROM client WHERE client_id = '$client_id' ");
                    $r = mysqli_fetch_array($query);
                    $registered_status = $_POST['registered_status'];
                    ?>
                <form method="POST" action="PendingUpdate.php">
                    
                    <div class="form-group">
                        Registered Status :
                        <input type="text" name="registered_status" class="form-control" required="" value="<?php echo $registered_status; ?>">
                    </div><!-- form-group -->
                    
                    <div class="form-group">
                        Date Modified :
                        <input type="date" name="date_modified" class="form-control" required="">
                    </div><!-- form-group -->

                    <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
                    <div class="form-group">
                        <input type="submit" name="update" class="btn btn-info" value="Client Status">
                    </div><!-- form-group -->

                </form><!-- form -->
                <?php endif; ?>

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>

</html>
