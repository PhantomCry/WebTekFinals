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
    echo '<th>ACCEPT PROVIDER</th>';
    echo '<th>DECLINE PROVIDER</th>';
    echo '<tr/>';
    $qry = 'SELECT * from provider where rep_status = "under review" ';
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
                        echo '
                        <td>
                        <form action="#" method="post">
                        <input class="radh" type="radio" name="AcceptAProvider" value="'.$row[0].'" checked>
                        <button type="submit" class="btn">ACCEPT PROVIDER</button>
                        </form>
                        </td>
                        <td>
                        <form action="#" method="post">
                        <input class="radh" type="radio" name="DeclineAProvider" value="'.$row[0].'" checked>
                        <button type="submit" class="btn">DECLINE PROVIDER</button>
                        </form>
                        </td>
                        </tr>';
                    }
echo '</table>';
echo '</div>';
?>