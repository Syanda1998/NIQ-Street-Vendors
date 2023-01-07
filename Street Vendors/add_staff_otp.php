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
        /* margin: 20px auto; */
        margin-top: 0px;
        }

        .success {
        background: #D4EDDA;
        color: #40754C;
        padding: 10px;
        width: 100%;
        border-radius: 5px;
        /* margin: 20px auto; */
        margin-top: 0px;
        }
    </style>
</head>
<?php
//  session_start(); 
 include "conn.php";
 $currentUser = $_SESSION['currentUser'];
 $c_email = $_SESSION['c_email'];
 if(empty($currentUser)) $currentUser = "Default User";

 if(isset($_POST['btn_submit'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        
    $otp = validate($_POST['otp']);
    $name = $_SESSION['staff_name'];
    $email = $_SESSION['staff_email'];
    $password = $_SESSION['staff_password'];
    $role = $_SESSION['staff_role'];
    $myotp = $_SESSION['staff_otp'];							
    
    //IF IT EMPTY, DISPLAY ERROR MESSAGE
    //  $sql1 = "SELECT * FROM login_details WHERE email='$email'";
    //  $result1 = $conn-> query($sql1);
    //  if ($result1-> num_rows > 0){	
    //     header("Location: admin.php?error=User Already Exist!!!."); exit();  
    //  }else{
    // if (empty($name) || empty($email) || empty($password) || empty($cpassword) || empty($role)){
    //         header("Location: add_staff.php?error=All Fields Are Required !!! Please Try Again."); exit();  
    //     }else 
        if($otp != $myotp){
            header("Location: add_staff_otp.php?error=Incorrect OTP !!! Please Try Again."); exit(); 
        }else{
            $status = "Active";
            $sql2 = "INSERT INTO users(names, email, passwords, role)
            VALUES('$name', '$email', '$password', '$role')";
            $result2 = mysqli_query($conn, $sql2);
    
            if ($result2) { 
                $_SESSION['email_subject'] = "Account Registered Successfully";
                $_SESSION['email_email'] = $email;
                $_SESSION['email_body'] = "Dear $name<br><br>Your account has been registered and activated successfully.<br><br>
                Login details:-<br>Username: $email<br>Password: $password";
                $_SESSION['location'] = "<script>location.href = 'thankyou.php?'</script>";

                $_SESSION['msg1'] = "Thank You!";
                $_SESSION['msg2'] = "Account has been registered successfully.";
                $_SESSION['msg3'] = "<script>location.href = 'admin.php?'</script>";
                echo"<script>location.href = 'send_email.php?'</script>";
            }
            else { header("Location:  admin.php?error=Something Went Wrong !!! Please Try Again"); exit(); }
        // }
        }
     }
    
     if(isset($_POST['btn_update'])){
        $_SESSION['update_id'] = $_POST['btn_update'];
        echo"<script>location.href = 'update_role.php?'</script>";
    }
    
?>

<body>
<form action="#" method="post" enctype="multipart/form-data" autocomplete="off">
<div class="d-flex" id="wrapper">

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

                <h3 class="fs-4 mb-3">Confirm Email</h3>
                <div class="content" style="border: 1px solid; width: 100%; border-radius: 10px; margin-top: 5px; margin-bottom:100%;"><br>
                <!-- --------------------------------DISPLAY ERROR AND SUCCESS MESSAGE-------------------------------- -->
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <?php if (isset($_GET['success'])) { ?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>

                <label style="margin-top: 10px;"><b>Enter OTP</b></label>
                <input type="number" class="input" name="otp" placeholder="OTP"></input>
                <label></label>
                <button type="submit" class="btn" name="btn_submit">Submit</button>
                <a type="submit" class="btn" href="admin.php">Back</a>
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