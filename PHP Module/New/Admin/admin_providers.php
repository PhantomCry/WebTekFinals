<?php
        include 'codes.php';
        if(isset($_POST['AdUsername'])){
            $user = $_POST['AdUsername'];
            $pswd = $_POST['AdPassword'];
            $con = mysqli_connect("localhost", "root", "", "transient");
            
            $qry = 'SELECT * from admin where admin_username = "'.$user.'" and admin_pswd = "'.$pswd.'" ';
            $result = mysqli_query($con,$qry);
            if($row = mysqli_fetch_array($result)){

            } else {
                header('Location: index.php?Login-Failed');
            }
        }
?>


<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="./styles/style1.css">
    </head>
    <body>
       <div class="content">
            <header id="menu">
                <span id="title">
                    ADMIN    
                </span> 
                <a class="title" href="admin_clients.php">Clients</a>
                <a class="title" href="units.php">Units</a>
            </header>
            <div class="divider">
            </div>
            <div id="providers">
                <div class="title">Provider Management</div>
                <div class="divider"></div>
                <div class="title">Active Providers</div>
                <div class="showUsers">
                   <?php
                        echo showProviders();
                    ?>
                </div>
                <div class="divider"></div>
                <div class="title">New Providers</div>
                <div class="showUsers">
                   <?php
                    echo showNewProviders();
                    ?>
                </div>
            </div>
            
            
       </div>
    </body>
</html>