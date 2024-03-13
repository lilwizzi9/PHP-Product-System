<?php
include_once __DIR__."/lib/products/procucts.php";
include_once __DIR__."/lib/users/users.php";

session_start();
print($_SESSION["userID"]);

// Products::Add("Bag","Hand Bag",$_SESSION["userID"]);
//Users::Add("Danny111","Danny111@Gmail.com","12345");

var_dump(Users::Get(8));


?>



