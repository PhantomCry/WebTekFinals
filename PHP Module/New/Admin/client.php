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
<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="./styles/style1.css">
    </head>
    <body>
        <h1><a href="adminMod.php">ADMIN</a></h1>
        <div id="sidebar" class="visible">
            <ul>
                <li><a href="adminMod.php">Home</a></li>
                <li><a href="client.php">Manage Clients</a></li>
                <li><a href="provider.php">Manage Providers</a></li>
                <li><a href="units.php">Manage Units</a></li>
            </ul>
        </div>
        
        <script type=text/javascript src="jquery-3.3.1.min.js"></script>
        <script type=text/javascript src="my_script.js"></script>
    </body>
</html>


