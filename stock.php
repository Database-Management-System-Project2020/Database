<?php
$conn;
function connect(){
$servername = "localhost";
$username = "root";
$dbname = "project";
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     echo "Connected successfully"; 
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$GLOBALS["conn" ]=$conn;
}





try{
# pages::setPage_urll('hells');

#echo pages:: getPage_urll('8');
echo stock:: getquantity('1');

}




catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }

class stock{
  

      public $idstock;
      public $quantity;


  function __construct($quantity){
        $this->quntity =$quantity;
      
} 

 
   public static function setquantity($quantity){
    try {
      connect();
  

    $stmt = $GLOBALS["conn"]->prepare("INSERT INTO stock (quantity) VALUES (':quantity')");
    $stmt->bindParam(':quantity', $quantity);
    
    $stmt->execute();



        echo "Connected successfully";
    }   
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
      
}


public static function getquantity($idstock) { 


        try {

      connect();

    $stmt = $GLOBALS["conn"]->prepare("SELECT quantity FROM stock ");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt-> fetchColumn();
    $GLOBALS["conn" ]=null;

    }

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

}
  




public static function update_quantity($id_stock, $quantity)
    {
        connect();
        $stmt = $GLOBALS["conn"]->prepare("UPDATE `stock` SET `quantity` = :quantity WHERE  `idstock`= :idstock");
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':idstock', $idstock);
        $stmt->execute();
        $GLOBALS["conn" ]=null;

        
    }
 
public static function test($stmt){


  /*stmt = $conn->prepare("INSERT INTO pages (page_urll)
    VALUES (:page_urll)");
    $stmt->bindParam(':page_urll', $page_url);
    $page_urll= "localhost/dashboard/";
    $stmt->execute();*/

  
       return $stmt;

       
    }
    static function detele($idstock){
                try{
                    connect();
         $stmt = $GLOBALS["conn"]->prepare("DELETE FROM stock WHERE $idstock=idstock");
         $stmt->execute();

        echo "record deleted successfully";
    }   
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }


    }
}


?>