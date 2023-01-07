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
// $delete = false;
//  session_start(); 
 include "conn.php";
 $currentUser = $_SESSION['currentUser'];
 $id_number = $_SESSION['pay_id_no'];
//  $loan_id = $_SESSION['loan_id'];
 if(empty($currentUser)) $currentUser = "Default User";

 $loan_date = $_SESSION['loan_date'];
 $id_no = $_SESSION['id_no'];

$sql3 = "SELECT * FROM loan_dates WHERE id_number='$id_no' AND loan_date='$loan_date'";
$result3 = $conn-> query($sql3);
if ($result3-> num_rows > 0){	
    if($row3= $result3-> fetch_assoc()){
        $lend_amount = $row3['lend_amount'];
        $contract_type = $row3['contract_type'];
        $loan_amount = $row3['loan_amount'];
    }
}

$collected = 0;
$sql4 = "SELECT * FROM client_collections WHERE id_number='$id_no' AND loan_date='$loan_date'";
$result4 = $conn-> query($sql4);
if ($result4-> num_rows > 0){	
    while($row4= $result4-> fetch_assoc()){
        $collected = $collected + $row4['amount'];
    }
}

//  $paid = 0;
$rem = $lend_amount - $collected;
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
                    <?php
                    
                    $sql = "SELECT * FROM client_personal_details";
                    if(isset($_POST['btn_collect'])){
                        $loan_date = $_POST['btn_collect'];
                        $_SESSION['id_no'] = $id_no;
                        $_SESSION['loan_date'] = $loan_date;
                        echo"<script>location.href = 'client-pay-loan.php?'</script>";
                    }


                    if(isset($_POST['btn_delete'])){
                        $date = $_POST['btn_delete'];
                        $sql = "DELETE FROM client_collections WHERE id_number='$id_no' AND date='$date'";
                        $_SESSION['where'] = $date;
                        $_SESSION['sql'] = $sql;
                        $_SESSION['return'] = "<script>location.href = 'clients-collections.php?'</script>";
                        echo"<script>location.href = 'delete.php?'</script>";                        
                    }

                    if(isset($_POST['btn_back'])){
                        echo"<script>location.href = 'clients-loans.php?'</script>";
                    }

                    if(isset($_POST['btn_search'])){
                        $id_number = $_POST['search_id'];
                        if(empty($id_number)){
                            $sql = "SELECT * FROM client_personal_details";
                        }else{
                            $sql = "SELECT * FROM client_personal_details WHERE id_no='$id_number'";
                        }
                    }

                    //FINDING CURRENT DATE AND TIME
                    $c_date = date("Y/m/d");
                    $c_time = date("h:i:sa");

                    include "conn.php";
                    
                    $sql1 = "SELECT * FROM client_collections WHERE id_number='$id_no' AND loan_date='$loan_date'";
                    // $status = "Not Active";
                    $result1 = $conn-> query($sql1);
                    $interest = $lend_amount - $loan_amount;
                    $pec = ($interest/$lend_amount) * 100;
                    echo "<h4 style='text-align:center; margin-bottom:20px;'>Collections</h4>";
                    $msg = "Total Lend Amount\t\t\t\t\t\t\t\t\t\t: R$lend_amount\nTotal Collected Amount\t\t\t\t\t\t\t\t\t: R$collected
Remaining Amount\t\t\t\t\t\t\t\t\t\t: R$rem\nInterest\t\t\t\t\t\t\t\t\t\t\t\t: R$interest ($pec% of R$loan_amount)";
                    echo "<div class='content' style='border: 1px solid; border-radius: 10px;'>";
                    echo "<textarea type='text' style='width:88.5%; display:inline; margin-left:5px; margin-top:5px;' placeholder='$msg' rows='4' disabled></textarea>";
                    if($rem==0){
                        echo "<td><button type='submit' class='btn' value='$loan_date' style='width:10%; background-color:red; height:95px; margin-top:-95px; margin-left:5px; display:inline;
                    '>Paid Off</button></td>";
                    }else{
                        echo "<td><button type='submit' class='btn' value='$loan_date' style='width:10%; background-color:green; height:95px; margin-top:-95px; margin-left:5px; display:inline;
                        ' name='btn_collect'>Collect</button></td>";
                    }
                    echo "</div>";
                    echo "<hr>";

                    echo "<h4 style='text-align:center; margin-bottom:20px;'>Collected Transactions</h4>";
                    if ($result1-> num_rows > 0){	
                        while($row1 = $result1-> fetch_assoc()){	
                            $cdate = $row1['date'];
                            $amount = $row1['amount'];
                       
                            $msg = "Collected Amount: R$amount\nCollected Date: $cdate";

                            echo "<div class='content' style='border: 1px solid; border-radius: 10px;'>";
                            echo "<textarea type='text' style='width:78.5%; display:inline; margin-left:5px; margin-top:5px;' placeholder='$msg' rows='2' disabled></textarea>";
                            // echo "<td><button type='submit' class='btn' value='$id_number' style='width:10%; height:55px; margin-top:-45px; margin-left:5px; display:inline;
                            // ' name='btn_edit'>Edit</button></td>";
                            echo "<td><button type='submit' class='btn' value='$cdate' style='width:20%; height:55px; background-color:red; margin-top:-45px; margin-left:5px; 
                            display:inline;' name='btn_delete'>Delete</button></td>";
                            // $sql = "DELETE FROM street_vendor_collections WHERE date='$cdate'";
                            // echo "<td><a onClick=\"javascript: return confirm('Please confirm deletion');\" href='delete.php?id=".$_SESSION['$sql']."'>x</a></td><tr>"; //use double quotes for js inside php!
                            echo "</div>";
                            }
                        } else{
                            echo "<div class='content' style='border: 1px solid; border-radius: 10px;'>";
                            echo "<p class='error' style='margin-top: 10px' >No Records Found!!!</p>";
                            echo "</div>";
                        }
                    ?>
                    <!-- <button type="submit" style="margin-top: 10px;" name="btn_back" class="btn1">Back</button> -->
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

        function myFunction() {
            let text;
            if (confirm("Press a button!") == true) {
                return true;
            } else {
                return false;
            }
            // document.getElementById("demo").innerHTML = text;
        }
    </script>

    </form>
</body>
<script type="text/javascript">
    $(".remove").click(function(){
        var id = $(this).parents("tr").attr("id");
        if(confirm('Are you sure to remove this record ?'))
        {
            $sql1 = "SELECT * FROM street_vendor_collections WHERE loan_id='$loan_id'";
            $.ajax({
               url: '/delete.php',
               type: 'GET',
               data: {id: <?php "SELECT * FROM street_vendor_collections WHERE loan_id='$loan_id'" ?>},
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                    $("#"+id).remove();
                    alert("Record removed successfully");  
               }
            });
        }
    });


</script>

</html>