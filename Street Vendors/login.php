<?php
 session_start();
 ?>
 <!--Design by foolishdeveloper.com-->
<!DOCTYPE html>
<html lang="en">
<head>
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<title>NIQ Investments</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
 <style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
*{
  margin:0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body{ font-family: arial; min-width: 10px;}
.error {
  background: #F2DEDE;
  color: #A94442;
  padding: 10px;
  width: 95%;
  border-radius: 5px;
  margin: 20px auto;
  }

  .success {
  background: #D4EDDA;
  color: #40754C;
  padding: 10px;
  width: 95%;
  border-radius: 5px;
  margin: 20px auto;
  }

 html{
  /* background: url("img/register-background.jpg"); */
  background-color: darkcyan;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  height: 600px;
 }

body{
  display: grid;
  place-items: center;
  text-align: center;
  background-size: cover; 
}

.content{
  /* width: 700px; */
 
  border-radius: 10px;
  padding: 40px 30px;
  margin-top: 100px;
  box-shadow: -3px -3px 9px #aaa9a9a2,
              3px 3px 7px rgba(147, 149, 151, 0.671);
 
}

.content .text{
  font-size: 25px;
  font-weight: 600;
  margin-bottom: 35px;
  color: rgb(247, 233, 233);
}

.content .field{
  height: 50px;
  width: 100%;
  display: flex;
  position: relative;
}

.field input{
  height: 100%;
  width: 100%;
  padding-left: 45px;
  font-size: 18px;
  outline: none;
  border: none;
  color: #e0d2d2;
  border: 1px solid rgba(255, 255, 255, 0.438);
  border-radius: 8px;
  background: rgba(105, 105, 105, 0);
}

.field input::placeholder{
  color: #e0d2d2a6;
}

.field:nth-child(2){
  margin-top: 20px;
}

.field span{
  position: absolute;
  width: 50px;
  line-height: 50px;
  color: #ffffff;
}

button{
  margin: 25px 0 0 0;
  width: 100%;
  height: 50px;
  color: rgb(238, 226, 226);
  font-size: 18px;
  font-weight: 600;
  border: 2px solid rgba(255, 255, 255, 0.438);
  border-radius: 8px;
  background: rgba(105, 105, 105, 0);
 margin-top: 40px;
  outline: none;
  cursor: pointer;
  border-radius: 8px;
}
 
.content .or{
  color: rgba(255, 255, 255, 0.733);
  margin-top: 9px;
}
 
.icon-button{
  margin-top: 15px;
}

.icon-button span{
  padding-left: 17px;
  padding-right: 17px;
  padding-top: 6px;
  padding-bottom: 6px;
   color: rgba(244, 247, 250, 0.795);
 border-radius: 5px;
  line-height: 30px;
  background: rgba(255, 255, 255, 0.164);
    backdrop-filter: blur(10px);
}

.icon-button span.facebook{
  margin-right: 17px;
}

button:hover,
.icon-button span:hover{
  background-color: #babecc8c;
}
</style>
</head>
<?php
// session_start(); 
include "conn.php";
$login = true;

//FINDING CURRENT DATE AND TIME
$date_time = date("Y/m/d")."-".date("h:i:sa");

//METHOD TO VALIDATE DATA
function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_POST['btn_reset'])) {
  echo"<script>location.href = 'reset_password.php?'</script>"; 
}

if(isset($_POST['btn_login'])) {
$email = validate($_POST['email']);
$password = validate($_POST['password']);
    
	//IF IT EMPTY, DISPLAY ERROR MESSAGE
    if (empty($email) || empty($password)){
// 		header("Location:  login.php?error="); exit();
		$login = false;
        $msg = "All Fields Are Required!!!";
	} else{
	    $sql = "SELECT * FROM users WHERE email='$email' AND passwords='$password'";
        $result = $conn-> query($sql);
        if ($result-> num_rows > 0){	
            while($row = $result-> fetch_assoc()){	
                $role = $row['role'];	
                $name = $row['names'];
                $status = "Active";
                if($role=="admin") $role = "Admin";
            }
            if($status == "Blocked"){
            //   header("Location: login.php?error="); exit();
              $login = false;
              $msg = "Your Account Has Been Blocked. Please Contact The Administrator.";
            }else{
              $_SESSION['currentUser'] = $name;
              $_SESSION['c_email'] = $email;
              $_SESSION['role'] = $role;
              echo"<script>location.href = 'street-vender.php?'</script>";
        }
     }else{
         $login = false;
         $msg = "Incorrect Username or Password";
     }
    }
  }
?>

<body>
  <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
  <div class="content">
  <div class="text">Login Form</div>
      <!-- --------------------------------DISPLAY ERROR AND SUCCESS MESSAGE-------------------------------- -->
      <?php if ($login == false) { ?>
          <p class="error"><?php echo $msg ?></p>
      <?php } ?>
   
      <div class="field"><span class="fa fa-user" style="margin-top: 10px;"></span>
        <input type="email" style="margin-top:10px;" name="email" placeholder="Username">
      </div></br>
      <div class="field"><span class="fa fa-lock"></span>
        <input type="password" style="margin-top:0px;" name="password" placeholder="Password">
      </div> <br><hr>
      <button type="submit" name="btn_login" style="margin-top:10px;">Log In</button>
      <button type="submit" name="btn_reset" style="margin-top:10px;">Reset Password</button>
    </form>
  </div>
</body>
</html>
