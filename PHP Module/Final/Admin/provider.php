<?php
    include_once('db.php');
    echo '<h1>MANAGE PROVIDERS</h1>';
    echo '<div class="box">';
    echo '<h2>ACTIVE PROVIDERS</h2>';
    echo '<table>';
    echo '<tr>';
    echo '<th>Provider ID</th>';
    echo '<th>Username</th>';
    echo '<th>Password</th>';
    echo '<th>Business Name</th>';
    echo '<th>Representative\'s First Name</th>';
    echo '<th>Representative\'s Last Name</th>';
    echo '<th>Representative\'s Email</th>';
    echo '<th>Representative\'s Phone Number</th>';
    echo '<th>Status</th>';
    echo '<th>Deactivate</th>';
    echo '<tr/>';
    $qry = 'SELECT * from provider where rep_status = "Active" ';
                    $result = mysqli_query($con,$qry);
                    while($row = mysqli_fetch_array($result)){
                        echo '<tr>';
                        echo '<td>'.$row[0].'</td>';
                        echo '<td>'.$row[2].'</td>';
                        echo '<td>'.$row[3].'</td>';
                        echo '<td>'.$row[4].'</td>';
                        echo '<td>'.$row[5].'</td>';
                        echo '<td>'.$row[6].'</td>';
                        echo '<td>'.$row[7].'</td>';
                        echo '<td>'.$row[8].'</td>';
                        echo '<td>'.$row[9].'</td>';
                        echo '<td>
                        <form action="#" method="post">
                        <input class="radh" type="radio" name="BanAProvider" value="'.$row[0].'" checked>
                        <button type="submit" class="btn">Deactivate Account</button>
                        </form>
                        </td>
                        </tr>';
                    }
echo '</table>';
echo '</div>';

    echo '<div class="box">';
    echo '<h2>DEACTIVE PROVIDERS</h2>';
    echo '<table>';
    echo '<tr>';
    echo '<th>Provider ID</th>';
    echo '<th>Username</th>';
    echo '<th>Password</th>';
    echo '<th>Business Name</th>';
    echo '<th>Representative\'s First Name</th>';
    echo '<th>Representative\'s Last Name</th>';
    echo '<th>Representative\'s Email</th>';
    echo '<th>Representative\'s Phone Number</th>';
    echo '<th>Status</th>';
    echo '<th>Activate</th>';
    echo '<tr/>';
    $qry = 'SELECT * from provider where rep_status = "Deactivated" ';
                    $result = mysqli_query($con,$qry);
                    while($row = mysqli_fetch_array($result)){
                        echo '<tr>';
                        echo '<td>'.$row[0].'</td>';
                        echo '<td>'.$row[2].'</td>';
                        echo '<td>'.$row[3].'</td>';
                        echo '<td>'.$row[4].'</td>';
                        echo '<td>'.$row[5].'</td>';
                        echo '<td>'.$row[6].'</td>';
                        echo '<td>'.$row[7].'</td>';
                        echo '<td>'.$row[8].'</td>';
                        echo '<td>'.$row[9].'</td>';
                        echo '<td>
                        <form action="#" method="post">
                        <input class="radh" type="radio" name="UnBanAProvider" value="'.$row[0].'" checked>
                        <button type="submit" class="btn">Activate</button>
                        </form>
                        </td>
                        </tr>';
                    }
echo '</table>';
echo '</div>'; 
?>