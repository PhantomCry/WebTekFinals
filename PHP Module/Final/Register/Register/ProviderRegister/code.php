<?php
    include_once('db.php');

    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        $compname = $_POST['companyname'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $num = $_POST['num'];
        $email = $_POST['email'];
        
        
        if($username == null || $compname == null || $pass == null || $fname == null || $lname == null || $email == null || $num == null){
            echo 'Please fill in the form';
        } else {
            $qry = "INSERT INTO provider (prov_username, prov_pswd, business_name, rep_fname, rep_lname, rep_phoneno, rep_email) VALUES ('$username', '$pass', '$compname', '$fname',  '$lname', '$num', '$email')";
        
        if(mysqli_query($con, $qry)){
            echo 'Your registrations has been forwarded to the Admin for evaluation. We will send an email if your account has been approved or not';
        } else {
            echo 'Something went wrong please try again';
        }    
        }
        
        
    }
?>