<?php  

function navigate_it() 
 {
    $output="";

    if($_SESSION['user']['em_position']=='Operations Manager'){

        $output.='<ul class="nav navbar-nav">
                    <li><a href="AdminDashboard.php">Dashboard</a></li>
                    <li><a href="OPListOfPendingClient.php">List Of Pending</a></li>
                    <li><a href="ListOfDelinquents.php">List Of Delinquents</a></li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Summary of Receivable <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="SORActiveAccount.php">Active Account</a></li>
                            <li><a href="SORActiveDelinquentAccount.php">Active Deliquent</a></li>
                            <li><a href="SORActiveLegalAccount.php">Active Legal Account</a></li>
                            <li><a href="SORDelinquentAccount.php">Deliquent Account</a></li>
                            <li><a href="SummaryOfBookings.php">Summary of Bookings</a></li>
                        </ul>
                    </li>
                </ul>';
        
    
    }elseif ($_SESSION['user']['em_position']=='Office Staff') {

        $output.=' <ul class="nav navbar-nav">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="OFListOfRegisteredClient.php">Client Registered</a></li>
                        <li><a href="ListOfDelinquents.php">List Of Delinquents</a></li>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Summary of Receivable <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="SORActiveAccount.php">Active Account</a></li>
                                <li><a href="SORActiveDelinquentAccount.php">Active Deliquent</a></li>
                                <li><a href="SORActiveLegalAccount.php">Active Legal Account</a></li>
                                <li><a href="SORDelinquentAccount.php">Deliquent Account</a></li>
                                <li><a href="SummaryOfBookings.php">Summary of Bookings</a></li>
                            </ul>
                        </li>
                     </ul>';

    }

    return $output;



 }

?>