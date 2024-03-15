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
            $query = str_replace("*" , $cols_,$query);
        }
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i",$id);
        
        if($stmt->execute()){
            $row = null;
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row == null ? []:$row;
        }
        return [];
        
    }
    public static function All(array $cols = [],int $page = 0,int $perpage = 10)
    {
        global $conn;
        $query = "SELECT * from `users` LIMIT ? OFFSET ?";
        if(count($cols)!=0){
            $cols_ = implode(",",$cols);
            $query = str_replace("*" , $cols_,$query);
        }   
        $offset = $page*$perpage; 
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $perpage,$offset);
        if($stmt->execute()){
            //$stmt->store_result();
            $res = $stmt->get_result();
            if($res){
                $result_array = [];
                while($row = $res->fetch_assoc()){
                    array_push($result_array,$row );
                }
                return $result_array;
            }else{
                return [];
            }
        }else{
            return [];
        }
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



