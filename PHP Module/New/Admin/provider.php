<?php
  echo '<div class = "right">';
    echo '<div class = "tableName"> <span class="title">ACTIVE PROVIDERS</span></div>';
    echo '<div class = "content">';
$qry = 'SELECT * from provider where rep_status = "Active" ';
                    $con = mysqli_connect("localhost", "root", "", "transient");
                    $result = mysqli_query($con,$qry);
                    while($row = mysqli_fetch_array($result)){
                        echo '<div class="box">';
                        echo '<span class="field">Provider ID:</span> '.$row[0].'<br/> ';
                        echo '<span class="field">Username:</span> '.$row[2].'<br/> ';
                        echo '<span class="field">Password:</span> '.$row[3].'<br/> ';
                        echo '<span class="field">Business:</span> '.$row[4].'<br/> ';
                        echo '<span class="field">Representative First Name:</span> '.$row[5].'<br/> ';
                        echo '<span class="field">Representative Last Name:</span> '.$row[6].'<br/> ';
                        echo '<span class="field">RepresentativeEmail:</span> '.$row[7].'<br/> ';
                        echo '<span class="field">RepresentativePhone Number:</span> '.$row[8].'<br/> ';
                        echo '<span class="field">Status:</span> '.$row[9].'<br/> ';
                        echo '<br/>
                        <form action="#" method="post">
                        <input class="radh" type="radio" name="DelAProvider" value="'.$row[0].'" checked>
                        <button type="submit" id="btn">Delete Provider</button>
                        </form></div>';
                    }

echo '</div>';
    echo '</div>';

 echo '<div class = "left">';
    echo '<div class = "tableName"> <span class="title">NEW PROVIDERS</span></div>';
    echo '<div class = "content">';
$qry = 'SELECT * from provider where rep_status = "Under Review" ';
                    $con = mysqli_connect("localhost", "root", "", "transient");
                    $result = mysqli_query($con,$qry);
                    while($row = mysqli_fetch_array($result)){
                        echo '<div class="box">';
                        echo '<span class="field">Provider ID:</span> '.$row[0].'<br/> ';
                        echo '<span class="field">Username:</span> '.$row[2].'<br/> ';
                        echo '<span class="field">Password:</span> '.$row[3].'<br/> ';
                        echo '<span class="field">Business:</span> '.$row[4].'<br/> ';
                        echo '<span class="field">Representative First Name:</span> '.$row[5].'<br/> ';
                        echo '<span class="field">Representative Last Name:</span> '.$row[6].'<br/> ';
                        echo '<span class="field">RepresentativeEmail:</span> '.$row[7].'<br/> ';
                        echo '<span class="field">RepresentativePhone Number:</span> '.$row[8].'<br/> ';
                        echo '<span class="field">Status:</span> '.$row[9].'<br/> ';
                        echo '<br/>;
                        <form action="#" class="editUser" method="post">
                        <input class="radh" type="radio" name="UpdateProvider" value="'.$row[0].'" checked>
                        Delete Applicant: <input class = "Erabe" type="radio" name="ProvEdit" value="Delete"><br/>
                        Accept Applicant: <input class = "Erabe" type="radio" name="ProvEdit" value="Active"><br/><br/>
                        <button type="submit" id="btn">Save Changes</button>
                        </form>
                        </div> ';
                    }


echo '</div>';
echo '</div>';
                    
                    
?>