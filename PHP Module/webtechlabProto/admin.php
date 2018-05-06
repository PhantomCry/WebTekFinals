<html>
    <head>
        
    </head>
    <link rel="stylesheet" href="style.css">
    <body>
        <div class="container">
            <div id="admin-register">
                <header class="top">
                    Register (Admin)
                </header>
                <form action="./php/register-admin.php" method="post" enctype="multipart/form-data">

                    <label class="text-white" for="first">First Name</label>
                    <input type="text" placeholder="First Name" name="first" required>
                    
                    <label class="text-white" for="last">Last Name</label>
                    <input type="text" placeholder="Last Name" name="last" required>
                    
                    <label class="text-white" for="username">Username</label>
                    <input type="text" placeholder="Username" name="user" required>
                    
                    <label class="text-white" for="pass">Password</label>
                    <input type="password" placeholder="Password" name="pass" required>
                    
                    <label class="text-white" for="re-pass">Re-Type Password</label>
                    <input type="password" placeholder="Password" name="re-pass" required>
                    
                    <label class="text-white" for="email">Contact Number</label>
                    <input type="text" placeholder="Contact number" name="contact" required>
                    
                    <label class="text-white" for="email">Email</label>
                    <input type="text" placeholder="email" name="email" required>
                    
                    <input type="submit" name="submit" id="login" value="Register">
                </form>
            </div>
            <div id="rooms">
                <div id="left">
                    <header class="top">
                        Not-Posted
                    </header>
                    <?php
                        $con=mysqli_connect("localhost","root","","dormitory");
                        $qry='select * from rooms natural join (dorm_provider natural join provider_info) where status = "Not-Posted";';
                        $result=mysqli_query($con,$qry);
                        while($row = mysqli_fetch_array($result)){
                            echo '<div class="rooms">
                            <span class="ID">Room ID: '.$row[0].'</span>
                            </br>
                            <span class="DormName">'.$row[13].'</span>
                            </br>
                            <span class="Capacity">Capacity: '.$row[3].'</span>
                            <span class="Rent">Rent per month:'.$row[5].'</span>
                            </br>
                            <span class="Address">Address : '.$row[4].'</span>
                            </br>
                            Description:
                            </br>
                            <span class="Description">'.$row[2].'</span>
                            </br>
                            Contact info: 
                            <span class="Contact">'.$row[11].' / '.$row[12].'</span>
                            
                            </div>';     
                        }
                        mysqli_close($con);
                    ?>
                </div>
                <div id="right">
                    <header class="top">
                        Posted
                    </header>
                    <?php
                        $con=mysqli_connect("localhost","root","","dormitory");
                        $qry='select * from rooms natural join (dorm_provider natural join provider_info) where status = "Posted";';
                        $result=mysqli_query($con,$qry);
                        while($row = mysqli_fetch_array($result)){
                            echo '<div class="rooms">
                            <span class="ID">Room ID: '.$row[0].'</span>
                            </br>
                            <span class="DormName">'.$row[13].'</span>
                            </br>
                            <span class="Capacity">Capacity: '.$row[3].'</span>
                            <span class="Rent">Rent per month:'.$row[5].'</span>
                            </br>
                            <span class="Address">Address : '.$row[4].'</span>
                            </br>
                            Description:
                            </br>
                            <span class="Description">'.$row[2].'</span>
                            </br>
                            Contact info: 
                            <span class="Contact">'.$row[11].' / '.$row[12].'</span>
                            
                            </div>';     
                        }
                        mysqli_close($con);
                    ?>
                    
                </div>
                
                <div id="alter">
                    Ilagay nlng dito ung pag alter ng Not-Posted at Posted na authorozed. FORM!
                </div>

                
            </div>
            
        </div>
    </body>
</html>