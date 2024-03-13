<?php
include_once __DIR__."/lib/products/procucts.php";

session_start();
print($_SESSION["userID"]);

Products::Add("Bag","Hand Bag",$_SESSION["userID"]);

?>



