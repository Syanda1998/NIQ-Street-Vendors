<?php
 session_start(); 
 $role = $_SESSION['role']; 
 $currentUser = $_SESSION['currentUser'];
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
    <style type="text/css">
*{
 margin: 0px;
 padding: 0px;
}
body{ font-family: arial; min-width: 1300px;}
.main{ margin: 2%; }

.card{
     width: 17%;
     display: inline-block;
     box-shadow: 2px 2px 20px black;
     border-radius: 5px; 
     margin: 1%;
     align-items: center;
     /* height: 250px; */
    }

.image img{
  width: 100%;
  height: 170px;
  border-top-right-radius: 5px;
  border-top-left-radius: 5px;
 }

.title{
  text-align: center;
  padding: 10px;
 }

h1{  font-size: 20px; }

.des{
  padding: 3px;
  text-align: center;
  padding-top: 10px;
        border-bottom-right-radius: 5px;
  border-bottom-left-radius: 5px;
}
button{
  margin-top: 10px;
  margin-bottom: 10px;
  background-color: white;
  border: 1px solid black;
  border-radius: 5px;
  padding:10px;
  width: 100%;
  /* height: 100px; */
}
button:hover{
  background-color: black;
  color: white;
  transition: .5s;
  cursor: pointer;
}

    </style>
</head>
<?php
 include "conn.php";
 
 
 if(empty($currentUser)) $currentUser = "Default User";

 if(isset($_POST['btn_clients'])){
    echo"<script>location.href = 'existing-clients.php?'</script>";
}

if(isset($_POST['btn_customers'])){
    echo"<script>location.href = 'new-customer.php?'</script>";
}

if(isset($_POST['btn_statements'])){
    echo"<script>location.href = 'client_statements.php'</script>";
}

if(isset($_POST['btn_admin'])){
    echo"<script>location.href = 'admin.php?'</script>";
}

if(isset($_POST['btn_street_vendor'])){
    echo"<script>location.href = 'street-vender.php?'</script>";
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
                <a style="margin-top: -25px;" href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"><i
                    ></i>Dashboard</a>
                <a style="margin-top: -25px;" href="existing-clients.php" class="list-group-item list-group-item-action bg-transparent second-text"><i
                    ></i>Existing Clients</a>
                <a style="margin-top: -25px;" href="new-customer.php" class="list-group-item list-group-item-action bg-transparent second-text"><i
                    ></i>New Customers</a>
                <a style="margin-top: -25px;" href="client_statements.php" class="list-group-item list-group-item-action bg-transparent second-text"><i
                    ></i>Client Statements</a>
                    <a style="margin-top: -25px;" href="street-vender.php" class="list-group-item list-group-item-action bg-transparent second-text"><i
                    ></i>Street Vendor</a>
                <?php 
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

            <div class="main">

            <!--cards -->
            <!-- <div class="card">
            <div class="image"> <img src="img/street.png"> </div>
            <div class="title"> <h1>Street Vendor</h1> </div>
            <div class="des"> <button name="btn_street_vendor">Click Here</button> </div>
            </div> -->

            <!--cards -->
            <?php 
                if($role=="Admin"){
                    echo "<div class='card' style='width:17%;'>";
                    echo "<div class='image'> <img src='img/clients.jpg'> </div>";
                    echo "<div class='title'> <h1>Existing Clients</h1> </div>";
                    echo "<div class='des'> <button name='btn_clients'>Click Here</button> </div>";
                    echo "</div>";

                    echo "<div class='card' style='width:17%;'>";
                    echo "<div class='image'> <img src='img/customer.jpg'> </div>";
                    echo "<div class='title'> <h1>New Customers</h1> </div>";
                    echo "<div class='des'> <button name='btn_customers'>Click Here</button> </div>";
                    echo "</div>";

                    echo "<div class='card' style='width:17%;'>";
                    echo "<div class='image'> <img src='img/statement.png'> </div>";
                    echo "<div class='title'> <h1>Client Statements</h1> </div>";
                    echo "<div class='des'> <button name='btn_statements'>Click Here</button> </div>";
                    echo "</div>";

                    echo "<div class='card' style='width:17%;'>";
                    echo "<div class='image'> <img src='img/street.png'> </div>";
                    echo "<div class='title'> <h1>Street Vendor</h1> </div>";
                    echo "<div class='des'> <button name='btn_street_vendor'>Click Here</button> </div>";
                    echo "</div>";

                    echo "<div class='card' style='width:17%;'>";
                    echo "<div class='image'> <img src='img/admin.jpg'> </div>";
                    echo "<div class='title'> <h1>Administrator</h1> </div>";
                    echo "<div class='des'> <button name='btn_admin'>Click Here</button> </div>";
                    echo "</div>";
                }else{
                    echo "<div class='card' style='width:22%;'>";
                    echo "<div class='image'> <img src='img/clients.jpg'> </div>";
                    echo "<div class='title'> <h1>Existing Clients</h1> </div>";
                    echo "<div class='des'> <button name='btn_clients'>Click Here</button> </div>";
                    echo "</div>";

                    echo "<div class='card' style='width:22%;'>";
                    echo "<div class='image'> <img src='img/customer.jpg'> </div>";
                    echo "<div class='title'> <h1>New Customers</h1> </div>";
                    echo "<div class='des'> <button name='btn_customers'>Click Here</button> </div>";
                    echo "</div>";

                    echo "<div class='card' style='width:22%;'>";
                    echo "<div class='image'> <img src='img/statement.png'> </div>";
                    echo "<div class='title'> <h1>Client Statements</h1> </div>";
                    echo "<div class='des'> <button name='btn_statements'>Click Here</button> </div>";
                    echo "</div>";

                    echo "<div class='card' style='width:22%;'>";
                    echo "<div class='image'> <img src='img/street.png'> </div>";
                    echo "<div class='title'> <h1>Street Vendor</h1> </div>";
                    echo "<div class='des'> <button name='btn_street_vendor'>Click Here</button> </div>";
                    echo "</div>";
                }
                    ?>
            
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