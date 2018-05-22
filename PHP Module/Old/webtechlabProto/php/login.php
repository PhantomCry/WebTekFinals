<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbase = "dormitory";
    $conn = new mysqli($host, $user, $password, $dbase);
    if(!$conn){
        die("Connection failed: " . $conn->connect_error);
    } else {
        if(isset($_POST['user'])){
            $user = $_POST['user'];
        }
        if(isset($_POST['pass'])){
              $pass = $_POST['pass'];
        }
        $sql = "select * from admin where admin_username like '$user' AND admin_password like '$pass'";
        $result = mysqli_query($conn,$sql);
        $rows = $result->num_rows;
        $index = '../index.html';

        if($rows == 0){
            Header("Location: ../indexd.php");
        } else {
            Header("Location: ../admin.php");
        }
    }
    $conn->close();
    

?>