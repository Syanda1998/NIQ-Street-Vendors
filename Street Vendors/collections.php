<?php
 session_start();
 ?>
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="styles.css" />
    <title>NIQ Investments</title>
    <style>
        body{ font-family: arial; min-width: 10px;}
        .input {
            display: block;
            border: 2px solid #ccc;
            width: 98%;
            padding: 10px;
            margin-left: 10px;
            margin-right: 10px;
            height: 44px;
            border-radius: 5px;
        }

        .btn1 {
            float: right;
            background: #555;
            padding: 10px 15px;
            color: #fff;
            border-radius: 5px;
            /* margin-left: 80%; */
            /* width: 20%; */
            margin-bottom: 10px;
            border: none;
        }

        .btn {
            background: #555;
            color: #fff;
            border-radius: 5px;
            width: 100%;
            border: none;
        }

        .btn:hover, .btn1:hover{
            opacity: .7;
        }
        .error {
        background: #F2DEDE;
        color: #A94442;
        padding: 10px;
        width: 100%;
        border-radius: 5px;
        margin-top: 0px;
        }

        .success {
        background: #D4EDDA;
        color: #40754C;
        padding: 10px;
        width: 100%;
        border-radius: 5px;
        margin-top: 0px;
        }
    </style>
    
</head>
<?php
 include "conn.php";
 $currentUser = $_SESSION['currentUser'];
 $loan_id = $_SESSION['loan_id'];
 if(empty($currentUser)) $currentUser = "Default User";

$sql3 = "SELECT * FROM street_vendor_loans WHERE date='$loan_id'";
$result3 = $conn-> query($sql3);
if ($result3-> num_rows > 0){	
    if($row3= $result3-> fetch_assoc()){
        $amount1 = $row3['amount'];
        $interest1 = $row3['interest'];
        $lend_amount = $row3['total'];
    }
}

$collected = 0;
$sql4 = "SELECT * FROM street_vendor_collections WHERE loan_id='$loan_id'";
$result4 = $conn-> query($sql4);
if ($result4-> num_rows > 0){	
    while($row4= $result4-> fetch_assoc()){
        $collected = $collected + $row4['amount'];
    }
}

$rem = $lend_amount - $collected;
?>

<body>
<form action="#" method="post" enctype="multipart/form-data" autocomplete="off">
<div class="d-flex" id="wrapper">
        
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <!-- <i class="fas fa-user me-2"></i><b><?php echo $currentUser  ?></b> -->
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?php echo $currentUser  ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!-- <li><a class="dropdown-item" href="admin.php">Users</a></li> -->
                                <li><a class="dropdown-item" href="login.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid px-4">

                <div class="row my-5">
                    <?php
                    
                    $sql = "SELECT * FROM client_personal_details";
                    if(isset($_POST['btn_collect'])){
                        $pay_id_number = $_POST['btn_collect'];	
                        $_SESSION['pay_id_no'] = $pay_id_number;
                        echo"<script>location.href = 'pay-loan.php?'</script>";
                    }


                    if(isset($_POST['btn_delete'])){
                        $date = $_POST['btn_delete'];
                        $sql = "DELETE FROM street_vendor_collections WHERE date='$date'";
                        $_SESSION['where'] = $date;
                        $_SESSION['sql'] = $sql;
                        $_SESSION['return'] = "<script>location.href = 'collections.php?'</script>";
                        echo"<script>location.href = 'delete.php?'</script>";                        
                    }

                    if(isset($_POST['btn_back'])){
                        echo"<script>location.href = 'street-vender.php?'</script>";
                    }

                    //FINDING CURRENT DATE AND TIME
                    $c_date = date("Y/m/d");
                    $c_time = date("h:i:sa");

                    include "conn.php";
                    
                    $sql1 = "SELECT * FROM street_vendor_collections WHERE loan_id='$loan_id'";
                    $result1 = $conn-> query($sql1);
                    $pec = ($interest1/$amount1) * 100;
                    echo "<h4 style='text-align:center; margin-bottom:20px;'>Collections</h4>";
                    $msg = "Total Lend Amount\t: R$lend_amount\nTotal Collected Amount\t: R$collected
Remaining Amount\t: R$rem\nInterest\t: R$interest1 ($pec% of R$amount1)";
                    echo "<div class='content' style='border: 1px solid; border-radius: 10px;'>";
                    echo "<textarea type='text' style='width:100%; display:inline; margin-top:5px;' placeholder='$msg' rows='5' disabled></textarea>";
                    echo "<td><button type='submit' class='btn' value='$loan_id' style='width:100%; background-color:green; height:35px; margin-bottom:10px; display:inline;
                    ' name='btn_collect'>Collect</button></td>";
                    echo "</div>";
                    echo "<hr>";

                    echo "<h4 style='text-align:center; margin-bottom:20px;'>Collected Transactions</h4>";
                    if ($result1-> num_rows > 0){	
                        while($row1 = $result1-> fetch_assoc()){	
                            $cdate = $row1['date'];
                            $amount = $row1['amount'];
                       
                            $msg = "Collected Amount: R$amount\nCollected Date: $cdate";

                            echo "<div class='content' style='border: 1px solid; margin-top:10px; border-radius: 10px;'>";
                            echo "<textarea type='text' style='width:100%; display:inline; margin-top:5px;' placeholder='$msg' rows='3' disabled></textarea>";
                            echo "<td><button type='submit' class='btn' value='$cdate' style='width:100%; height:35px; background-color:red; margin-bottom:10px; 
                            display:inline;' name='btn_delete'>Delete</button></td>";
                            echo "</div>";
                            }
                        } else{
                            echo "<div class='content' style='border: 1px solid; border-radius: 10px;'>";
                            echo "<p class='error' style='margin-top: 10px' >No Records Found!!!</p>";
                            echo "</div>";
                        }
                    ?>
                     <button type="submit" style="margin-top: 10px;" name="btn_back" class="btn1" style="margin-bottom:300px;">Back</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
    </form>
</body>
</html>