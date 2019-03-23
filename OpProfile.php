<?php

$connection = mysqli_connect("localhost", "root", "", "images");

if(isset($_POST['fileuploadsubmit'])) {
 $fileupload = $_FILES['fileupload']['name'];
 $fileuploadTMP = $_FILES['fileupload']['tmp_name'];
 $folder = "images/";
 move_uploaded_file($fileuploadTMP, $folder.$fileupload);
$sql = "INSERT INTO `updis`(`imagename`) VALUES ('$fileupload')";
$qry = mysqli_query($connection, $sql);
if ($qry) {
 echo "<div style='color: green; font-size: 100px'>uploaded</div>";
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/navigation2.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <title>Account Setting</title>
</head>

<body>
    <div class="topnav">
        <div class="topnav-right">
            <a href="index.html">Home</a>
            <a href="ClientAdd.html">Add a Client</a>
            <a href="SummaryOfBookings.html">Summary of Bookings</a>
            <a href="SORActiveAccount.html">Summary of Receivables</a>
            <a href="ARMovingAccount.html">Aging of Receivables</a>
            <a href="DelinquentReport.html">Delinquents Reports</a>
            <a href="OpProfile.php" class="active">My Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-sm-9">
                <hr class="profile__contact-hr">

                <!-- User profile -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">User Profile</h4>
                    </div>
                    <div class="panel-body">

                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
                        <?php


$connection = mysqli_connect("localhost", "root", "", "images");
$select = " SELECT * FROM `image` " ;
$query = mysqli_query($connection, $select) ;
while($row = mysqli_fetch_array($query)) {
 $image = $row['imagename'];
 //"<img src='images/".$image."' " height='300px' width='250px'/> ";
echo '<img src="images/'.$image.'" height="150" width="150" >';
}
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
         <form method="post" action="" enctype="multipart/form-data">
            <input type="file" name="fileupload" id="profile-img" />
            <input type="submit" name="fileuploadsubmit" />
         </form>
            <img src="" id="profile-img-tag" width="200px" />

                        <script type="text/javascript">
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function(e) {
                                        $('#profile-img-tag').attr('src', e.target.result);
                                    }
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                            $("#profile-img").change(function() {
                                readURL(this);
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
