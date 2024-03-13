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
            header("Location:Dashboard.php");
        }else{
            print("User Password Incorrect");
        }
        
    }  
    // Password of the user with matching email Matches Password -> $password

}

?>

<!DOCTYPE html>
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
</html>