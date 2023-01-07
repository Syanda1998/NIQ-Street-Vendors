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
    <link rel="stylesheet" href="styles.css" />
    <title>NIQ Investments</title>
    <style>
        body{ font-family: arial; min-width: 800px;}
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

        label {
            font-size: 16px;
            margin-left: 10px;
        }

        .btn {
            float: right;
            background: #555;
            padding: 10px 15px;
            color: #fff;
            border-radius: 5px;
            margin-right: 10px;
            width: 20%;
            margin-top: 10px;
            margin-bottom: 10px;
            border: none;
        }

        .btn1 {
            float: right;
            background: #555;
            padding: 10px 15px;
            color: #fff;
            border-radius: 5px;
            margin-right: 10px;
            width: 20%;
            margin-top: 10px;
            margin-bottom: 10px;
            border: none;
        }
        .btn1:hover{
            opacity: .7;
        }

        .error {
        background: #F2DEDE;
        color: #A94442;
        padding: 10px;
        width: 100%;
        border-radius: 5px;
        margin-top: 10px;
        }

        .success {
        background: #D4EDDA;
        color: #40754C;
        padding: 10px;
        width: 100%;
        border-radius: 5px;
        margin-top: 10px;
        }
    </style>
</head>
<?php
 include "conn.php";
 $currentUser = $_SESSION['currentUser'];
//  $contract_no = $_SESSION['contract_no']; 
 $pay_id_no = $_SESSION['pay_id_no'];
 $loan_id = $_SESSION['loan_id'];
 $c_date = date("Y/m/d");
 $c_time = date("h:i:sa");
 $data = true;

 $dates = $c_date." - ".$c_time ;
 if(empty($currentUser)) $currentUser = "Default User";

//  $sql3 = "SELECT * FROM loan_dates WHERE id_number='$pay_id_no' AND contract_number='$contract_no'";
//  $result3 = $conn-> query($sql3);
//  if ($result3-> num_rows > 0){	
//      if($row3= $result3-> fetch_assoc()){
//          $loan_date = $row3['loan_date'];
//          $ldate = $row3['ldate'];
//          $lend_amount = $row3['lend_amount'];
//      }
//  }

$sql3 = "SELECT * FROM street_vendor_loans WHERE date='$loan_id'";
$result3 = $conn-> query($sql3);
if ($result3-> num_rows > 0){	
    if($row3= $result3-> fetch_assoc()){
        $due_date = $row3['due_date'];
        $userid = $row3['userid'];
        $lend_amount = $row3['total'];
    }
}
$name = 0;
$sql3 = "SELECT * FROM street_vendors WHERE userid='$userid'";
$result3 = $conn-> query($sql3);
if ($result3-> num_rows > 0){	
    while($row3= $result3-> fetch_assoc()){
        $name = $row3['title']." ".$row3['fname']." ".$row3['lname'];
        $mphone = $row3['mphone'];
        $address = $row3['address'];
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

 $text = "Full Name\t\t\t\t\t\t\t\t\t: $name (Debtor)\nPhone Number\t\t\t\t\t\t\t\t: $mphone\nTotal Lend\t\t\t\t\t\t\t\t\t: R$lend_amount
Collected Amount\t\t\t\t\t\t\t\t: R$collected\nRemaining Amount\t\t\t\t\t\t\t\t: R$rem\nDuration\t\t\t\t\t\t\t\t\t\t: $loan_id ---> $due_date - 11:59:59pm";

 function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

 if(isset($_POST['btn_submit']))
 {
    $pay_amt = validate($_POST['amount']);
    if(empty($pay_amt) || $pay_amt < 0){
        $data = false;
        $msg = "Amount Is Required!!!";
    }else{

    if($rem >= $pay_amt){
        if($rem == $pay_amt){
            $status = "Paid off";
            $sql5 = "UPDATE street_vendor_loans SET status='$status' WHERE date='$loan_id'";
            if ($conn->query($sql5) === TRUE){
                $sql2 = "INSERT INTO street_vendor_collections(loan_id, amount, date)
                VALUES('$loan_id', '$pay_amt', '$dates')";
                $result2 = mysqli_query($conn, $sql2);
                if($result2){
                    $_SESSION['msg1'] = "Thank You!";
                    $_SESSION['msg2'] = "Payment has been made successfully.";
                    $_SESSION['msg3'] = "<script>location.href = 'collections.php?'</script>";
                    echo"<script>location.href = 'thankyou.php?'</script>";
                }
            }
        }else{
            $sql2 = "INSERT INTO street_vendor_collections(loan_id, amount, date)
            VALUES('$loan_id', '$pay_amt', '$dates')";
            $result2 = mysqli_query($conn, $sql2);
            if($result2){
                $_SESSION['msg1'] = "Thank You!";
                $_SESSION['msg2'] = "Payment has been made successfully.";
                $_SESSION['msg3'] = "<script>location.href = 'collections.php?'</script>";
                echo"<script>location.href = 'thankyou.php?'</script>";
            }
        }
    }else{
        $data = false;
        $msg = "Amount Must Not Be Greater Than The Remaining Amount (R$rem) !!! Please Try Again.";
    }
    }
}
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
                <h3 class="fs-4 mb-3">Pay Loan</h3>
                <div class="content" style="border: 1px solid; width: 98%; margin-left: 10px; margin-bottom: 10%; border-radius: 10px; margin-top: 5px;">
                <!-- --------------------------------DISPLAY ERROR AND SUCCESS MESSAGE-------------------------------- -->

                <?php if ($data == false) { ?>
                    <p class="error"><?php echo $msg ?></p>
                <?php } ?>
                <textarea type="text" rows="6" placeholder="<?php echo $text ?>" disabled style="width: 100%; margin-top: 10px;"></textarea>
                <label style="margin-top: 10px;"><b>Amount</b></label>
                <input type="text" class="input" name="amount" placeholder="Amount" required></input>
                <label></label>                
                <button type="submit" class="btn1" name="btn_submit">Collect</button>
                <a type="submit" class="btn" href="collections.php">Back</a>
                </div>
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