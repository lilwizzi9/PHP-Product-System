<?php 
include_once __DIR__."/../database/connection.php";


class sqlEntity{

    protected static $table = null; 

    protected static function Create(array $data): bool{
        global $conn;
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
        $stmt = $conn->prepare($query);
        $stmt->bind_param($types,...array_values($data));
        return $stmt->execute();
    }

    protected static function Update(int $id,string $col,string $data): bool{
        global $conn;
        $query = "UPDATE `".static::$table."` SET `$col` = ? where `id` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s",$data);
        return $stmt->execute();
    }
    /**
     * the updateMany updates 1 row multiple colums using an assoc array
     * [col]=>NewValue
     */
    public static function UpdateMany(int $id,array $data): bool{
        
        return false;
    }

    public static function ReadOne(int $id,array $cols = ["id"]): array{
        global $conn;
        if(count($cols)==0){
            return [];
        }
        $cols = implode(",",$cols);
        $query = "SELECT $cols from `".static::$table."` WHERE `id` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i",$id);
        if(!$stmt->execute()){
            return [];
        }
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }


    public static function FindWhere(string $col,OPERATOR $condition,$other,array $cols = ["id"]): array{
        global $conn;
        if(count($cols)==0){
            return [];
        }
        $cols = implode(",",$cols);
        $query = "SELECT $cols from `".static::$table."` WHERE `$col` ".$condition->value." ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s",$other);
        if(!$stmt->execute()){
            return [];
        }
        $result = $stmt->get_result();
        $rows = [];
        while($row = $result->fetch_assoc()){
            array_push($rows,$row);
        }
        return $rows;
    }


    public static function SELECT(int $page = 0,array $cols = ["id"],int $perpage = 10): array{
        global $conn;
        if(count($cols)==0){
            return [];
        }
        $cols = implode(",",$cols);
        $query = "SELECT $cols from `".static::$table."`LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($query);
        $offset = $page*$perpage;
        $stmt->bind_param("ii",$perpage,$offset);
        if(!$stmt->execute()){
            return [];
        }
        $result = $stmt->get_result();
        $rows = [];
        while($row = $result->fetch_assoc()){
            array_push($rows,$row);
        }
        return $rows;
    }
}



/**
 * 
 */
enum OPERATOR: string {
    case EQUAL = "=";
    case GRATERTHAN = ">";
    case LESSTHAN = "<";
    case GRATEROREQUAL = ">=";
    case LESSOREQUAL = "<=";
}

?>