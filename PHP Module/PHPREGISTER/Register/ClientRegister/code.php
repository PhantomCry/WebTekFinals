<?php
    include_once('db.php');

    if(isset($_POST['username'])){
        $name = $_POST['username'];
        $pass = $_POST['pass'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $num = $_POST['num'];
        
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['name'];
        
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        
        $allowed = array('jpg', 'jpeg', 'png');
        
        if(in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if ($fileSize < 10000000){
                    $fileNameNew = uniqid('', true).'.'.$fileActualExt;
                    echo $fileNameNew;
                    
                    $fileDestination = 'upload/'.$fileNameNew;
                    
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("Location: index.php?uploadsuccess");
                    
                    if(mysqli_query($con,"INSERT INTO CLIENT (client_username, client_pswd, client_pic, client_fname, client_lname, client_email, client_phoneno) VALUES('$name','$pass','$fileNameNew','$fname','$lname','$email','$num')")){
                        echo "Account has been sent to the user to be approved";
                    } else{
                        echo "Something went wrong, register again";
                    }
                    
                } else {
                    echo "Your Profile Picture is too big";
                }
            } else {
                echo "No!";
            }
        } else {
            echo "You cannot upload pictures with that extension";
        }
        
        if(mysqli_query($con,"INSERT INTO USER (name, pass) VALUES('$name','$pass')")){
            echo "Account has been sent to the user to be approved";
        } else{
            echo "Something went wrong, register again";
        }
        
    }
?>