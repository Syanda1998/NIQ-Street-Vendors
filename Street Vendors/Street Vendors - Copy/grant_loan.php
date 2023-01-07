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
        /* .input{
            height: 40px; 
            width: 100%; 
            display: inline;
            margin-top: 10px;
            border: none; 
            border-radius: 10px;
        }
        .btn{
            height: 40px; 
            width: 100%; 
            display: inline;
            margin-top: 10px;
            margin-bottom: 10px;
            border: none; 
            border-radius: 10px;
            background-color: white;
        } */

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

        .btn:hover{
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
 $client_id = $_SESSION['application_id'];
 if(empty($currentUser)) $currentUser = "Default User";

 $sql1 = "SELECT * FROM clients WHERE id_number='$client_id'";
 $result1 = $conn-> query($sql1);
 if ($result1-> num_rows > 0){	
     while($row1= $result1-> fetch_assoc()){
         $name = $row1['names'];
     }
 }

if(isset($_POST['btn_submit'])){
$dates = date("Y/m/d");

function validate($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
	
$interest_rate = validate($_POST['interest_rate']);							
$amount = validate($_POST['amount']);
$period = validate($_POST['period']);
$statuss = "Active";

//IF IT EMPTY, DISPLAY ERROR MESSAGE
if (empty($amount) || empty($interest_rate) || empty($period)){
	header("Location: grant_loan.php?error=Something Went Wrong !!! Please Try Again."); exit();  
}else if($interest_rate > 100){
    header("Location: grant_loan.php?error=Interest Rate Must Be Between 0% - 100% !!! Please Try Again."); exit(); 
}else{
		$sql2 = "INSERT INTO investments(id_number, amount, periods, interest, dates, statuss)
		VALUES('$client_id', '$amount', '$period', '$interest_rate', '$dates', '$statuss')";
		$result2 = mysqli_query($conn, $sql2);

		if ($result1 && $result2) { 
			$_SESSION['msg1'] = "Thank You!";
			$_SESSION['msg2'] = "Loan has been granted.";
			$_SESSION['msg3'] = "<script>location.href = 'existing-clients-records.php?'</script>";
			echo"<script>location.href = 'thankyou.php?'</script>";
		}
		else { header("Location:  grant_loan.php?error=Something Went Wrong !!! Please Try Again"); exit(); }
}
}
?>

<body>
<form action="#" method="post" enctype="multipart/form-data" autocomplete="off">
<div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
            <img src="img/logo.png" style="width:50px; height:50px;"></i><br>NIQ investments</div>
            <div class="list-group list-group-flush my-3">
                <!-- ------------------------------------------------------------------------------------------ -->
                <a style="margin-top: -25px;" href="dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text"><i
                    ></i>Dashboard</a>
                <a style="margin-top: -25px;" href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"><i
                    ></i>Existing Clients</a>
                <a style="margin-top: -25px;" href="new-customer.php" class="list-group-item list-group-item-action bg-transparent second-text"><i
                    ></i>New Customers</a>
                <a style="margin-top: -25px;" href="#" class="list-group-item list-group-item-action bg-transparent second-text"><i
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
                <h3 class="fs-4 mb-3">Grant Loan To <?php echo $name ?></h3>
                <div class="content" style="border: 1px solid; width: 98%; margin-left: 10px; border-radius: 10px; margin-top: 5px;">
                <!-- --------------------------------DISPLAY ERROR AND SUCCESS MESSAGE-------------------------------- -->
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <?php if (isset($_GET['success'])) { ?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>

                <label style="margin-top: 10px;"><b>Amount</b></label>
                <input type="number" class="input" name="amount" placeholder="Amount" required></input>
                <label style="margin-top: 10px;"><b>Interest Rate</b></label>
                <input type="number" class="input" name="interest_rate" placeholder="Interest Rate" required></input>
                <label style="margin-top: 10px;"><b>Period</b></label>
                <select name='period' class='input'>
                    <option value="1 Month">1 Month</option>  <option value='2 Months"'>2 Months</option>  <option value='3 Months'>3 Months</option>      
                    <option value='4 Months'>4 Months</option>   <option value='5 Months'>5 Months</option>  <option value='6 Months'>6 Months</option>
                </select>
                <label></label>
                <button type="submit" class="btn" name="btn_submit">Submit</button>
                <a type="submit" class="btn" href="existing-clients-records.php">Back</a>
                
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