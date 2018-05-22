<?php
    include_once('db.php');

    echo '<div class = "right">';
    echo '<div class = "tableName"> <span class="title">ACTIVE USERS</span></div>';
    echo '<div class = "content">';
    $qry = 'SELECT * from client where client_status = "Active" ';
                    $con = mysqli_connect("localhost", "root", "", "transient");
                    $result = mysqli_query($con,$qry);
                    while($row = mysqli_fetch_array($result)){
                        echo '<div class="box">';
                        echo '<span class="field">Client ID:</span> '.$row[0].'<br/> ';
                        echo '<span class="field">Username:</span> '.$row[1].'<br/> ';
                        echo '<span class="field">Password:</span> '.$row[2].'<br/> ';
                        echo '<span class="field">First Name:</span> '.$row[4].'<br/> ';
                        echo '<span class="field">Last Name:</span> '.$row[5].'<br/> ';
                        echo '<span class="field">Email:</span> '.$row[6].'<br/> ';
                        echo '<span class="field">Phone Number:</span> '.$row[7].'<br/> ';
                        echo '<span class="field">Status:</span> '.$row[8].'<br/> ';
                        echo '<br/>
                        <form method="post">
                        <input class="radh" type="radio" name="DelAUser" value="'.$row[0].'" checked>
                        <button type="submit" id="btn">Delete User</button>
                        </form></div><br/><br/>';
                    }
    echo '</div>';
    echo '</div>';

    echo '<div class = "left">';
    echo '<div class = "tableName"> <span class="title">NEW USERS</span></div>';
    echo '<div class = "content">';
     $qry = 'SELECT * from client where client_status = "Under Review" ';
                    $con = mysqli_connect("localhost", "root", "", "transient");
                    $result = mysqli_query($con,$qry);
                    while($row = mysqli_fetch_array($result)){
                        echo '<div class="box">';
                        echo '<span class="field">Client ID:</span> '.$row[0].'<br/> ';
                        echo '<span class="field">Username:</span> '.$row[1].'<br/> ';
                        echo '<span class="field">Password:</span> '.$row[2].'<br/> ';
                        echo '<span class="field">First Name:</span> '.$row[4].'<br/> ';
                        echo '<span class="field">Last Name:</span> '.$row[5].'<br/> ';
                        echo '<span class="field">Email:</span> '.$row[6].'<br/> ';
                        echo '<span class="field">Phone Number:</span> '.$row[7].'<br/> ';
                        echo '<span class="field">Status:</span> '.$row[8].'<br/> ';
                        echo '<br/>
                        <form class="editUser" method="post">
                        <input class="radh" type="radio" name="UpdateUser" value="'.$row[0].'" checked>
                        Delete Applicant: <input class = "Erabe" type="radio" name="UserEdit" value="Delete" require><br/>
                        Accept Applicant: <input class = "Erabe" type="radio" name="UserEdit" value="Active" require>
                        <button type="submit" id="btn">Save Changes</button>
                        </form>
                        </div> ';
                    }
                    
                    
                    
    echo '</div>';
    echo '</div>';
?>




