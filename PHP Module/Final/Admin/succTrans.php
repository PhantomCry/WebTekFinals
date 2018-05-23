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
        <div id="reservation">
        <div class="box">
            <h1>RESERVATIONS</h1>
            <table>
                <tr>
                    <th>Reservation ID</th>
                    <th>Reservation Date</th>
                    <th>Checkout Date</th>
                    <th>Rate Per Night</th>
                    <th>Status</th>
                    <th>Client ID</th>
                    <th>Provider ID</th>
                    <th>Trans ID</th>
                </tr>
                <?php
                    $qry="select * from reservation natural join units;";
                    $result=mysqli_query($con,$qry);
                    while($row = mysqli_fetch_array($result)){
                        echo'<tr>
                        <td>'.$row['res_id'].'</td>
                        <td>'.$row['res_date'].'</td>
                        <td>'.$row['checkout_date'].'</td>
                        <td>'.$row['price_per_night'].'</td>
                        <td>'.$row['res_status'].'</td>
                        <td>'.$row['client_id'].'</td>
                        <td>'.$row['prov_id'].'</td>
                        <td>'.$row['trans_id'].'</td>
                        </tr>';
                    }
                ?>
            </table>
            
        </div>
        </div>
        <div id="transaction">
        <div class="box">
            <h1>SUCCESSFULL TRANSACTIONS</h1>
            <div id="query">
            <form action="" method="post">
               From:
                <input type="number" max="2018" min="1980" placeholder="YYYY" name="FromYear" required>
                <input type="number" max="12" min="1" placeholder="MM" name="FromMonth" required>
                <input type="number" max="31" min="1" placeholder="DD" name="FromDay" required>
                To:
                <input type="number" max="2018" min="1980" placeholder="YYYY" name="ToYear" required>
                <input type="number" max="12" min="1" placeholder="MM" name="ToMonth" required>
                <input type="number" max="31" min="1" placeholder="DD" name="ToDay" required>
                <button type="submit" class="btn-1">Filter</button>
            </form>
              
                
                <form action="" method="post">
                Search By Provider:
                <input type="number" placeholder="Provider ID" name="ForProv" required>
                <button type="submit" class="btn-1">Filter</button>
                </form> 
                        
                        <form action="" method="post" id="formff">
                <button type="submit" class="btn-1">Reset</button>
                </form>   
                         
            </div>
            <table>
                <tr>
                    <th>Transaction ID</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Reservation ID</th>
                    <th>Provider ID</th>
                    <th>10% Share</th>
                </tr>
                <?php
                    if(isset($_POST['ForProv'])){
                        $Total =0;
                        $TotalAm =0;
                        $ID = $_POST['ForProv'];
                        
                        $qry='SELECT * from succ_trans where prov_id = "'.$ID.'" ;';
                        $result=mysqli_query($con,$qry);
                        while($row = mysqli_fetch_array($result)){
                            echo'<tr>
                            <td>'.$row['transaction_id'].'</td>
                            <td>'.$row['trans_date'].'</td>
                            <td>'.$row['amount'].'</td>
                            <td>'.$row['res_id'].'</td>
                            <td>'.$row['prov_id'].'</td>
                            <td>'.$row['share'].'</td>
                            </tr>';
                            $TotalAm += $row['amount'];
                            $Total += $row['share'];
                        }
                        
                        echo'<tr>
                            <td></td>
                            <td>Total</td>
                            <td>'.$TotalAm.'</td>
                            <td></td>
                            <td>Total</td>
                            <td>'.$Total.'</td>
                            </tr>';
                        
                    }
                    else if(isset($_POST['FromYear'])){
                        $Total =0;
                        $TotalAm =0;
                        $FYear = $_POST['FromYear'];
                        $FMonth = $_POST['FromMonth'];
                        $FDay = $_POST['FromDay'];
                        $TYear = $_POST['ToYear'];
                        $TMonth = $_POST['ToMonth'];
                        $TDay = $_POST['ToDay'];
                        
                        $qry='SELECT * from succ_trans where trans_date >= "'.$FYear.'-'.$FMonth.'-'.$FDay.'" && trans_date <= "'.$TYear.'-'.$TMonth.'-'.$TDay.'";';
                        $result=mysqli_query($con,$qry);
                        while($row = mysqli_fetch_array($result)){
                            echo'<tr>
                            <td>'.$row['transaction_id'].'</td>
                            <td>'.$row['trans_date'].'</td>
                            <td>'.$row['amount'].'</td>
                            <td>'.$row['res_id'].'</td>
                            <td>'.$row['prov_id'].'</td>
                            <td>'.$row['share'].'</td>
                            </tr>';
                            $TotalAm += $row['amount'];
                            $Total += $row['share'];
                        }
                        
                        echo'<tr>
                            <td></td>
                            <td>Total</td>
                            <td>'.$TotalAm.'</td>
                            <td></td>
                            <td>Total</td>
                            <td>'.$Total.'</td>
                            </tr>';
                        
                    } else {
                        $Total =0;
                        $TotalAm =0;
                      $qry="SELECT * from succ_trans;";
                        $result=mysqli_query($con,$qry);
                        while($row = mysqli_fetch_array($result)){
                            echo'<tr>
                            <td>'.$row['transaction_id'].'</td>
                            <td>'.$row['trans_date'].'</td>
                            <td>'.$row['amount'].'</td>
                            <td>'.$row['res_id'].'</td>
                            <td>'.$row['prov_id'].'</td>
                            <td>'.$row['share'].'</td>
                            </tr>';
                            $TotalAm += $row['amount'];
                            $Total += $row['share'];
                        }
                        echo'<tr>
                            <td></td>
                            <th>Total</th>
                            <td>'.$TotalAm.'</td>
                            <td></td>
                            <th>Total</th>
                            <td>'.$Total.'</td>
                            </tr>';
                    }
                    
                ?>
            </table>
            
        </div>
        </div>
        
        
        
        <script type=text/javascript src="jquery-3.3.1.min.js"></script>
        <script type=text/javascript src="my_script.js"></script>
    </body>
</html>