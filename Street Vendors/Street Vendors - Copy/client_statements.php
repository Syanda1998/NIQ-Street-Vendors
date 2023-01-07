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
                <a style="margin-top: -25px;" href="existing-clients.php" class="list-group-item list-group-item-action bg-transparent second-text "><i
                    ></i>Existing Clients</a>
                <a style="margin-top: -25px;" href="new-customer.php" class="list-group-item list-group-item-action bg-transparent second-text"><i
                    ></i>New Customers</a>
                <a style="margin-top: -25px;" href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"><i
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
                    <?php
                    $sql = "SELECT * FROM loan_dates";
                    if(isset($_POST['btn_view'])){
                        $loan_date = $_POST['btn_view'];	
                        // $_SESSION['client_id_number'] = $id_number;
                        $_SESSION['loan_date'] = $loan_date;
                        // $_SESSION['new_client_name'] = $title." ".$fname." ".$lname;
                        // $_SESSION['new_client_cell'] = $mphone;
                        echo"<script>location.href = 'client_statements1.php?'</script>";
                    }

                    if(isset($_POST['btn_back'])){
                        echo"<script>location.href = 'dashboard.php?'</script>";
                    }

                    $sql = "SELECT * FROM loan_dates";
                    if(isset($_POST['btn_search'])){
                        $id_number = $_POST['search_id'];
                        if(empty($id_number)){
                            $sql = "SELECT * FROM loan_dates";
                        }else{
                            $sql = "SELECT * FROM loan_dates WHERE id_number='$id_number'";
                        }
                    }

                    //FINDING CURRENT DATE AND TIME
                    $c_date = date("Y/m/d");
                    $c_time = date("h:i:sa");

                    include "conn.php";
                    
                    
                    echo "<h4 style='text-align:center; margin-bottom:20px;'>Client Statements</h4>";
                    echo "<input type='number' class='input' name='search_id' placeholder='Search By ID Number' style='margin-bottom:10px; width:76%; display:inline;'>";
                    echo "<td><button type='submit' style='width: 20%; height:45px; margin-top:0px; margin-bottom:-6px; float:left;' class='btn' 
                    value='1' name='btn_search'>Search</button></td>";

                    // $sql = "SELECT * FROM loan_dates WHERE id_number='$id_number'";
                    $result = $conn-> query($sql);
                    if ($result-> num_rows > 0){	
                        echo "<table class='table bg-white rounded shadow-sm  table-hover'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th scope='col' width='50'>No</th>";
                        echo "<th scope='col'>Full Name</th>";
                        echo "<th scope='col'>ID Number</th>";
                        echo "<th scope='col'>Contract Type</th>";
                        echo "<th scope='col'>Loan Date</th>";
                        echo "<th scope='col'>Last Paydate</th>";
                        echo "<th scope='col'>Amount</th>";
                        echo "<th scope='col'>Installment</th>";
                        echo "<th scope='col'>Documents</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        $count = 0;
                        while($row = $result-> fetch_assoc()){
                            // $name = $row['title']." ".$row['fname']." ".$row['lname'];
                            $contract_type = $row['contract_type'];
                            $ldate = $row['ldate'];
                            $date = $row['loan_date'];
                            $loan_amount = $row['loan_amount'];
                            $id_number = $row['id_number'];
                            $installment = $row['installment'];
                            $count = $count + 1;

                            $sql1 = "SELECT * FROM client_personal_details WHERE id_no='$id_number'";
                            $result1 = $conn-> query($sql1);
                            if ($result1-> num_rows > 0){	
                                while($row1 = $result1-> fetch_assoc()){
                                    $name = $row1['title']." ".$row1['fname']." ".$row1['lname'];
                                }
                            }

                            echo "<tr>";  echo "<th scope='row'>$count</th>";
                            echo "<th scope='row'>$name</th>";
                            echo "<th scope='row'>$id_number</th>";
                            echo "<th scope='row'>$contract_type</th>";
                            echo "<th scope='row'>$date</th>";
                            echo "<th scope='row'>$ldate</th>";
                            echo "<th scope='row'>R $loan_amount</th>";
                            echo "<th scope='row'>R $installment</th>";
                            echo "<td><button type='submit' class='btn' value='$date' style='background-color:green;' name='btn_view'>View</button></td>";
                            echo "</tr>";   
                            }
                            echo "</tbody>";   echo "<table>";    echo "</div>";
                        } else{
                            echo "<div class='content' style='border: 1px solid; border-radius: 10px;'>";
                            echo "<p class='error' style='margin-top: 10px' >No Records Found!!! Click 'Search' To Reload</p>";
                            echo "</div>";
                        }
                    ?>
                    <button type="submit" name="btn_back" class="btn1">Back</button>
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