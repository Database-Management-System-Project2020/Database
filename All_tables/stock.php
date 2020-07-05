<?php




#try{

#echo stock:: getquantity(1);
#echo stock:: getIdstock(3);
#stock:: setquantity('18');
#stock:: updatequantity('1',4);

#}




// catch(PDOException $e)
//     {
//     echo "Error: " . $e->getMessage();
//     }

class stock{


      public $idstock;
      public $quantity;


  function __construct($quantity){
        $this->quntity =$quantity;

}


   public static function setquantity($quantity){
    try {
      connect();


    $stmt = $GLOBALS["conn"]->prepare("INSERT INTO stock (quantity) VALUES (:quantity) ");
    $stmt->bindParam(':quantity', $quantity);


    $stmt->execute();



        echo "connected successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }

}

public static function getIdstock($product_barcode) {

    try {

      connect();

    $stmt = $GLOBALS["conn"]->prepare("SELECT idstock FROM product WHERE product_barcode=$product_barcode");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt-> fetchAll();
    $GLOBALS["conn" ]=null;

    }

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

}





public static function getquantity($idstock) {


        try {

      connect();

    $stmt = $GLOBALS["conn"]->prepare("SELECT quantity FROM stock WHERE idstock=$idstock");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt-> fetchAll();
    $GLOBALS["conn" ]=null;

    }

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

}





public static function updatequantity($idstock,$quantity)
    {
        try{

        connect();
        $stmt = $GLOBALS["conn"]->prepare("UPDATE stock SET quantity = :quantity WHERE  idstock= $idstock");
        $stmt->bindParam(':quantity', $quantity);


            $stmt->execute();


      $GLOBALS["conn" ]=null;




         echo "connected successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }

    }


    static function detele($idstock){
                try{
                    connect();
         $stmt = $GLOBALS["conn"]->prepare("DELETE FROM stock WHERE idstock=$idstock");
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
