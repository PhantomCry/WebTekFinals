<?php
    include_once('db.php');
    
    echo '<h1>MANAGE CLIENTS</h1>';
    echo '<div class="box">';
    echo '<h2>NEW USERS</h2>';
    $qry = 'SELECT * from client where client_status = "under review" ';
    $result = mysqli_query($con,$qry);
    echo '<form action="" method="post">
                   <input type = "radio" class = "radh" name="AAll">
                   <button type="submit" class="btn-1" style="width:200px">ACCEPT ALL PROVIDER ACCOUNTS</button>
                   
    </form>';
echo '<br/>';
echo '<form action="" method="post">
                   <input type = "radio" class = "radh" name="DAll">
                   <button type="submit" class="btn-1" style="width:200px">DECLINE ALL PROVIDER ACCOUNTS</button>
                   
    </form>';
    if(isset($_POST['AAll'])){
    while($row = mysqli_fetch_array($result)){
 
                        if($update == "Active"){
                            $qry = 'UPDATE client SET client_status = "ACTIVATE" where client_status = "under review" && client_id = "'.$row['trans_id'].'" ';
                            mysqli_query($con, $qry);
                            
                            header("Refresh:0");

                        
                    }                   
            }
        
    }
if(isset($_POST['DAll'])){
    while($row = mysqli_fetch_array($result)){
 
                        if($update == "Active"){
                            $qry = 'UPDATE client SET client_status = "ACTIVATE" where client_status = "under review" && client_id = "'.$row['trans_id'].'" ';
                            mysqli_query($con, $qry);
                            
                            header("Refresh:0");

                        
                    }                   
            }
        
    }
    echo '<table>';
    echo '<tr>';
    echo '<th>Client ID</th>';
    echo '<th>Username</th>';
    echo '<th>Password</th>';
    echo '<th>First Name</th>';
    echo '<th>Last Name</th>';
    echo '<th>Email</th>';
    echo '<th>Phone Number</th>';
    echo '<th>Status</th>';
    echo '<th>CHOOSE TO APPROVE ACCOUNT</th>';
    echo '<th>CHOOSE TO DENY ACCOUNT</th>';
    echo '<tr/>';
    $qry = 'SELECT * from client where client_status = "under review" ';
    $result = mysqli_query($con,$qry);
                    while($row = mysqli_fetch_array($result)){
                        echo '<tr>';
                        echo '<td>'.$row[0].'</td>';
                        echo '<td>'.$row[1].'</td>';
                        echo '<td>'.$row[2].'</td>';
                        echo '<td>'.$row[4].'</td>';
                        echo '<td>'.$row[5].'</td>';
                        echo '<td>'.$row[6].'</td>';
                        echo '<td>'.$row[7].'</td>';
                        echo '<td>'.$row[8].'</td>';
                        echo '
                        <th>
                        <form method="post">
                                <input class="radh" type="radio" name="newClientApprove" value="'.$row['client_id'].'" checked>
                                
								<button type="submit" class="btn">APPROVE CLIENT ACCOUNT</button>
                            </form>
                        </th>
                        <th>
                        <form method="post">
                                <input class="radh" type="radio" name="newClientDecline" value="'.$row['client_id'].'" checked>
								<button type="submit" class="btn">DENY CLIENT ACCOUNT</button>
                            </form>
                        </th>
                        </tr>';
                    }
    echo '</table>';
    echo '</div>';
   
?>


