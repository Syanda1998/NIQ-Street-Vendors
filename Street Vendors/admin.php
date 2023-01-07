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
        body{ font-family: arial; min-width: 10px;}
        .input {
            display: block;
            border: 2px solid #ccc;
            width: 100%;
            padding: 10px;
            /* margin-left: 10px; */
            /* margin-right: 10px; */
            height: 44px;
            border-radius: 5px;
        }

        label {
            font-size: 16px;
            margin-left: 10px;
        }

        .btn1 {
            float: right;
            background: #555;
            padding: 10px 15px;
            color: #fff;
            border-radius: 5px;
            margin-right: 10px;
            /* width: 20%; */
            margin-top: 10px;
            margin-bottom: 10px;
            border: none;
        }

        .btn2 {
            float: right;
            background: #555;
            color: #fff;
            border-radius: 5px;
            width: 100%;
            border: none;
            height: 35px;
        }

        .btn {
            float: right;
            background: #555;
            padding: 10px 15px;
            color: #fff;
            border-radius: 5px;
            margin-right: 10px;
            /* width: 20%; */
            margin-top: 10px;
            margin-bottom: 10px;
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
 $c_email = $_SESSION['c_email'];
 if(empty($currentUser)) $currentUser = "Default User";
 $data = true;

if(isset($_POST['btn_submit'])){

function validate($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
	
$name = validate($_POST['name']);							
$email = validate($_POST['email']);
$password = validate($_POST['password']);
$cpassword = validate($_POST['cpassword']);
$role = validate($_POST['role']);

//IF IT EMPTY, DISPLAY ERROR MESSAGE
 $sql1 = "SELECT * FROM users WHERE email='$email'";
 $result1 = $conn-> query($sql1);
 if ($result1-> num_rows > 0){	
    $data = false;
    $msg = "User Already Exist!!!.";
 }else{
    if (empty($name) || empty($email) || empty($password) || empty($cpassword) || empty($role)){
        $data = false;
        $msg = "All Fields Are Required !!! Please Try Again.";
    }else if($password != $cpassword){
        $data = false;
        $msg = "Passwords Does Not Match !!! Please Try Again.";
    }else if(strlen($cpassword) < 6){
        $data = false;
        $msg = "Passwords Must Have A Minimum Of 6 Characters !!! Please Try Again.";
    }else{
        $otp = rand();
        $_SESSION['staff_name'] = $name;
        $_SESSION['staff_email'] = $email;
        $_SESSION['staff_password'] = $password;
        $_SESSION['staff_role'] = $role;
        $_SESSION['staff_otp'] = $otp;
        $_SESSION['location'] = "<script>location.href = 'add_staff_otp.php?'</script>";

        $_SESSION['email_subject'] = "OTP Activation Code";
        $_SESSION['email_email'] = $email;
        $_SESSION['email_body'] = "Your OTP activation code is - $otp<br><br>Regards<br>NIQ Investment Team";

        echo"<script>location.href = 'send_email.php?'</script>";
    }
    }
 }

 if(isset($_POST['btn_update'])){
    $_SESSION['member_id'] = $_POST['btn_update'];
    echo"<script>location.href = 'update-role.php?'</script>";
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

            <div class="container-fluid px-4">
            <div class="row my-5">
            <?php
            include "conn.php";
                    $sql = "SELECT * FROM users WHERE email!='$c_email'";
                    $result = $conn-> query($sql);
                    echo "<h4 style='text-align:center; margin-bottom:20px;'>Existing Staff Members</h4>";
                    if ($result-> num_rows > 0){	
                        echo "<table class='table bg-white rounded shadow-sm  table-hover' style='width: 100%;'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th scope='col' width='50'>No</th>";
                        echo "<th scope='col'>Full Name</th>";
                        // echo "<th scope='col'>Email Address</th>";
                        echo "<th scope='col'>Role</th>";
                        echo "<th scope='col'>Update Role</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        $count = 0;
                        while($row = $result-> fetch_assoc()){
                            $name = $row['names'];
                            $email = $row['email'];
                            $role = $row['role'];
                            $count = $count + 1;

                            echo "<tr>";  echo "<th scope='row'>$count</th>";  
                            echo "<td><b>$name</b></td>"; 
                            // echo "<th scope='row'>$email</th>";
                            echo "<th scope='row'>$role</th>";
                            echo "<td><button type='submit' class='btn2' value='$email' name='btn_update'>Update</button></td>";
                            echo "</tr>";   
                            }
                            echo "</tbody>";   echo "<table>";    echo "</div>";
                        } else{
                            echo "<div class='content' style='border: 1px solid; border-radius: 10px;'>";
                            echo "<p class='error' style='margin-top: 10px' >No Records Found!!!</p>";
                            echo "</div>";
                        }
                        ?>
                <h3 class="fs-4 mb-3">Add Staff Member</h3>
                <div class="content" style="border: 1px solid; width: 98%; border-radius: 10px; margin-top: 5px;">
                <!-- --------------------------------DISPLAY ERROR AND SUCCESS MESSAGE-------------------------------- -->
                <?php if ($data == false) { ?>
                    <p class="error"><?php echo $msg ?></p>
                <?php } ?>

                <label style="margin-top: 10px;"><b>Full Name</b></label>
                <input type="text" class="input" name="name" placeholder="Full Name"></input>
                <label style="margin-top: 10px;"><b>Email Address</b></label>
                <input type="email" class="input" name="email" placeholder="Email Address"></input>
                <label style="margin-top: 10px;"><b>Password</b></label>
                <input type="password" class="input" name="password" placeholder="Password"></input>
                <label style="margin-top: 10px;"><b>Confirm Password</b></label>
                <input type="password" class="input" name="cpassword" placeholder="Confirm Password"></input>
                <label style="margin-top: 10px;"><b>Role</b></label>
                <select name='role' class='input'>
                <option value='staff'>Staff</option>   <option value="admin">Admin</option>
                </select>
                <label></label>
                <button type="submit" class="btn" name="btn_submit">Submit</button>
                <a type="submit" class="btn" href="street-vender.php">Back</a>
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