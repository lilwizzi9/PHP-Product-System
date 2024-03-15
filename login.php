<?php

include_once __DIR__."/lib/database/connection.php";


if(isset($_POST["login"])){

    // form submitted
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if we have matching records ($email == email)

    $stmt = $conn->prepare("SELECT `password`,`id`,`username` from `users` WHERE `email` = ? LIMIT 1");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows() == 0){
        print("No User Found");
    } else{
        $stmt->bind_result($password_hash,$id,$username);
        $stmt->fetch();
        if(password_verify($password,$password_hash)){
                // keep logged in
            session_start();
            $_SESSION["userID"] =  $id;
            $_SESSION["username"] =  $username;
            print("Loggedin");
            header("Location:dashboard");
        }else{
            print("User Password Incorrect");
        }
        
    }  
    // Password of the user with matching email Matches Password -> $password

}

?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post">
        <div>
            <label for="">Email</label><br>
            <input type="email" name="email">
        </div>
        <div>
            <label for="">Password</label><br>
            <input type="password" name="password">
        </div>
        <button name="login">submit</button>
    </form>
</body>
</html> -->


<html lang="en"><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./assets/css/adminlte.min.css">
</head>
<body class="register-page" style="min-height: 570.781px;">
<div class="register-box">
  <div class="register-logo">
    <a href="index.php"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Login</p>

      <form  method="post">

        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button name="login" type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
<!-- 
      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div> -->

    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./assets/js/adminlte.min.js"></script>


</body></html>