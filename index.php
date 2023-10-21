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
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Enter The Email" required>
               </div>
               <div class="form-group mt-5">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter The password" required>
               </div>
               <div class="form-group">
                    <input type="submit" name="submit"  class="btn btn-primary mb-4 mt-5" 
                    value="Login">
               </div>

               </form>
     </div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<?php
session_start();

require 'phpmailer/PHPMailer.php';
require 'phpmailer/Exception.php';
require 'phpmailer/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function generateOTP(){
     return rand(100000,999999);
}

function sendMail($to,$otp){
     try{
          $mail=new PHPMailer;                  
          $mail->isSMTP();  
          $mail->Host="smtp.gmail.com";
          $mail->SMTPAuth=true;
          $mail->Username="laughingyt2022@gmail.com";
          $mail->Password="fxdmgfbrwbukzysa";
          $mail->SMTPSecure='tls';
          $mail->Port=587;
          $mail->setFrom("laughingyt2022@gmail.com",'Team Store');
          $mail->addAddress($to);
          $mail->isHTML(true);                                 
          $mail->Subject = "OTP From Team Store";
          $mail->Body = "<h1>Verification code</h1>
                         Please use the verification code below to sign in.<br>
                         <b>$otp</b>
                         If you didn’t request this, you can ignore this email.<br>
                         Thanks,<br>
                         Team Store";
          $mail->AltBody = 'Please Dont Share OTP with anyone.';
          if($mail->send())
          {
               return true;
          }
          else{
               return false;
          }
          
     }
     catch (Exception $e){
          echo $e;
     }
}

function getUserData($email){
     include 'connection.php';
     $query="select * from users where email='$email'";
     $run=mysqli_query($conn,$query);
     if(mysqli_num_rows($run)>0)
     {
          $row=mysqli_fetch_assoc($run);
          return $row;
     }
     else{
          echo "<script>alert('User Doesnt Found')</script>";
     }
}

function verifyEmail(){
     if(isset($_POST["submit"])){
          $email = $_POST["email"];
          $password = $_POST["password"];
          $row=getUserData($email);
          //$verify=password_verify($password,$row['password']);
          // echo $row;
          if($password==$row['password'])
          {
               $otp = generateOTP();
               $send = sendMail($email,$otp);
               if($send){
                    $_SESSION['sendOtp'] = $otp;
                    $_SESSION['user'] = $email;
                    header("Location: verifyotp.php");
               }
               else{
                    $error="Failed Due To Some Reasons Try Again!";
               }
          }
          else{
               echo "<script>alert('Incorrect Email Or Password')</script>";
          }
          
     }
}

verifyEmail();


?>