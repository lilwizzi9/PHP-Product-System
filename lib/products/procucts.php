<?php
include_once __DIR__."/../database/connection.php"; 
class Products{


    public static function Add(string $name,string $desc,int $owner){
        global $conn;
        $stmt = $conn->prepare("INSERT INTO `products` ( `name` , `desc`, `owner`) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi",  $name, $desc, $owner);
        return $stmt->execute() ;
    }

    public static function Update(string $col,string $data,string $id) : bool {
        global $conn;
        $col = $conn->escape_string($col);
        $stmt = $conn->prepare("UPDATE `products` SET `$col`=? WHERE  `id`=?");
        $stmt->bind_param("si",$data,$id);
        return $stmt->execute();
    }

    public static function All(int $page = 0,int $perpage = 10)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * from `products` OFFSET ? LIMIT ?");
        $stmt->bind_param("ii", $page*$perpage, $perpage);
        if($stmt->execute()){
            $stmt->store_result();
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

}



?>


