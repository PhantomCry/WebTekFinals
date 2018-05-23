<?php
include_once('db.php');
include_once('isset.php');
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
                <li><button id="MC">Manage Clients</button></li>
                <li><button id="MP">Manage Providers</button></li>
                <li><button id="MU">Manage Units</button></li>
                <li><button id="UR">Client Registration</button></li>
                <li><button id="PR">Provider Registration</button></li>
                <li><button id="NU">New Units</button></li>
                <li><button></button></li>
                
                <br/>
                <h2>
                <a class="trans" href="succTrans.php">
                See Transactions</a>
                    
                </h2>
            </ul>
        </div>
        
        
        
        <div id="result" class="visible">
        </div>
        
        <script type=text/javascript src="jquery-3.3.1.min.js"></script>
        <script type=text/javascript src="my_script.js"></script>
    </body>
</html>