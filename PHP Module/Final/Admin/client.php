<?php
    include_once('db.php');
    
    echo '<h1>MANAGE CLIENTS</h1>';
    echo '<div class="box">';
    echo '<h2>ACTIVE USERS</h2>';
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
    echo '<th>DEACTIVATE</th>';
    echo '<tr/>';
    $qry = 'SELECT * from client where client_status = "Active" ';
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
                        <input class="radh" type="radio" name="BanAUser" value="'.$row[0].'" checked>
                        <button type="submit" class="btn">DEACTIVATE ACCOUNT</button>
                        </form>
                        </th>
                        </tr>';
                    }
    echo '</table>';
    echo '</div>';

    echo '<div class="box">';
    echo '<h2>BANNED USERS</h2>';
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
    echo '<th>ACTIVATE</th>';
    echo '<tr/>';
    $qry = 'SELECT * from client where client_status = "Deactivated" ';
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
                        <td>
                        <form method="post">
                        <input class="radh" type="radio" name="UnBanAUser" value="'.$row[0].'" checked>
                        <button type="submit" class="btn">ACTIVATE</button>
                        </form>
                        </td>
                        </tr>';
                    }
    echo '</div>';

   
?>


