<?php
    include_once('db.php');

    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $num = $_POST['num'];
        
        if($username == null || $pass == null || $fname == null || $lname == null || $email == null || $num == null){
            echo 'Please fill in the form';
        } else {
            $qry = "INSERT INTO client (client_username, client_pswd, client_fname, client_lname, client_email, client_phoneno) VALUES ('$username', '$pass', '$fname',  '$lname', '$email', '$num')";
        
        if(mysqli_query($con, $qry)){
            echo 'Your registrations has been forwarded to the Admin for evaluation. We will send an email if your account has been approved or not';
        } else {
            echo 'Something went wrong please try again';
        }    
        }
        
        
    }
?>