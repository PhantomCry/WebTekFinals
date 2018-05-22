<?php
function showUsers(){
    $qry = 'SELECT * from client where client_status = "Active" ';
                    $con = mysqli_connect("localhost", "root", "", "transient");
                    $result = mysqli_query($con,$qry);
                    while($row = mysqli_fetch_array($result)){
                        echo '<div class="row">';
                        echo '<span class="field">Client ID:</span> '.$row[0].' ';
                        echo '<span class="field">Username:</span> '.$row[1].' ';
                        echo '<span class="field">Password:</span> '.$row[2].' ';
                        echo '<span class="field">First Name:</span> '.$row[4].' ';
                        echo '<span class="field">Last Name:</span> '.$row[5].' ';
                        echo '<span class="field">Email:</span> '.$row[6].' ';
                        echo '<span class="field">Phone Number:</span> '.$row[7].' ';
                        echo '<span class="field">Status:</span> '.$row[8].' ';
                        echo '<br/>
                        <form action="#" method="post">
                        <input class="radh" type="radio" name="DelAUser" value="'.$row[0].'" checked>
                        <button type="submit" id="btn">Delete User</button>
                        </form></div>';
                    }
                    
                    if(isset($_POST['DelAUser'])){
                        $num = $_POST['DelAUser'];
                        
                        $qry = 'DELETE FROM client where client_id = '.$num.' ';
                        
                        mysqli_query($con, $qry);
                        
                    }
}

function showNewClients(){
    $qry = 'SELECT * from client where client_status = "Under Review" ';
                    $con = mysqli_connect("localhost", "root", "", "transient");
                    $result = mysqli_query($con,$qry);
                    while($row = mysqli_fetch_array($result)){
                        echo '<div class="row">';
                        echo '<span class="field">Client ID:</span> '.$row[0].' ';
                        echo '<span class="field">Username:</span> '.$row[1].' ';
                        echo '<span class="field">Password:</span> '.$row[2].' ';
                        echo '<span class="field">First Name:</span> '.$row[4].' ';
                        echo '<span class="field">Last Name:</span> '.$row[5].' ';
                        echo '<span class="field">Email:</span> '.$row[6].' ';
                        echo '<span class="field">Phone Number:</span> '.$row[7].' ';
                        echo '<span class="field">Status:</span> '.$row[8].' ';
                        echo '<br/>
                        <form action="#" class="editUser" method="post">
                        <input class="radh" type="radio" name="UpdateUser" value="'.$row[0].'" checked>
                        Delete Applicant: <input class = "Erabe" type="radio" name="UserEdit" value="Delete">
                        Accept Applicant: <input class = "Erabe" type="radio" name="UserEdit" value="Active">
                        <button type="submit" id="btn">Save Changes</button>
                        </form>
                        </div> ';
                    }
                    
                    
                    if(isset($_POST['UserEdit'])){
                        $cNo = $_POST['UpdateUser'];
                        $update = $_POST['UserEdit'];
                        if($update == "Delete"){
                          $qry = 'DELETE FROM client where client_id = '.$cNo.' ';
                        
                            mysqli_query($con, $qry);

                        }
                        
                        if($update == "Accept"){
                            $qry = 'UPDATE client SET client_status = "'.$update.'" where client_id = "'.$cNo.'" ';
                            mysqli_query($con, $qry);

                        }
                    }
}

function showProviders(){
    $qry = 'SELECT * from provider where rep_status = "Active" ';
                    $con = mysqli_connect("localhost", "root", "", "transient");
                    $result = mysqli_query($con,$qry);
                    while($row = mysqli_fetch_array($result)){
                        echo '<div class="row">';
                        echo '<span class="field">Provider ID:</span> '.$row[0].' ';
                        echo '<span class="field">Username:</span> '.$row[2].' ';
                        echo '<span class="field">Password:</span> '.$row[3].' ';
                        echo '<span class="field">Business:</span> '.$row[4].' ';
                        echo '<span class="field">Representative First Name:</span> '.$row[5].' ';
                        echo '<span class="field">Representative Last Name:</span> '.$row[6].' ';
                        echo '<span class="field">RepresentativeEmail:</span> '.$row[7].' ';
                        echo '<span class="field">RepresentativePhone Number:</span> '.$row[8].' ';
                        echo '<span class="field">Status:</span> '.$row[9].' ';
                        echo '<br/>
                        <form action="#" method="post">
                        <input class="radh" type="radio" name="DelAProvider" value="'.$row[0].'" checked>
                        <button type="submit" id="btn">Delete Provider</button>
                        </form></div>';
                    }
                    
                    if(isset($_POST['DelAProvider'])){
                        $num = $_POST['DelAProvider'];
                        
                        $qry = 'DELETE FROM provider where prov_id = '.$num.' ';
                        
                        mysqli_query($con, $qry);
                    }
}

function showNewProviders(){
    $qry = 'SELECT * from provider where rep_status = "Under Review" ';
                    $con = mysqli_connect("localhost", "root", "", "transient");
                    $result = mysqli_query($con,$qry);
                    while($row = mysqli_fetch_array($result)){
                        echo '<div class="row">';
                        echo '<span class="field">Provider ID:</span> '.$row[0].' ';
                        echo '<span class="field">Username:</span> '.$row[2].' ';
                        echo '<span class="field">Password:</span> '.$row[3].' ';
                        echo '<span class="field">Business:</span> '.$row[4].' ';
                        echo '<span class="field">Representative First Name:</span> '.$row[5].' ';
                        echo '<span class="field">Representative Last Name:</span> '.$row[6].' ';
                        echo '<span class="field">RepresentativeEmail:</span> '.$row[7].' ';
                        echo '<span class="field">RepresentativePhone Number:</span> '.$row[8].' ';
                        echo '<span class="field">Status:</span> '.$row[9].' ';
                        echo '<br/>
                        <form action="#" class="editUser" method="post">
                        <input class="radh" type="radio" name="UpdateProvider" value="'.$row[0].'" checked>
                        Delete Applicant: <input class = "Erabe" type="radio" name="ProvEdit" value="Delete">
                        Accept Applicant: <input class = "Erabe" type="radio" name="ProvEdit" value="Active">
                        <button type="submit" id="btn">Save Changes</button>
                        </form>
                        </div> ';
                    }
                    
                    
                    if(isset($_POST['ProvEdit'])){
                        $cNo = $_POST['UpdateProvider'];
                        $update = $_POST['ProvEdit'];
                        if($update == "Delete"){
                          $qry = 'DELETE FROM provider where prov_id = '.$cNo.' ';
                        
                            mysqli_query($con, $qry);

                        }
                        
                        if($update == "Active"){
                            $qry = 'UPDATE provider SET rep_status = "'.$update.'" where prov_id = "'.$cNo.'" ';
                            mysqli_query($con, $qry);

                        }
                    }
}
?>