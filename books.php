<?php

$conn;
function connect(){
$servername = "localhost";
$username = "root";
$dbname = "mydb";
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

class Books
{
	public $product_product_id;
    public $brand_name;
    public $parts;
    public $educational_stage;
    public $subject;
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


	
	function __construct($brand_name,$parts, $educational_stage, $subject)
	{

		$product_product_id = Books::getMAXproduct();
		$this ->ID = $product_product_id;
		$this->_brand_name = $brand_name;
	    $this->_parts = $parts;
	    $this->_educational_stage = $educational_stage;
	    $this->_subject = $subject;
        connect();
	    $stmt = $GLOBALS["conn" ]->prepare("INSERT INTO books (product_product_id,brand_name, parts, educational_stage, subject) VALUES (:product_product_id,:brand_name,:parts,:educational_stage,:subject)");
	    $stmt->bindParam(':product_product_id', $product_product_id);
    	$stmt->bindParam(':brand_name', $brand_name);
    	$stmt->bindParam(':parts', $parts);
    	$stmt->bindParam(':educational_stage', $educational_stage);
    	$stmt->bindParam(':subject', $subject);
    	$stmt->execute();
    	echo "innnssseeerreeedddd";
        $GLOBALS["conn" ]=null;

	}
	static function get_brand_name($ID)
	{
		try {
			connect();
        	$stmt = $GLOBALS["conn"]->prepare("SELECT brand_name FROM books WHERE $ID = product_product_id");
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

    static function get_parts($ID)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT parts FROM books WHERE $ID = product_product_id");
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

    static function get_educational_stage($ID)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT educational_stage FROM books WHERE $ID = product_product_id ");
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
    static function get_subject($ID)
	{	try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT subject FROM books WHERE $ID = product_product_id ");
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
        static function get_price ($ID)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT product_price FROM product left outer JOIN  books ON product.product_id = books.product_product_id
		        where product.product_id = $ID ");
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
    static function get_barcode($ID)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT product_barcode FROM product left outer JOIN  books on product.product_id = books.product_product_id 
                where product.product_id = $ID");
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
    static function get_amount_available($ID)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT amount_available FROM product left outer JOIN  books ON product.product_id = books.product_product_id
		        where product.product_id = $ID ");
    		$stmt->execute();

    		// set the resulting array to associative
    		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		return $stmt->fetchColumn();
			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}
		
    }
    static function get_description($ID)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT product_description FROM product left outer JOIN  books ON product.product_id = books.product_product_id
		        where product.product_id = $ID ");
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

//_____________________________________________________________________________
    //######UPDATE FUNCTIONS#############
//_____________________________________________________________________________






    static function update_brand_name($brand_name, $ID)
	{
		connect();
		
		$stmt = $GLOBALS["conn"]->prepare("UPDATE `books` SET `brand_name` = :brand_name  WHERE `product_product_id`=:product_product_id ");
		$stmt->bindParam(':brand_name', $brand_name);
        $stmt->bindParam(':product_product_id', $ID);
    	$stmt->execute();
    	$GLOBALS["conn" ]=null;
    	
    }
    static function update_parts($parts,$ID)
	{
		connect();
		$stmt = $GLOBALS["conn"]->prepare("UPDATE `books` SET `parts` = :parts  WHERE `product_product_id`= :product_product_id ");
		$stmt->bindParam(':parts', $parts);
        $stmt->bindParam(':product_product_id', $ID);
    	$stmt->execute();
    	$GLOBALS["conn" ]=null;
    }
     function update_subject($subject,$ID)
	{
		connect();

		$stmt = $GLOBALS["conn"]->prepare("UPDATE `books` SET `subject` = :subject  WHERE `product_product_id`= :product_product_id ");
		$stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':product_product_id', $ID);
    	$stmt->execute();
    	$GLOBALS["conn" ]=null;
    }
     function update_educational_stage($educational_stage,$ID)
	{
		connect();
		$stmt = $GLOBALS["conn"]->prepare("UPDATE `books` SET `educational_stage` = :educational_stage  WHERE `product_product_id`= :product_product_id ");
		$stmt->bindParam(':educational_stage', $educational_stage);
        $stmt->bindParam(':product_product_id', $ID);
    	$stmt->execute();
    	$GLOBALS["conn" ]=null;
		
    }

    function update_price($price,$ID)
	{
		connect();
		$stmt = $GLOBALS["conn"]->prepare("UPDATE `product` SET `product_price` = :price  WHERE `product_id`= :product_product_id ");
		$stmt->bindParam(':price', $price);
        $stmt->bindParam(':product_product_id', $ID);
    	$stmt->execute();
    	$GLOBALS["conn" ]=null;
		
    }
   
    function update_available_amount($available_amount, $ID)
	{
		connect();
		$stmt = $GLOBALS["conn"]->prepare("UPDATE `product` SET `available_amount` = :available_amount WHERE  `product_id`= :product_product_id");
		$stmt->bindParam(':available_amount', $available_amount);
        $stmt->bindParam(':product_product_id', $ID);
    	$stmt->execute();
    	$GLOBALS["conn" ]=null;

		
    }
    function update_product_barcode($product_barcode, $ID)
	{
		connect();
		$stmt = $GLOBALS["conn"]->prepare("UPDATE `product` SET `product_barcode` = :product_barcode WHERE  `product_id`= :product_product_id");
		$stmt->bindParam(':product_barcode', $product_barcode);
        $stmt->bindParam(':product_product_id', $ID);
    	$stmt->execute();
    	$GLOBALS["conn" ]=null;

		
    }




}



?>