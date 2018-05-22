<?php
        include 'codes.php';
        if(isset($_POST['AdUsername'])){
            $user = $_POST['AdUsername'];
            $pswd = $_POST['AdPassword'];
            $con = mysqli_connect("localhost", "root", "", "transient");
            
            $qry = 'SELECT * from admin where admin_username = "'.$user.'" and admin_pswd = "'.$pswd.'" ';
            $result = mysqli_query($con,$qry);
            if($row = mysqli_fetch_array($result)){
                    header('Location: adminMod.php');
            } else {
                header('Location: index.php?Login-Failed');
            }
        }
?>
<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" type="text/css" href="./styles/style2.css">
    </head>
    <body>
        <div class="container">
            <img src="./img/user.png">
            <form method="post">
                <h1> Admin Login </h1>
                <div class="form-input">
                    <input class="inputs" type="text" name="AdUsername" placeholder="Enter Username">
                </div>
                <div class="form-input">
                    <input class="inputs" type="password" name="AdPassword" placeholder="Enter Password">
                </div>
                <button class="btn" type="submit">Log-In</button>
            </form>
        </div>
    </body>
</html>