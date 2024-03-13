
<?php
include_once __DIR__."/lib/database/connection.php";


if(isset($_POST["reg"])){

    // form submitted
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    /**
     * Use Chat GPT to Generate REGEX Querys to verify user input
     * Username - Must be upto 6 characters
     * email - Must be a valid Email
     * password - 6 Characters, 1 Special Char, 1 number
     */
    // Verify
    $query = "SELECT `id` from `users` WHERE `username` = ? OR `email` = ?";
    $stmt  = $conn->prepare($query);
    $stmt->bind_param("ss",$username, $email);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows()>0){
        echo "Username or Email Taken";
    }else{
        $query = "INSERT INTO `users` (`username`,`email`,`password`) VALUES (?,?,?)";
        $stmt  = $conn->prepare($query);
        $password =password_hash($password,PASSWORD_DEFAULT);
        $stmt->bind_param("sss",$username, $email, $password);
        if($stmt->execute()){
            //Create Session
        }else{
            //Reload Page With Error
        }      

    }
    
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
            <label for="">Full Name</label><br>
            <input type="text" name="username">
        </div>
        <div>
            <label for="">Email</label><br>
            <input type="email" name="email">
        </div>
        <div>
            <label for="">Password</label><br>
            <input type="password" name="password">
        </div>
        <button name="reg">submit</button>
    </form>
</body>
</html>