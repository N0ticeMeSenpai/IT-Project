<?php  

function navigate_it() 
 {
    $output="";

    if($_SESSION['user']['em_position']=='Operations Manager'){

    $output.='<ul class="nav navbar-nav">
                    <li><a href="AdminDashboard.php">Dashboard</a></li>
                    <li class="dropdown mega-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">More<span class="caret"></span></a>                
                        <ul class="dropdown-menu mega-dropdown-menu">
                            <li class="col-lg-4">
                                <ul>
                                    <li class="dropdown-header">Summary of Receivable</li>
                                    <li><a href="SORActiveAccount.php">Active Account</a></li>
                                    <li><a href="SORActiveDelinquentAccount.php">Active Deliquent</a></li>
                                    <li><a href="SORActiveLegalAccount.php">Active Legal Account</a></li>
                                    <li><a href="SORDelinquentAccount.php">Deliquent Account</a></li>
                                    <li><a href="Bookings.php">Summary of Bookings</a></li>
                                </ul>
                            </li>
                            <li class="col-lg-4">
                                <ul>
                                    <li class="dropdown-header">Others</li>
                                    <li><a href="OPListOfPendingClient.php">List Of Pending</a></li>
                                    <li><a href="ListOfDelinquents.php">List Of Delinquents</a></li>             
                                </ul>
                            </li>
                        </ul>               
                    </li>
                </ul>';
        
    
    }elseif ($_SESSION['user']['em_position']=='Office Staff') {

        $output.=' <ul class="nav navbar-nav">
                    <li><a href="AdminDashboard.php">Dashboard</a></li>
                    <li class="dropdown mega-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">More<span class="caret"></span></a>                
                        <ul class="dropdown-menu mega-dropdown-menu">
                            <li class="col-lg-6">
                                <ul>
                                    <li class="dropdown-header">Summary of Receivable</li>
                                    <li><a href="SORActiveAccount.php">Active Account</a></li>
                                    <li><a href="SORActiveDelinquentAccount.php">Active Deliquent</a></li>
                                    <li><a href="SORActiveLegalAccount.php">Active Legal Account</a></li>
                                    <li><a href="SORDelinquentAccount.php">Deliquent Account</a></li>
                                    <li><a href="Bookings.php">Summary of Bookings</a></li>
                                </ul>
                            </li>
                            <li class="col-lg-6">
                                <ul>
                                    <li class="dropdown-header">Others</li>
                                    <li><a href="OFListOfRegisteredClient.php">Client Registered</a></li>
                                    <li><a href="OPListOfPendingClient.php">List Of Pending</a></li>
                                    <li><a href="ListOfDelinquents.php">List Of Delinquents</a></li>                         
                                </ul>
                            </li>
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

    $output.='     <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                          <img src="img/search2.png" width="15px"></a>
                        <ul class="dropdown-menu">
                            <li>
                              <form class ="line" action="search.php" method="post">
                                    <input id="myInput" type="text" placeholder="Search Client..." name="search"
                                    style="width: 100%;height: 34px;border: none;padding: 4px;outline:none;">
                                    <input class="hide" type="submit" value="Search">
                              </form>  
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><img src="img/setting.png" width="15px"><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="Usermanagement.php">Manage User</a></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>';
        
    
    }elseif ($_SESSION['user']['em_position']=='Office Staff') {

        $output.='  <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                          <img src="img/search2.png" width="15px"></a>
                        <ul class="dropdown-menu">
                            <li>
                              <form class ="line" action="search.php" method="post">
                                    <input id="myInput" type="text" placeholder="Search Client..." name="search"
                                    style="width: 100%;height: 34px;border: none;padding: 4px;outline:none;">
                                    <input class="hide" type="submit" value="Search">
                              </form>  
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle"><img src="img/setting.png" width="15px"><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="ClientAdd.php">Add a Client</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>';

    }

    return $output;



 }


?>

