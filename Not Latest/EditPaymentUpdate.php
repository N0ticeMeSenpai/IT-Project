<?php
	include 'EditPaymentAction.php';
?>
<!-- EDIT START -->
<?php 
    $loan_idforR = mysqli_real_escape_string($db,$_POST['loan_idforR']);

        $id = $_POST['edit'];
        $update = true;
        $record = mysqli_query($db, "SELECT payment_info_id,payment.remaining_balance, payment_info.payment_id, payment.due_date, payment.loan_id, payment_info.date_paid, payment_info.amount_paid, payment_info.payment_type, payment_info.account_number, payment_info.check_no, payment_info.ref_no, payment_info.interest, payment_info.fines, payment_info.remarks, payment_info.status FROM payment INNER JOIN payment_info ON payment_info.payment_id=payment.payment_id WHERE payment_info.payment_info_id='$id'");

        if (!empty($record)) {
            $n = mysqli_fetch_array($record);
            $datePaid = $n['date_paid'];
            $amtPaid = $n['amount_paid'];
            $paymentType = $n['payment_type'];
            $accNumber = $n['account_number'];
            $checkNumber = $n['check_no'];
            $refNumber =$n['ref_no'];
            $inter =$n['interest'];
            $fines =$n['fines'];
            $marks = $n['remarks'];
            $stats = $n['status'];
        }
    
?>
<!-- EDIT END -->

<HTML>
    
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

    <title>Edit Payment</title>
    </head>
<body>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper site-min-height">

            <!-- BASIC FORM ELELEMENTS -->
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <!-- START CREATE FORM -->
                        <form class="form-horizontal style-form" action="EditPaymentAction.php" method="POST">
		                    
		                    <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="hidden" name="loan_id" value="<?php echo $loan_idforR ?>">


                            <center>
                                <h4 class="mb"><i class="fa fa-angle-right"></i>
                                    Edit Payment
                                </h4>
                            </center>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Date Paid</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="datePaid" value="<?= $datePaid ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Amount Paid</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="amountPaid" value="<?= $amtPaid ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Payment Type</label>
                                <div class="col-sm-10">
                                    <select name="paymentType" class="form-control selectpicker" value="<?= $paymentType ?>">
                                        <option>Cheque</option>
                                        <option>Cash</option>
                                        <option>Bank Deposit</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Account Number</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="accountNo" value="<?= $accNumber ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Check No</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="checkNo" value="<?= $checkNumber ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Ref Number</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="refNo" value="<?= $refNumber ?>">
                                </div>
                            </div>

                           <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Interest</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="interest" value="<?= $inter ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Fines</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="fines" value="<?= $fines ?>">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Remarks</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="remarks" value="<?= $marks ?>">
                                </div>
                            </div>

                            <button class="btn btn-primary btn-lg btn-block" type="submit" name="update">Update</button>

                        </form>
                        <!-- END CREATE FORM -->

                         

                    </div>
                </div>
            </div>

        </section>
    </section>
                   

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->

    <script>
        //custom select box

        $(function() {
            $('select.styled').customSelect();
        });

    </script>

</body>
</HTML>
