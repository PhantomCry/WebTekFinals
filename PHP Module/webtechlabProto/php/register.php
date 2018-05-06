<?php
    if(isset($_POST['submit'])){
        $first= $_POST['first'];
        $last= $_POST['last'];
        $username = $_POST['user'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        $type = $_POST['type'];      
        $pass = sha1($pass);
//        savedata($first,$last,$username,$pass,$email,$type);
//        goback();
        echo $type;
    }                

function savedata($first,$last,$username,$pass,$email,$type){
        $con=mysqli_connect("localhost","root","","webtechproto");
        $qry="insert into account (username,password,first_name,last_name,account_email,type) values('$username','$pass','$first','$last','$email','$type')";
        $result=mysqli_query($con,$qry) or die("ded");

        mysqli_close($con);
            
}

function goback(){
    Header("Location: ../index.php");
}

?>