<?php



// try{
// employee_type::setType('accountant');
//
// #echo employee_type::getType(1);
//
//
// #employee_type::deleteType(1);
//
// #employee_type::updateType(1,'aaa');
// }
//
//
//
//
// catch(PDOException $e)
//     {
//     echo "Error: " . $e->getMessage();
//     }




class employee_type{


public $idemployee_type;
public $type;


public function __construct($type){

$this->$type = $type;
}


   public static function setType($type){
    try {
      connect();


    $stmt = $GLOBALS["conn"]->prepare("INSERT INTO employee_type (type)VALUES (:type)");
    $stmt->bindParam(':type', $type);
    $stmt->execute();
        echo "connected successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }

}





public static function getType($idemployee_type) {
        try {

      connect();

    $stmt = $GLOBALS["conn"]->prepare("SELECT type FROM employee_type WHERE idemployee_type = $idemployee_type");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt-> fetchall();
    $GLOBALS["conn" ]=null;

}
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
        return $page_urll;
    }


   static function updateType($idemployee_type, $type){
    try{
        connect();
            $stmt = $GLOBALS["conn" ]->prepare("UPDATE `employee_type` SET `type` = :type WHERE idemployee_type= $idemployee_type ");
            $stmt->bindParam(':type', $type);



            $stmt->execute();

     $GLOBALS["conn" ]=null;




         echo "connected successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }




    }

static function deleteType($idemployee_type){
                try{
                    connect();
         $stmt = $GLOBALS["conn"]->prepare("DELETE FROM employee_type WHERE idemployee_type=$idemployee_type");


         $stmt->execute();


    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }


    }


}

?>
