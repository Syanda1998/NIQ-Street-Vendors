<?php
 session_start();
 ?>
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styles.css" />
    <title>NIQ Investments</title>
    <style type="text/css">
		.error {
			font-size: 15px;
			color: red;
		}
	</style>
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
            /*width: 20%;*/
            margin-top: 10px;
            margin-bottom: 10px;
            border: none;
        }

        .btn:hover{
            background-color: darkcyan;
            /* background-color: teal; */
            color: white;
        }

        .success {
            background: #D4EDDA;
            color: #40754C;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            margin-top: 10px;
        }

        .error1 {
        background: #F2DEDE;
        color: #A94442;
        padding: 10px;
        width: 95%;
        border-radius: 5px;
        margin: 20px auto;
        }
    </style>
</head>
<?php
 include "conn.php";
 $currentUser = $_SESSION['currentUser'];
 if(empty($currentUser)) $currentUser = "Default User";
 $c_date = date("Y/m/d");
 $c_time = date("h:i:sa");
 $date = $c_date." - ".$c_time;
 $userid1 = $_SESSION['btn_grant_loan'];

 $titleErr = $fnameErr = $lnameErr= $mphoneErr= $addressErr = $amount = $amountErr = $due_date = $due_dateErr = NULL;
 $title = $fname = $lname = $mphone = $address = $agreeErr = $agree = $interest = $interestErr = NULL;
 $flag = true;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // --------------------------------------------------------------------------------------------------
		if (empty($_POST["agree"])) { $agreeErr = "You need to agree to the POPIA Tick box before we continue processing your personal information"; $flag = false; }
        else { $agree = validate($_POST["agree"]); }
        // --------------------------------------------------------------------------------------------------
        if (empty($_POST["interest"])) { $interestErr = "Interest is required"; $flag = false; }
        else { $interest = validate($_POST["interest"]); }
        // --------------------------------------------------------------------------------------------------
        if (empty($_POST["amount"])) { $amountErr = "Loan amount is required"; $flag = false; }
        else{
            $len = validate($_POST["amount"]);
            if ($len < 300 || $len > 60000) { $amountErr = "Loan Amount Must Be Between R300 - R60000 !!! Please Try Again"; $flag = false; }
            else{ $amount = validate($_POST["amount"]); }
        }
         // --------------------------------------------------------------------------------------------------
         if (empty($_POST["due_date"])) { $due_dateErr = "Due date is required"; $flag = false; }
         else { $due_date = validate($_POST["due_date"]); }

        if($flag){
            $sql = "SELECT * FROM street_vendors WHERE userid='$userid1'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {	
                $interest = $amount * ($interest/100);
                $total = $amount + $interest;
                // $userid = $mphone."-".$date;
                $sql2 = "INSERT INTO street_vendor_loans(userid, amount, interest, total, date, due_date, status)
                    VALUES('$userid1', '$amount', '$interest', '$total', '$date', '$due_date', 'Active')";
                    $result5 = mysqli_query($conn, $sql2);
                    if($result5){
                        $_SESSION['msg1'] = "Thank You!";
                        $_SESSION['msg2'] = "Loan has been granted successfully.";
                        $_SESSION['msg3'] = "<script>location.href = 'street-vender.php?'</script>";
                        echo"<script>location.href = 'thankyou.php?'</script>";
                    }
            }
        }
	}
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<body>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
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
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?php echo $currentUser  ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="login.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="card pt-2 mx-auto" style="width: 90%; margin-top: 60px; margin-bottom: 150px;">
			<div class="card-header" style="font-size: 25px; font-style: italic;">
				<header>Grant Loan</header>
			</div>
			<div class="card-body">
                <!-- ---------------------------------------------------------------------------- -->
                <!-- <h5 style="margin-bottom: -10px; text-align: center;">Personal Details</h5> -->
                <?php if (isset($_GET['error'])) { ?>    <p class="error1"><?php echo $_GET['error']; ?></p>    <?php } ?>
                <hr>
                <!-- ---------------------------------------------------------------------------- -->
				<div class="card-text mb-2">
				Loan Amount<h5 style="color: red; display: inline;">*</h5>
                <input type="number" name="amount" class="form-control" required  placeholder="E.g 1000" value="<?= $amount; ?>">
				<span class="error"> <?= $amountErr; ?></span></div>
                <!-- ---------------------------------------------------------------------------- -->
				<div class="card-text mb-2">
				Interest<h5 style="color: red; display: inline;">*</h5>
                <input type="number" name="interest" class="form-control" required  placeholder="E.g 30" value="<?= $interest; ?>">
				<span class="error"> <?= $interestErr; ?></span></div>
                <!-- ---------------------------------------------------------------------------- -->
				<div class="card-text mb-2">
				<b>Due Date</b><h5 style="color: red; display: inline;">*</h5>
                <input type="date" name="due_date" class="form-control" min="<?php echo date('Y-m-d'); ?>" value="<?= $due_date; ?>">
                <span class="error"> <?= $due_dateErr; ?></span></div>
                <!-- ---------------------------------------------------------------------------- -->
    <div>
        <label for="agree"> <input type="checkbox" name="agree" value="yes" id="agree" /> Do you give NIQ Investments the permission to proceed 
        with processing your information for the purpose of your loan application and other related activities?</label>
        <span class="error"> <?= $agreeErr; ?></span></div>
            
			</div>
			<div class="card-footer mb-2 btn-lg">
				<input class="button btn btn-primary" type="submit" name="button">
                <a class="btn" name="button" href="street-vender.php" >Back</a>
			</div>
		</div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
    </div>
    </form>
</body>

</html>