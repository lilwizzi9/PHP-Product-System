<?php

$DB_Host = "localhost";
$DB_User = "root";
$DB_Password = "";
$DB_Database = "class_demo";

$conn = new mysqli($DB_Host,$DB_User,$DB_Password,$DB_Database);
$Conn = $conn;
if($conn->errno){
    die("Database Connection Error!");
}
