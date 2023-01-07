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
        body{ font-family: arial; 
            min-width: 400px;
            /* min-height: min-content; */
            /* viewport-fit: 100%; */
        }
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
 if(empty($currentUser)) $currentUser = "Default User";
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
                                <li><a class="dropdown-item" href="admin.php">Users</a></li>
                                <li><a class="dropdown-item" href="login.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            

            <div class="container-fluid px-4">
            <!-- <img src="img/mylogo.png" style="width:200px; height:200px;"></div> -->
                <div class="row my-5">
                    <?php
                    
                    $sql = "SELECT * FROM street_vendors";
                    if(isset($_POST['btn_collect'])){
                        $loan_id = $_POST['btn_collect'];
                        $_SESSION['loan_id'] = $loan_id;
                        echo"<script>location.href = 'collections.php?'</script>";
                    }

                    
                    if(isset($_POST['btn_add'])){
                        echo"<script>location.href = 'new-street-vender.php?'</script>";
                    }

                    if(isset($_POST['btn_back'])){
                        echo"<script>location.href = 'dashboard.php?'</script>";
                    } 

                    if(isset($_POST['btn_grant_loan'])){
                        $userid1 = $_POST['btn_grant_loan'];
                        $_SESSION['btn_grant_loan'] = $userid1;
                        echo"<script>location.href = 'street-vender-loan.php?'</script>";
                    }

                    $id = "All";
                    if(isset($_POST['btn_search'])){
                        $id = $_POST['search_id'];
                    }

                    //FINDING CURRENT DATE AND TIME
                    $c_date = date("Y/m/d");
                    $c_time = date("h:i:sa");

                    include "conn.php";
                    
                    $result = $conn-> query($sql);
                    echo "<h4 style='text-align:center; margin-bottom:20px;'>Street Vendor</h4>";
                    echo "<select name='search_id' class='form-control' style='margin-bottom:10px; width:76%; display:inline;'>";
                    echo "<option value='All'>All</option>  <option value='Active'>Active</option>";
                    echo "<option value='Paid off'>Paid off</option>";
                    echo "</select>";

                    echo "<td><button type='submit' style='width: 10%; margin-left:10px; height:40px; margin-top:0px; margin-bottom:-6px; float:left;' class='btn' 
                    value='1' name='btn_search'>Search</button></td>";
                    echo "<td><button type='submit' style='width: 10%; height:40px; margin-top:0px; margin-bottom:-6px; float:left; margin-left:10px;' class='btn' 
                    value='1' name='btn_add'>Add</button></td>";

                    if ($result-> num_rows > 0){	
                        $count = 0;
                        while($row = $result-> fetch_assoc()){
                            $title = $row['title'];
                            $fname = $row['fname'];
                            $lname = $row['lname'];
                            $name = $title." ".$fname." ".$lname;
                            $userid = $row['userid'];

                            $active = 0;
                            if($id=="All"){
                                $sql1 = "SELECT * FROM street_vendor_loans WHERE userid='$userid'";
                            }else{
                                $sql1 = "SELECT * FROM street_vendor_loans WHERE userid='$userid' AND status='$id'";
                            }
                           
                            $result1 = $conn-> query($sql1);
                            if ($result1-> num_rows > 0){	
                                echo "<div class='content' style='border: 1px solid; border-radius: 10px; margin-top:10px;'>";
                                while($row1 = $result1-> fetch_assoc()){	
                                    $amount = $row1['amount'];
                                    $interest = $row1['interest'];
                                    $total = $row1['total'];
                                    $due_date = $row1['due_date'];
                                    $date = $row1['date'];
                                    $status = $row1['status'];
                                    $active++;

                                    $msg = "Name: $name (Debtor)\nLend: R$total\nSince: $date\nDue Date: $due_date";
                                    // echo "<img src='img/img.png' style='width:10%; margin-top:-95px; height:100px;'>";
                                    echo "<textarea type='text' style='width:100%; display:inline; margin-top:5px;' placeholder='$msg' rows='4' disabled></textarea>";
                                    if($status=="Paid off"){
                                        echo "<td><button type='submit' class='btn' value='$date' style='width:100%; background-color:lightblue; height:35px; margin-bottom:10px;
                                        display:inline;' disabled >Paid off</button></td>";
                                    }else{
                                        echo "<td><button type='submit' class='btn' value='$date' style='width:100%; background-color:green; height:35px; margin-bottom:10px; 
                                        display:inline;' name='btn_collect'>Collect</button></td>";
                                    }
                                    
                                    echo "<td><button type='submit' class='btn' value='$userid' style='width:100%;  background-color:red; height:35px; margin-bottom:10px;;
                                    display:inline;' name='btn_grant_loan'>Lend More</button></td>";
                                }
                                echo "</div>";
                            }

                            }
                        } else{
                            echo "<div class='content' style='border: 1px solid; border-radius: 10px;'>";
                            echo "<p class='error' style='margin-top: 10px' >No Records Found!!!</p>";
                            echo "</div>";
                        }
                    ?>
                    <!-- <button type="submit" style="margin-top: 10px;" name="btn_back" class="btn1">Back</button> -->
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