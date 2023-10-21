<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login</title>
</head>
<body>

     <div class="container mt-5 col-4">
          <form action="" method="post">
               <h1><?php $error ?></h1>
               <div class="form-group mt-5">
                    <label for="otp">OTP</label>
                    <input type="text" name="otp" class="form-control" placeholder="Enter The OTP" required>
               </div>
               <div class="form-group">
                    <input type="submit" name="submit"  class="btn btn-primary mb-4 mt-5" 
                    value="Verify OTP">
               </div>

               </form>
     </div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<?php
session_start();
function getOtp(){
     return $_SESSION['sendOtp'];
}

function verifyOtp(){
     if(isset($_POST["submit"])){
          $enteredOtp = $_POST["otp"];
          $otp = getOtp();
          
          if($enteredOtp==$otp){
               header("Location: Success.php");
          }
          else{
               $error="Failed Due To Some Reasons Try Again!";
          }
     }
}

verifyOtp();

?>