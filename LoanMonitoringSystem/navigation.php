<?php  

function navigate_it() 
 {
    $output="";

    if($_SESSION['user']['em_position']=='Operations Manager'){

    $output.='<ul class="nav navbar-nav">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="List.php">Client List</a></li>
                    <li class="dropdown mega-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account Receivable<span class="caret"></span></a>                
                        <ul class="dropdown-menu mega-dropdown-menu">
                            <li class="col-lg-6">
                                <ul>
                                    <li class="dropdown-header">Summary Of Receivable</li>
                                    <li><a href="SORActiveAccount.php">Active Account</a></li>
                                    <li><a href="SORActiveDelinquentAccount.php">Active Delinquent Account</a></li>
                                    <li><a href="SORActiveLegalAccount.php">Active Legal Account</a></li>
                                    <li><a href="SORDelinquentAccount.php">Delinquent Account</a></li>
                                    
                                </ul>
                            </li>
                            <li class="col-lg-4">
                                <ul>
                                    <li class="dropdown-header">Aging Of Receivable</li>
                                    <li><a href="ARMoving.php">Moving Account</a></li>
                                    <li><a href="ARNotMoving.php">Not Moving Account</a></li>
                                    <li><a href="ARLegal.php">Legal Account</a></li>                       
                                </ul>
                            </li>
                        </ul>               
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Others
                        <span class="caret"></span></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="ListOfPending.php">List Of Pending</a></li>
                            <li><a href="ListOfDelinquents.php">List Of Delinquents</a></li>
                            <li><a href="completedLoans.php">Completed Loans</a></li> 
                            <li><a href="SummaryOfBookings.php">Summary of Bookings</a></li>
                        </ul>
                    </li>
                </ul>';
        
    
    }elseif ($_SESSION['user']['em_position']=='Office Staff') {

        $output.=' <ul class="nav navbar-nav">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="List.php">Client List</a></li>
                    <li class="dropdown mega-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account Receivable<span class="caret"></span></a>                
                        <ul class="dropdown-menu mega-dropdown-menu">
                            <li class="col-lg-6">
                                <ul>
                                    <li class="dropdown-header">Summary Of Receivable</li>
                                    <li><a href="SORActiveAccount.php">Active Account</a></li>
                                    <li><a href="SORActiveDelinquentAccount.php">Active Deliquent Account</a></li>
                                    <li><a href="SORActiveLegalAccount.php">Active Legal Account</a></li>
                                    <li><a href="SORDelinquentAccount.php">Deliquent Account</a></li>
                                    
                                </ul>
                            </li>
                            <li class="col-lg-4">
                                <ul>
                                    <li class="dropdown-header">Aging Of Receivable</li>
                                    <li><a href="ARMoving.php">Moving Account</a></li>
                                    <li><a href="ARNotMoving.php">Not Moving Account</a></li>
                                    <li><a href="ARLegal.php">Legal Account</a></li>              
                                </ul>
                            </li>
                        </ul>               
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Others
                        <span class="caret"></span></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="ListOfPending.php">List Of Pending</a></li>
                            <li><a href="ListOfDelinquents.php">List Of Delinquents</a></li> 
                            <li><a href="completedLoans.php">Completed Loans</a></li>
                            <li><a href="SummaryOfBookings.php">Summary of Bookings</a></li>

                        </ul>
                    </li>
                </ul>';

    }

    return $output;



 }



 function navigate_right() 
 {
    $output="";

    if($_SESSION['user']['em_position']=='Operations Manager'){

        $username = $_SESSION['user']['username'];

        $output.='  <li><a href="Usermanagement.php">Manage User</a></li> 
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Welcome, '.$username.' !
                        <span class="caret"></span></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="ChangePassword.php">Change Password</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>';
        
    
    }elseif ($_SESSION['user']['em_position']=='Office Staff') {

        $username = $_SESSION['user']['username'];

        $output.='  <li><a href="ClientAdd.php">Add a Client</a></li> 
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Welcome, '.$username.' !
                        <span class="caret"></span></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="ChangePassword.php">Change Password</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>';

    }

    return $output;



 }


?>

