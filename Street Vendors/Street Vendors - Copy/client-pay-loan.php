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
        body{ font-family: arial; min-width: 1300px;}
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
//  session_start(); 
 include "conn.php";
 $currentUser = $_SESSION['currentUser'];
//  $contract_no = $_SESSION['contract_no']; 
//  $pay_id_no = $_SESSION['pay_id_no'];
//  $loan_id = $_SESSION['loan_id'];
$id_no = $_SESSION['id_no'];
$loan_date = $_SESSION['loan_date'];

 $c_date = date("Y/m/d");
 $c_time = date("h:i:sa");

 $dates = $c_date." - ".$c_time ;
 if(empty($currentUser)) $currentUser = "Default User";

 $sql3 = "SELECT * FROM loan_dates WHERE id_number='$id_no' AND loan_date='$loan_date'";
 $result3 = $conn-> query($sql3);
 if ($result3-> num_rows > 0){	
     if($row3= $result3-> fetch_assoc()){
         $loan_date = $row3['loan_date'];
         $due_date = $row3['ldate'];
         $lend_amount = $row3['lend_amount'];
     }
 }

$name = 0;
$sql3 = "SELECT * FROM client_personal_details WHERE id_no='$id_no'";
$result3 = $conn-> query($sql3);
if ($result3-> num_rows > 0){	
    while($row3= $result3-> fetch_assoc()){
        $name = $row3['title']." ".$row3['fname']." ".$row3['lname'];
        $mphone = $row3['mphone'];
        $address = $row3['address'];
    }
}

$collected = 0;
$sql4 = "SELECT * FROM client_collections WHERE loan_date='$loan_date'";
$result4 = $conn-> query($sql4);
if ($result4-> num_rows > 0){	
    while($row4= $result4-> fetch_assoc()){
        $collected = $collected + $row4['amount'];
    }
}

//  $paid = 0;
 $rem = $lend_amount - $collected;

$text = "Full Name\t\t\t\t\t\t\t\t\t: $name (Debtor)\nPhone Number\t\t\t\t\t\t\t\t: $mphone\nTotal Lend\t\t\t\t\t\t\t\t\t: R$lend_amount
Collected Amount\t\t\t\t\t\t\t\t: R$collected\nRemaining Amount\t\t\t\t\t\t\t\t: R$rem\nDuration\t\t\t\t\t\t\t\t\t\t: $loan_date ---> $due_date - 11:59:59pm";

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
        header("Location: client-pay-loan.php?error=Please Insert The Amount!!!"); exit();
    }else{

    if($rem >= $pay_amt){
        if($rem == $pay_amt){
            $status = "Paid off";
            $sql5 = "UPDATE loan_dates SET status='$status' WHERE loan_date='$loan_date'";
            if ($conn->query($sql5) === TRUE){
                $sql2 = "INSERT INTO client_collections(id_number, loan_date, amount, date)
                VALUES('$id_no', '$loan_date', '$pay_amt', '$dates')";
                $result2 = mysqli_query($conn, $sql2);
                if($result2){
                    $_SESSION['msg1'] = "Thank You!";
                    $_SESSION['msg2'] = "Payment has been made successfully.";
                    $_SESSION['msg3'] = "<script>location.href = 'clients-collections.php?'</script>";
                    echo"<script>location.href = 'thankyou.php?'</script>";
                }
            }
        }else{
            $sql2 = "INSERT INTO client_collections(id_number, loan_date, amount, date)
                VALUES('$id_no', '$loan_date', '$pay_amt', '$dates')";
                $result2 = mysqli_query($conn, $sql2);
                if($result2){
                    $_SESSION['msg1'] = "Thank You!";
                    $_SESSION['msg2'] = "Payment has been made successfully.";
                    $_SESSION['msg3'] = "<script>location.href = 'clients-collections.php?'</script>";
                    echo"<script>location.href = 'thankyou.php?'</script>";
                }
        }
    }else{
        header("Location: client-pay-loan.php?error=Amount Must Not Be Greater Than The Remaining Amount (R$rem) !!! Please Try Again."); exit();  
    }
    }
}
?>

<body>
<form action="#" method="post" enctype="multipart/form-data" autocomplete="off">
<div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
            <img src="img/mylogo.png" style="width:200px; height:200px;"></div>
            <div class="list-group list-group-flush my-3">
                <!-- ------------------------------------------------------------------------------------------ -->
                <a style="margin-top: -25px;" href="dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text"><i
                    ></i>Dashboard</a>
                <a style="margin-top: -25px;" href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"><i
                    ></i>Existing Clients</a>
                <a style="margin-top: -25px;" href="new-customer.php" class="list-group-item list-group-item-action bg-transparent second-text"><i
                    ></i>New Customers</a>
                <a style="margin-top: -25px;" href="client_statements.php" class="list-group-item list-group-item-action bg-transparent second-text"><i
                    ></i>Client Statements</a>
                    <a style="margin-top: -25px;" href="street-vender.php" class="list-group-item list-group-item-action bg-transparent second-text"><i
                    ></i>Street Vendor</a>
                    <?php $role = $_SESSION['role']; 
                if($role=="Admin"){
                    echo "<a style='margin-top: -25px;' href='admin.php' class='list-group-item list-group-item-action bg-transparent second-text'><i
                    ></i>Administration</a>";
                }?>
                <!-- ------------------------------------------------------------------------------------------ -->
                <a href="login.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
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
                            <i class="fas fa-user me-2"></i><b><?php echo $currentUser  ?></b>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid px-4">
            <div class="row my-5">
                <h3 class="fs-4 mb-3">Pay Loan</h3>
                <div class="content" style="border: 1px solid; width: 98%; margin-left: 10px; border-radius: 10px; margin-top: 5px;">
                <!-- --------------------------------DISPLAY ERROR AND SUCCESS MESSAGE-------------------------------- -->

                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <?php if (isset($_GET['success'])) { ?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>
                <textarea type="text" rows="6" placeholder="<?php echo $text ?>" disabled style="width: 100%; margin-top: 10px;"></textarea>
                <label style="margin-top: 10px;"><b>Amount</b></label>
                <input type="decimal" class="input" name="amount" placeholder="Amount" required></input>
                <label></label>                
                <button type="submit" class="btn1" name="btn_submit">Collect</button>
                <a type="submit" class="btn" href="clients-collections.php">Back</a>
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