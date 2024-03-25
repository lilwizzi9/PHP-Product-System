<?php
include_once __DIR__."/../database/connection.php"; 
include_once __DIR__."/../sqlEntity/sqlEntity.php"; 
class Products extends sqlEntity{
    public static $table = "products";

    public static function Add(string $name,string $desc,int $owner){
        global $conn;
        return parent::Create([
            "name"=> $name,
            "desc"=> $desc,
            "owner"=> $owner
        ]);
    }

    // public static function Update(string $id, string $col,string $data) : bool {
    //     global $conn;
    //     $col = $conn->escape_string($col);
    //     $stmt = $conn->prepare("UPDATE `products` SET `$col`=? WHERE  `id`=?");
    //     $stmt->bind_param("si",$data,$id);
    //     return $stmt->execute();
    // }

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


