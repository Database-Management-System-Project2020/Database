<?php
$conn;

// Create connection
function connect(){
$servername = "localhost";
$username = "root";
$dbname = "project";

    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         echo "Connected successfully"; 

    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();

    }
    
$GLOBALS["conn" ]=$conn;

}
try{


#Bill_Line:: set_amount('10');
#Bill_line:: update_amount('15');


#echo Bill_line:: getamount(1);
echo Bill_line::get_price(5);
}




catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }

class Bill_Line{
	public $bill_line_id;
	public $refund_boolean="false";
    public $amount;
    public $price_per_product;
    public $Bill_id_b;
    public $product_product_id;


  function __construct($refund_boolean, $amount, $price_per_product){
    function getMAXproduct(){
        try {
            connect();
            $stmt = $GLOBALS["conn" ]->prepare("SELECT product_id from product ORDER BY product_id DESC LIMIT 0, 1");
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchColumn();
            $GLOBALS["conn" ]=null;
            }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            }
        }
        function getMAXbill(){
        try {
            connect();
            $stmt = $GLOBALS["conn" ]->prepare("SELECT id_b from Bill ORDER BY id_b DESC LIMIT 0, 1");
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchColumn();
            $GLOBALS["conn" ]=null;
            }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            }
        }
        connect();  
        $product_product_id = getMAXproduct();
        $this->product_product_id= $product_product_id;
        $this->refund_boolean= $refund_boolean;
        $this->amount = $amount;
        $this->price_per_product = $price_per_product;
        $this->Bill_id_b = $Bill_id_b;

        $stmt = $GLOBALS["conn" ]->prepare("INSERT INTO Bill_line (refund_boolean, amount, price_per_product Bill_id_b, product_product_id) 
                VALUES (:refund_boolean,:amount,:price_per_product,:Bill_id_b,:product_product_id)");
        $stmt->bindParam(':refund_boolean', $refund_boolean);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':price_per_product', $price_per_product);
        $stmt->bindParam(':Bill_id_b', $Bill_id_b);
        $stmt->bindParam(':product_product_id', $product_product_id);
        $stmt->execute();
        //$this->id = $conn->lastInsertId();
        echo "New records created successfully";
            $GLOBALS["conn" ]=null;

    

    } 

  
public static function set_amount($amount){
      try{
        connect();
         $stmt = $GLOBALS["conn"]->prepare("INSERT INTO BillLine (amount)VALUES (:amount)");
    $stmt->bindParam(':amount', $amount);
    $stmt->execute();

        echo "Connected successfully";
    }   
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
      
      }

    
public static function getamount($product_product_id) { 

        try {

      connect();

    $stmt = $GLOBALS["conn"]->prepare("SELECT amount FROM Bill_line");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt-> fetchColumn();
    $GLOBALS["conn" ]=null;

    }

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

return $amount;
}
  
public static function update_amount($product_product_id)
    {
        try{
        connect();
        $stmt = $GLOBALS["conn"]->prepare("UPDATE Bill_line SET amount = :amount");
        $stmt->bindParam(':amount', $amount);
        $stmt->execute();
        $GLOBALS["conn" ]=null;
       echo "Connected successfully";

        }
        catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }

        
    }


public static function update_refund($product_product_id)
    {
        connect();
        $stmt = $GLOBALS["conn"]->prepare("UPDATE Bill_line SET refund_boolean = true ");
        $stmt->bindParam(':refund_boolean', $refund_boolean);
        $stmt->execute();
        $GLOBALS["conn" ]=null;

        
    }


/*public static function getproductprice($product_product_id) { 


        try {

      connect();

    $stmt = $GLOBALS["conn"]->prepare("SELECT price_per_product FROM Bill_line WHERE $product_product_id = product_product_id");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt-> fetchColumn();
    $GLOBALS["conn" ]=null;

    }

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
echo "</table>";

}*/
  

 static function get_date($Bill_id_b)
    {
        try {
            connect();
            $stmt = $GLOBALS["conn"]->prepare("SELECT `date` FROM `bill` left outer JOIN  `Bill_line` on `Bill.id_b` = `Bill_line.Bill_id_b`
                WHERE `Bill.id_b` = '$Bill_id_b' ");
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchColumn();
            $GLOBALS["conn" ]=null;
            }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            }
        
    }
       static function get_barcode($product_product_id)
    {
        try {
            connect();
    $stmt = $GLOBALS["conn"]->prepare("SELECT `product_barcode` FROM `product` left outer JOIN  `Bill_line` on `product.product_id` = `Bill_line.product_product_id` 
                WHERE `product.product_id` = '$product_product_id' ");
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchColumn();
            $GLOBALS["conn" ]=null;
            }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            }
        
    }
  static function get_amount_available($product_product_id)
    {
        try {
            connect();
            $stmt = $GLOBALS["conn"]->prepare("SELECT product.amount_available FROM product INNER JOIN  Bill_line ON product.product_id = Bill_line.product_product_id");
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchColumn();
            }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            }
        
    }
 static function get_description($product_product_id)
    {
        try {
            connect();
            $stmt = $GLOBALS["conn"]->prepare("SELECT product.product_description FROM product INNER JOIN  Bill_line ON product.product_id = Bill_Line.product_product_id");
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchColumn();
            $GLOBALS["conn" ]=null;
            }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            }

    }
     static function get_price($product_product_id)
    {
        try {
            connect();

            $stmt = $GLOBALS["conn"]->prepare("SELECT product.product_price FROM product INNER JOIN  Bill_line ON product.product_id = Bill_line.product_product_id");
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchColumn();
            $GLOBALS["conn" ]=null;
            }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            }

    }
    
    static function detele($bill_line_id){
                try{
                    connect();
         $stmt = $GLOBALS["conn"]->prepare("DELETE FROM Bill_Line WHERE $bill_line_id=bill_line_id");
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




