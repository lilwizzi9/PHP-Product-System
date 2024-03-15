<a href="login.php">Login</a><br>
<a href="register.php">Register</a><br>


<?php
include_once __DIR__."/lib/database/connection.php";

if( isset($_POST["login"]) ){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    // Cleanup input
    $invalid = preg_match("/[\'^£$%&*()}{@#~?><>,|= +¬-]/",$username);

    if($invalid){
        die("User Name Contains Unwanted Characters");
    }

    print("Your Username is ".$username."<br>");
    print("Your Password is ".$password);
    $conn->query("INSERT INTO `users` ( `username`,`email`,`password` ) 
    VALUES ('$username','$email','$password')");
}else{
    print("Welcome");
}

?>

<form method="post">
    <input type="text" name="username" required><br>
    <button name="search">Submit</button>
</form>
<form method="post">
    <input type="text" name="username" required><br>
    <input type="email" name="email" required><br>
    <input type="password" name="password"><br>
    <button name="login">Submit</button>
</form>
<?php
$result = $conn->query("SELECT * FROM `class_demo`.`users` LIMIT 1000;");

//     var_dump($row);
//     print("<br><br>");
// }
?>


<?php 
if(isset($_POST["search"])){
    $username = $conn->escape_string($_POST["username"]);

    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `username` = ? ");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id,$uname,$email,$pass);


?>

    <h1>Results</h1>
    <table>
        <thead>
            <tr>
                <th>User Name</th>
                <th>Email</th>
                <th>Pwd</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while($stmt->fetch()){
            ?>
            <tr>
                <td><?php print($uname);?></td>
                <td><?php print($email);?></td>
                <td><?php print($pass);?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php 
}
?>


<h1>All Users</h1>
<table>
    <thead>
        <tr>
            <th>User Name</th>
            <th>Email</th>
            <th>Pwd</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        while($row = $result->fetch_assoc()){
        ?>
        <tr>
            <td><?php print($row['username']);?></td>
            <td><?php print($row['email']);?></td>
            <td><?php print($row['password']);?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>