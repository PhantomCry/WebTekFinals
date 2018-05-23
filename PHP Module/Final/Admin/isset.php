<?php
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
 if(isset($_POST['UpdateUser'])){
            $cNo = $_POST['UpdateUser'];
            $update = $_POST['UserEdit'];
            if($update == "Delete"){
            $qry = 'DELETE FROM client where client_id = '.$cNo.' ';
                      
            mysqli_query($con, $qry);
                            
           header("Location adminMod.php?$cNo");

            }
                        
                        if($update == "Active"){
                            $qry = 'UPDATE client SET client_status = "'.$update.'" where client_id = "'.$cNo.'" ';
                            mysqli_query($con, $qry);
                            
                            header("Refresh:0");

                        }
                    }
if(isset($_POST['BanAUser'])){
                        $num = $_POST['BanAUser'];
                        
                        $qry = 'UPDATE client SET client_status ="Deactivated" where client_id = '.$num.' ';
                        
                        mysqli_query($con, $qry);
                        
                        header("Refresh:0");
                        
                    }

if(isset($_POST['UnBanAUser'])){
                        $num = $_POST['UnBanAUser'];
                        
                        $qry = 'UPDATE client SET client_status ="Active" where client_id = '.$num.' ';
                        
                        mysqli_query($con, $qry);
                        
                        header("Refresh:0");
                        
                    }

if(isset($_POST['newClientApprove'])){
                        $num = $_POST['newClientApprove'];
                        
                        $qry = 'UPDATE client SET client_status ="Active" where client_id = '.$num.' ';
                        
                        mysqli_query($con, $qry);
                        
                        header("Refresh:0");
                        
                    }

if(isset($_POST['newClientDecline'])){
                        $num = $_POST['newClientDecline'];
                        
                        $qry = 'UPDATE client SET client_status ="Deactivated" where client_id = '.$num.' ';
                        
                        mysqli_query($con, $qry);
                        
                        header("Refresh:0");
                        
                    }

if(isset($_POST['BanAProvider'])){
                        $num = $_POST['BanAProvider'];
                        
                        $qry = 'UPDATE provider SET rep_status = "Deactivated" where prov_id = '.$num.' ';
                        
                        mysqli_query($con, $qry);
                    }
if(isset($_POST['DeclineAProvider'])){
                        $num = $_POST['DeclineAProvider'];
                        
                        $qry = 'UPDATE provider SET rep_status = "Deactivated" where prov_id = '.$num.' ';
                        
                        mysqli_query($con, $qry);
                    }

if(isset($_POST['UnBanAProvider'])){
                        $num = $_POST['UnBanAProvider'];
                        
                        $qry = 'UPDATE provider SET rep_status = "Active" where prov_id = '.$num.' ';
                        
                        mysqli_query($con, $qry);
                    }

if(isset($_POST['AcceptAProvider'])){
                        $num = $_POST['AcceptAProvider'];
                        
                        $qry = 'UPDATE provider SET rep_status = "Active" where prov_id = '.$num.' ';
                        
                        mysqli_query($con, $qry);
                    }


if(isset($_POST['ProvEdit'])){
                        $cNo = $_POST['UpdateProvider'];
                        $update = $_POST['ProvEdit'];
                        if($update == "Delete"){
                          $qry = 'DELETE FROM provider where prov_id = '.$cNo.' ';
                        
                            mysqli_query($con, $qry);

                        }
                        
                        if($update == "Active"){
                            $qry = 'UPDATE provider SET rep_status = "'.$update.'" where prov_id = "'.$cNo.'" ';
                            mysqli_query($con, $qry);

                        }
}

if (isset($_POST['DeclineUnit'])) {
        $id = $_POST['DeclineUnit'];
   
        $sql = 'UPDATE units SET post_status="Declined" WHERE trans_id="'.$id.'"';
        mysqli_query($con, $sql); 
    

    
    }

if (isset($_POST['AcceptUnit'])) {
        $id = $_POST['AcceptUnit'];
   
        $sql = 'UPDATE units SET post_status="Approved" WHERE trans_id="'.$id.'"';
        mysqli_query($con, $sql); 
    

    
    }
if (isset($_POST['DeclineAUnit'])) {
        $id = $_POST['DeclineAUnit'];
   
        $sql = 'UPDATE units SET post_status="Declined" WHERE trans_id="'.$id.'"';
        mysqli_query($con, $sql); 
    

    
    }

if (isset($_POST['AcceptAUnit'])) {
        $id = $_POST['AcceptAUnit'];
   
        $sql = 'UPDATE units SET post_status="Approved" WHERE trans_id="'.$id.'"';
        mysqli_query($con, $sql); 
    

    
    }
?>