<?php
    if(isset($_POST['submit'])){
        $first= $_POST['first'];
        $last= $_POST['last'];
        $username = $_POST['user'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        $type = $_POST['type'];      
        savedata($first,$last,$username,$pass,$email,$type);
        goback();
    }                

function savedata($first,$last,$username,$pass,$email,$type){
        $con=mysqli_connect("localhost","root","","dormitory");
        $qry="insert into admin (amind_username, admin_password) values('$username','$pass','$first','$last','$email','$type')";
        $result=mysqli_query($con,$qry) or die("ded");

        mysqli_close($con);
            
}

function goback(){
    Header("Location: ../admin.php");
}

?>