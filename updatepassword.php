<?php
session_start();
require('data.php');
if(!isset($_SESSION["login_sess"])) 
{
    header("location:loginpage.php"); 
}
  $email_address=$_SESSION["login_email"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <meta name="Description" content="Enter your description here"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="password.css">
    <title>Dashboard</title>
</head>
<body>
<main>
        <div class="dropdown">
        <div id="nav">
         <div class="nav">
            <a class="nav-link active" href="dash.php">
                <i class="fa-solid fa-gauge"></i>
                <span>Dashboard</span>
            </a>
        </div>
        <div class="nav1">
            <a class="nav-link active">
                <i class=" fas fa-user-circle">   </i>
                <span>My Account</span>
            </a>
        </div>
            <button class="dropbtn" onclick="myFunction()"><i class="fa-solid fa-money-bill"></i><span>Payment</span>
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content" id="myDropdown">
            <a href="transfer.php"><i class="fa-solid fa-money-bill-transfer"></i><span>Transfer</span></a>
            <a href="#"><i class="fa-solid fa-piggy-bank"></i><span>Deposit</span></a>
            <a href="#"><i class="fa-solid fa-money-simple-from-bracket"></i><span>Withdraw</span></a>
         </div>
         <div class="nav">
                <a class="nav-link active">
                <i class="far fa-credit-card"> </i>
                    <span>Cards</span>
                   
                </a>
            </div>
            <div class="nav">
                <a class="nav-link active">
                    <i class="fas fa-user-circle "> </i>
                    <span>Loans</span>
                   
                </a>
            </div>
            <div class="nav">
                <a class="nav-link active" href="message.php">
                <i class="fa-solid fa-message"> </i>
                    <span>Message</span>
               
                </a>
            </div>
            <div class="nav">
                <a class="nav-link active">
                <i class="fa-solid fa-messages-question"></i>
                    <span>FAQ</span>
                </a>
            </div>
            <button class="dropbtn" onclick="mFunction()"><i class="fa-solid fa-gear "></i><span>Settings</span>
             <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content" id="mDropdown">
                <a href="transfer.php"><i class="fa-solid fa-lock"></i><span>Update Password</span></a>
                <a href="#"><i class="fa-solid fa-piggy-bank"></i><span>Deposit</span></a>
                <a href="#"><i class="fa-solid fa-money-simple-from-bracket"></i><span>Withdraw</span></a>
            </div>
                <div class="nav">
                <a class="nav-link active" href="loginpage.php">
                    <i class="fas fa-user-circle "></i>
                    <span>Logout</span>
                </a>
                </div>
            </div>
        </div>
            <div id="header"></div>
        <div id="section">
           <div class="update">
           <?php
            
    if(isset($_POST['change_password'])){
        $currentPassword=$_POST['currentPassword']; 
         $password=$_POST['password'];  
        $passwordConfirm=$_POST['passwordConfirm']; 
       $sql="SELECT password from personal_accounts where email_address='$email_address'";
       $res = mysqli_query($connection,$sql);
             $res=mysqli_query($connection,$sql);
               $row = mysqli_fetch_assoc($res);
              if(password_verify($currentPassword,$row['password'])){
       if($passwordConfirm ==''){
                   $error[] = 'Please confirm the password.';
               }
               if($password != $passwordConfirm){
                   $error[] = 'Passwords do not match.';
               }
                 if(strlen($password)<5){ // min 
                   $error[] = 'The password is 6 characters long.';
               }
               
                if(strlen($password)>20){ // Max 
                   $error[] = 'Password: Max length 20 Characters Not allowed';
               }
       if(!isset($error))
       {
             $options = array("cost"=>4);
           $password = password_hash($password,PASSWORD_BCRYPT,$options);
       
            $result = mysqli_query($connection,"UPDATE personal_accounts SET password='$password' WHERE email_address='$email_address'");
                  if($result)
                  {
              header("location:dash.php?password_updated=1");
                  }
                  else 
                  {
                   $error[]='Something went wrong';
                  }
       }
       
               } 
               else 
               {
                   $error[]='Current password does not match.'; 
               }   
           }
               if(isset($error)){ 
       
       foreach($error as $error){ 
         echo '<p class="errmsg">'.$error.'</p>'; 
       }
       }
    ?>
            <form method="post" enctype="multipart/form-data" action="">
                <div class="old">
                    <label for="oldpassword">Current Password</label><br><br>
                    <input type="password" name="currentPassword"><span id="currentPassword" class="required"></span><br>
                </div>
                <div class="new">
                    <label for="newpassword">New Password</label><span id="newPassword" class="required"></span><br><br>
                    <input type="password" name="password"><br>
                </div>
                <div class="confirm">
                <label for="newpassword">Confirm Password</label><span id="confirmPassword" class="required"></span><br><br>
                    <input type="password" name="passwordConfirm"><br>
                </div>
             
                <button class="up" name="change_password">Change Password</button>

            </form>
           </div> 
        
        </div>
</main>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
  var myDropdown = document.getElementById("myDropdown");
    if (myDropdown.classList.contains('show')) {
      myDropdown.classList.remove('show');
    }
  }
}
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function mFunction() {
  document.getElementById("mDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
  var myDropdown = document.getElementById("Dropdown");
    if (myDropdown.classList.contains('show')) {
      myDropdown.classList.remove('show');
    }
  }
}

</script>
</body>
</html>