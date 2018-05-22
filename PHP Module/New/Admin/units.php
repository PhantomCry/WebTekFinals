<?php
 echo '<div class = "Left">';
    echo '<div class = "tableName"> <span class="title">New Units</span></div>';
    echo '<div class = "content">';
 $con=mysqli_connect("localhost","root","","transient");
                        $qry='select * from units natural join provider where post_status = "under review";';
                        $result=mysqli_query($con,$qry);
                        while($row = mysqli_fetch_array($result)){
                            echo '<div class="box">
                            <span class="field">UNIT ID: '.$row['trans_id'].'</span>
                            </br>
                            <span class="field">'.$row['condo_name'].'</span>
                            </br>
                            <span class="field">Capacity: '.$row['unit_capacity'].'</span>
                            </br>
                            <span class="field">Rent per month:'.$row['price_per_night'].'</span>
                            </br>
                            <span class="field">Address : '.$row['unit_address'].'</span>
                            </br>
                            Description:
                            </br>
                            <span class="field">'.$row['unit_description'].'</span>
                            </br>
                            Contact info: 
                            <span class="field">'.$row['rep_phoneno'].' / '.$row['rep_email'].'</span>
                            <br/>
							<form method="post">
                                <input class="radh" type="radio" name="ID" value="'.$row['trans_id'].'" checked>
                                Decline<input type="radio" name="status" value="Declined">
                                Approve<input type="radio" name="status" value="Approved">
                                
								<button type="submit" id="btn">Update</button>
                            </form>
                            </div>';     
                        }
                        mysqli_close($con);

echo '</div>';
    echo '</div>';
 echo '<div class = "Left">';
    echo '<div class = "tableName"> <span class="title">Accepted Units</span></div>';
    echo '<div class = "content">';
$con=mysqli_connect("localhost","root","","transient");
                        $qry='select * from units natural join provider where post_status = "Approved";';
                        $result=mysqli_query($con,$qry);
                        while($row = mysqli_fetch_array($result)){
                            echo '<div class="box">
                            <span class="ID">UNIT ID: '.$row['trans_id'].'</span>
                            </br>
                            <span class="DormName">'.$row['condo_name'].'</span>
                            </br>
                            <span class="Capacity">Capacity: '.$row['unit_capacity'].'</span>
                            </br>
                            <span class="Rent">Rent per month:'.$row['price_per_night'].'</span>
                            </br>
                            <span class="Address">Address : '.$row['unit_address'].'</span>
                            </br>
                            Description:
                            </br>
                            <span class="Description">'.$row['unit_description'].'</span>
                            </br>
                            Contact info: 
                            <span class="Contact">'.$row['rep_phoneno'].' / '.$row['rep_email'].'</span>
                            <br/><br/>
							<form method="post">
                                <input class="radh" type="radio" name="ID" value="'.$row['trans_id'].'" checked>
                                <input class="radh" type="radio" name="status" value="Declined" checked>
								<button type="submit" id="btn">Delete</button>
                            </form>
                            </div>';     
                        }
                     mysqli_close($con);
echo '</div>';
    echo '</div>';
?>