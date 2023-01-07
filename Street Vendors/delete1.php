<?php
 session_start();
 ?>
 <HTML>
    <style>
        body{ font-family: arial; min-width: 10px;}
        .btn{
            height: 65px; 
            width: 90%; 
            display: inline;
            margin-bottom: 10px;
            border: none; 
            border-radius: 10px;
            font-weight: bold;
            font-size: 50px;
            background-color: forestgreen;
        }
    </style>
    <?php
        // session_start(); 
        include "conn.php";
        $return = $_SESSION['return'];
        $sql = $_SESSION['sql'];
        $sql1 = $_SESSION['sql1'];

        if(isset($_POST['btn_yes'])){
            if ($conn->query($sql) === TRUE){
                if($conn->query($sql1) === TRUE) {
                $_SESSION['msg1'] = "Thank You!";
                $_SESSION['msg2'] = "Record deleted successfully.";
                $_SESSION['msg3'] = $return;
                echo"<script>location.href = 'thankyou.php?'</script>";  
                }
            }
        }

        if(isset($_POST['btn_no'])){
            echo"$return";
        }
    ?>
    
<body>
<form action="#" method="post" enctype="multipart/form-data" autocomplete="off">
    <p style="text-align: center; margin-top: 100px;"><img src="img/delete.png" style="width:430px; height:430px;"></div></p>
    <div style="text-align: center;">
        <h2 style="text-align: center; font-size: 100px;"><?php echo "Are you sure you want to delete this record?" ?></h2>
        <p>
        </p>
        <button type='submit' name='btn_yes' class='btn'>YES</button>
        <button type='submit' name='btn_no' class='btn'>NO</button>
    </div>
</form>
</body>
</HTML>