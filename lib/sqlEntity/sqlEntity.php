<?php 
include_once __DIR__."/../database/connection.php";


class sqlEntity{

    protected static $table = null; 


    public static function Create(array $data): bool{
        global $conn;
        echo"hello";
        //`username`,`email`,`pwd`,`?`,`?`,`?`
        $cols = [];
        $colData = [];
        $types = "";
        for ($i=0; $i < count($data); $i++) { 
            array_push($cols,"`".array_keys($data)[$i]."`");
            array_push($colData,"?");
            $types.="s";
        }
        $cols = implode(",",$cols);
        $colData = implode(",",$colData);
        $query = "INSERT INTO `".static::$table."` ($cols) VALUES ($colData)";
        print($query."<br><br>");
        $stmt = $conn->prepare($query);
        $stmt->bind_param($types,...array_values($data));
        return $stmt->execute();
    }

    protected static function Update(int $id,string $col,string $data): bool{
        
        return false;
    }
    /**
     * the updateMany updates 1 row multiple colums using an assoc array
     * [col]=>NewValue
     */
    public static function UpdateMany(int $id,array $data): bool{
        
        return false;
    }

    protected static function ReadOne(int $id,array $cols): array{
        
        return [];
    }
    protected static function ReadMany(int $page,string $cols,int $perpage): array{
        
        return [];
    }
}
?>