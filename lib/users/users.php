<?php
include_once __DIR__."/../database/connection.php"; 

class Users{


    //create
    public static function Add(string $name,string $email,string $password) : bool {
        global $conn;
        $password = password_hash($password,PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO `users` (`username`,`email`,`password`) VALUES (?,?,?)");
        $stmt->bind_param("sss",$name,$email,$password);
        return $stmt->execute();
    }
    //update
    public static function Update(string $col,string $data,int $id) : bool {
        global $conn;
        $col = $conn->escape_string($col);
        $stmt = $conn->prepare("UPDATE `users` SET `$col`=? WHERE  `id`=?");
        $stmt->bind_param("si",$data,$id);
        return $stmt->execute();
    }
    //read
    public static function Get(int $id,array $cols = []) : array {
        global $conn;
        $query = "SELECT * from `users` WHERE `id` = ?";
        if(count($cols)!=0){
            $cols_ = implode(",",$cols);
            str_replace("*" , $cols_,$query);
        }
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i",$id);
        
        if(!$stmt->execute()){
            return [];
        }

        $stmt->store_result();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row == null ? []:$row;
    }

    //delete
    public static function Delete(int $id) : bool {
        global $conn;
        $stmt = $conn->prepare("DELETE from `users` WHERE `id` = ?");
        $stmt->bind_param("i",$id);
        return $stmt->execute();
    }
}



?>



