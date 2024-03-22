<?php
include_once __DIR__."/../lib/products/procucts.php";
include_once __DIR__."/../lib/users/users.php";

session_start();
print($_SESSION["userID"]);

//Products::Add("Bag","Hand Bag",$_SESSION["userID"]);
//Users::Add("Danny111","Danny111@Gmail.com","12345");

// var_dump(Users::All(["username","email"]));
//var_dump(Users::Get(8,["username","email"]));
Users::Create([
    "username"=>"emmanuel1234567o",
    "email"=>"aaaaa@gmail.com",
    "password"=>"aaaaaa@gmail.com"
]);


// Products::Create()
class Animal{
    public function test(){
        print("data");
    }
}

class dog extends Animal{
    
}

(new dog())->test();
?>



