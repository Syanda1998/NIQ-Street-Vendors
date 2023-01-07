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

        .btn1 {
            float: right;
            background: #555;
            padding: 10px 15px;
            color: #fff;
            border-radius: 5px;
            margin-left: 80%;
            width: 20%;
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
//  session_start(); 
 include "conn.php";
 $currentUser = $_SESSION['currentUser'];
 if(empty($currentUser)) $currentUser = "Default User";
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
                <a style="margin-top: -25px;" href="existing-clients.php" class="list-group-item list-group-item-action bg-transparent second-text"><i
                    ></i>Existing Clients</a>
                <a style="margin-top: -25px;" href="new-customer.php" class="list-group-item list-group-item-action bg-transparent second-text"><i
                    ></i>New Customers</a>
                <a style="margin-top: -25px;" href="client_statements.php" class="list-group-item list-group-item-action bg-transparent second-text"><i
                    ></i>Client Statements</a>
                <a style="margin-top: -25px;" href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"><i
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
                    <?php
                    
                    $sql = "SELECT * FROM loan_dates WHERE status='Active'";
                    if(isset($_POST['btn_collect'])){
                        $pay_id_no = $_POST['btn_collect'];
                        $sql3 = "SELECT * FROM loan_dates WHERE id_number='$pay_id_no'";
                        $result3 = $conn-> query($sql3);
                        if ($result3-> num_rows > 0){	
                            if($row3= $result3-> fetch_assoc()){
                                $contract_no = $row3['contract_number'];
                            }
                        }
                        $_SESSION['contract_no'] = $contract_no;
                        $pay_id_number = $_POST['btn_collect'];	
                        $_SESSION['pay_id_no'] = $pay_id_number;
                        // $_SESSION['new_client_name'] = $title." ".$fname." ".$lname;
                        // $_SESSION['new_client_cell'] = $mphone;
                        echo"<script>location.href = 'collections.php?'</script>";
                    }

                    
                    if(isset($_POST['btn_add'])){
                        // $id_no = $_POST['btn_settle'];
                        // $_SESSION['id_number'] = $id_no;
                        echo"<script>location.href = 'new-street-vender.php?'</script>";
                    }

                    if(isset($_POST['btn_back'])){
                        echo"<script>location.href = 'dashboard.php?'</script>";
                    }

                    if(isset($_POST['btn_search'])){
                        $id_number = $_POST['search_id'];
                        if(empty($id_number)){
                            $sql = "SELECT * FROM loan_dates WHERE status='Active'";
                        }else{
                            $sql = "SELECT * FROM loan_dates WHERE status='Active' AND id_no='$id_number'";
                        }
                    }

                    //FINDING CURRENT DATE AND TIME
                    $c_date = date("Y/m/d");
                    $c_time = date("h:i:sa");

                    include "conn.php";
                    
                    $result = $conn-> query($sql);
                    echo "<h4 style='text-align:center; margin-bottom:20px;'>Street Vendor</h4>";
                    echo "<input type='number' class='input' name='search_id' placeholder='Search By ID Number' style='margin-bottom:10px; width:76%; display:inline;'>";
                    echo "<td><button type='submit' style='width: 10%; height:45px; margin-top:0px; margin-bottom:-6px; float:left;' class='btn' 
                    value='1' name='btn_search'>Search</button></td>";
                    echo "<td><button type='submit' style='width: 10%; height:45px; margin-top:0px; margin-bottom:-6px; float:left; margin-left:10px;' class='btn' 
                    value='1' name='btn_add'>Add</button></td>";

                    if ($result-> num_rows > 0){	
                        $count = 0;
                        while($row = $result-> fetch_assoc()){
                            $status = $row['status'];
                            $loan_date = $row['loan_date'];
                            $ldate = $row['ldate'];
                            $loan = $row['loan'];
                            $id_no = $row['id_number'];
                            $lend_amount = $row['lend_amount'];


                            $sql1 = "SELECT * FROM client_personal_details WHERE id_no='$id_no'";
                            $status = "Not Active";
                            $result1 = $conn-> query($sql1);
                            if ($result1-> num_rows > 0){	
                                while($row1 = $result1-> fetch_assoc()){	
                                    $title = $row1['title'];
                                    $fname = $row1['fname'];
                                    $lname = $row1['lname'];
                                    $name = $title." ".$fname." ".$lname;
                                    $id_number = $row1['id_no'];
                                }
                            }

                            $msg = "Name: $name (Debtor)\nLend: R$lend_amount\nSince: $loan_date\nDue Date: $ldate";

                            echo "<div class='content' style='border: 1px solid; border-radius: 10px;'>";
                            echo "<td><button type='submit' class='btn' value='$id_no' style='width:10%; height:100px; margin-top:-95px; display:inline;'>Picture</button></td>";
                            echo "<textarea type='text' style='width:78.5%; display:inline; margin-left:5px; margin-top:5px;' placeholder='$msg' rows='4' disabled></textarea>";
                            echo "<td><button type='submit' class='btn' value='$id_no' style='width:10%; height:100px; margin-top:-95px; margin-left:5px; 
                            display:inline;' name='btn_collect'>Collect</button></td>";
                            echo "</div>"; 
                            }
                        } else{
                            echo "<div class='content' style='border: 1px solid; border-radius: 10px;'>";
                            echo "<p class='error' style='margin-top: 10px' >No Records Found!!!</p>";
                            echo "</div>";
                        }
                    ?>
                    <button type="submit" style="margin-top: 10px;" name="btn_back" class="btn1">Back</button>
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