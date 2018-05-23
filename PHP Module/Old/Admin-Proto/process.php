<?php
    if (isset($_POST['ID'])) {
        $id = $_POST['ID'];
    }
    if (isset($_POST['status'])) {
        $status = $_POST['status'];
    }

    echo $id;
    echo $status;
    $con=mysqli_connect("localhost","root","","transient");
    $sql = 'UPDATE trans_unit SET status="'.$status.'" WHERE trans_id="'.$id.'"';
    if(mysqli_query($con, $sql)){
        header("Location: index.php");
    }

?>


