<html>
    <head>
        
    </head>
    <link rel="stylesheet" href="style.css">
    <body>
        <dir id="container">
            <header id="menu">
                <span id="title">
                    ADMIN    
                </span> 
            </header>
            <dir id="pending" class="units">
                <div class="top">Pending</div> 
                <div class="contents">
                <?php
                        $con=mysqli_connect("localhost","root","","transient");
                        $qry='select * from trans_unit natural join provider where status = "Waiting for approvement from admin";';
                        $result=mysqli_query($con,$qry);
                        while($row = mysqli_fetch_array($result)){
                            echo '<div class="rooms">
                            <span class="ID">UNIT ID: '.$row['trans_id'].'</span>
                            </br>
                            <span class="DormName">'.$row['business_name'].'</span>
                            </br>
                            <span class="Capacity">Capacity: '.$row['unit_capacity'].'</span>
                            </br>
                            <span class="Rent">Rent per month:'.$row['price_per_night'].'</span>
                            </br>
                            <span class="Address">Address : '.$row['unit_address'].'</span>
                            </br>
                            Description:
                            </br>
                            <span class="Description">'.$row['unit_desccription'].'</span>
                            </br>
                            Contact info: 
                            <span class="Contact">'.$row['rep_phoneno'].' / '.$row['rep_email'].'</span>
							<form action="process.php" method="post">
                                <input class="rad" type="radio" name="ID" value="'.$row['trans_id'].'" checked>
                                Approve<input type="radio" name="status" value="Approved" checked>
                                Decline<input type="radio" name="status" value="Declined" checked>
								<input type="submit" name="select" value="Approved">
                            </form>
                            </div>';     
                        }
                        mysqli_close($con);
                    ?>
                </div>
            </dir>
            <dir id="rejected" class="units">
                <div class="top">Rejected</div>
                <div class="contents">
                 <?php
                        $con=mysqli_connect("localhost","root","","transient");
                        $qry='select * from trans_unit natural join provider where status = "Declined";';
                        $result=mysqli_query($con,$qry);
                        while($row = mysqli_fetch_array($result)){
                            echo '<div class="rooms">
                            <span class="ID">UNIT ID: '.$row['trans_id'].'</span>
                            </br>
                            <span class="DormName">'.$row['business_name'].'</span>
                            </br>
                            <span class="Capacity">Capacity: '.$row['unit_capacity'].'</span>
                            </br>
                            <span class="Rent">Rent per month:'.$row['price_per_night'].'</span>
                            </br>
                            <span class="Address">Address : '.$row['unit_address'].'</span>
                            </br>
                            Description:
                            </br>
                            <span class="Description">'.$row['unit_desccription'].'</span>
                            </br>
                            Contact info: 
                            <span class="Contact">'.$row['rep_phoneno'].' / '.$row['rep_email'].'</span>
							<form action="process.php" method="post">
                                <input class="rad" type="radio" name="ID" value="'.$row['trans_id'].'" checked>
                                <input class="rad" type="radio" name="status" value="Approved" checked>
								<input type="submit" name="select" value="Approved">
                            </form>
                            </div>';     
                        }
                     mysqli_close($con);
                    ?>
                </div>
            </dir>
            <dir id="accepted" class="units">
                <div class="top">Accepted</div> 
                <div class="contents">
                <?php
                        $con=mysqli_connect("localhost","root","","transient");
                        $qry='select * from trans_unit natural join provider where status = "Approved";';
                        $result=mysqli_query($con,$qry);
                        while($row = mysqli_fetch_array($result)){
                            echo '<div class="rooms">
                            <span class="ID">UNIT ID: '.$row['trans_id'].'</span>
                            </br>
                            <span class="DormName">'.$row['business_name'].'</span>
                            </br>
                            <span class="Capacity">Capacity: '.$row['unit_capacity'].'</span>
                            </br>
                            <span class="Rent">Rent per month:'.$row['price_per_night'].'</span>
                            </br>
                            <span class="Address">Address : '.$row['unit_address'].'</span>
                            </br>
                            <span class="Status">Status : '.$row['vacancy'].'</span>
                            </br>
                            Description:
                            </br>
                            <span class="Description">'.$row['unit_desccription'].'</span>
                            </br>
                            Contact info: 
                            <span class="Contact">'.$row['rep_phoneno'].' / '.$row['rep_email'].'</span>
							<form action="process.php" method="post">
                                <input class="rad" type="radio" name="ID" value="'.$row['trans_id'].'" checked>
                                <input class="rad" type="radio" name="status" value="Declined" checked>
								<input type="submit" name="select" value="Decline">
                            </form>
                            </div>';     
                        }
                     mysqli_close($con);
                    ?>
                </div>
                
            </dir>
        </dir>
    </body>
</html>


<?php
    
?>