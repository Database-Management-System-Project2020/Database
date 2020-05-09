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

echo Bill_line::get_price(5);
#Bill_line::set_amount('10','1');


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


  function __construct($refund_boolean, $amount, $price_per_product, $Bill_id_b, $product_product_id){
    
        $this->refund_boolean= $refund_boolean;
        $this->amount = $amount;
        $this->price_per_product = $price_per_product;
        $this->Bill_id_b = $Bill_id_b;
        $this->product_product_id= $product_product_id;

        
    

    } 

  public static function get_id($barcode){
try{
    connect();


     $stmt = $GLOBALS["conn"]->prepare("SELECT product_id FROM product WHERE barcode=$barcode");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt-> fetchAll();
    $GLOBALS["conn" ]=null;
}


catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }

  }
public static function set_amount($amount, $bill_line_id){
      try{
        connect();
        $stmt = $GLOBALS["conn"]->prepare("INSERT INTO BillLine (amount) VALUES (:amount) WHERE bill_line_id=$bill_line_id");
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':bill_line_id', $bill_line_id);
        $stmt->execute();

        echo "Connected successfully";
    }   
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
      
      }

    

  
public static function update_amount($amount, $bill_line_id)
    {
        try{
        connect();
        $stmt = $GLOBALS["conn"]->prepare("UPDATE Bill_line SET amount = :amount WHERE bill_line_id=$bill_line_id");
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


public static function update_refund($bill_line_id)
    {
        connect();
        $stmt = $GLOBALS["conn"]->prepare("UPDATE Bill_line SET refund_boolean = true WHERE bill_line_id=$bill_line_id");
        $stmt->bindParam(':bill_line_id', $bill_line_id);
        $stmt->execute();
        $GLOBALS["conn" ]=null;

        
    }




 static function get_date($Bill_id_b)
    {
        try {
            connect();
            $stmt = $GLOBALS["conn"]->prepare("SELECT `date` FROM `bill` left outer JOIN  `Bill_line` on `Bill.id_b` = `Bill_line.Bill_id_b`
                WHERE `Bill.id_b` = '$Bill_id_b' ");
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
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
            return $stmt->fetchAll();
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
            return $stmt->fetchAll();
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
            return $stmt->fetchAll();
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
            return $stmt->fetchAll();
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




