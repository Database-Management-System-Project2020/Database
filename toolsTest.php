<?php

$conn;
function connect(){
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "mydb";
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

class Tools{
	public $type;
	public $product_product_id;

	function __construct($type){

		function getMAXproduct(){
           
    	try {
        	$stmt = $GLOBALS["conn" ]->prepare("SELECT product_id from product ORDER BY product_id DESC LIMIT 0, 1");
    		$stmt->execute();

    		// set the resulting array to associative
    		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		return $stmt->fetchColumn();

			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}

		}
		

         connect();

		$product_product_id = getMAXproduct();
		$this->type = $type;
		$this->product_product_id =$product_product_id; 
		$stmt = $GLOBALS["conn" ]->prepare("INSERT INTO tools (type, product_product_id) 
			VALUES (:type, :product_product_id)");
		$stmt->bindParam(':type', $type);
		$stmt->bindParam(':product_product_id', $product_product_id);
    	$stmt->execute();

		echo "New records created successfully";
        $GLOBALS["conn" ]=null;
	}

	public static function get_type($product_product_id)
	{
		try {
			connect();
        	$stmt = $GLOBALS["conn"]->prepare("SELECT type FROM tools WHERE product_product_id = product_product_id");
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


	public static function update_type($type, $product_product_id)
	{
		connect();
		$stmt = $GLOBALS["conn"]->prepare("UPDATE `tools` SET `type` = :type WHERE  `product_product_id`= :product_product_id");
		$stmt->bindParam(':type', $type);
        $stmt->bindParam(':product_product_id', $product_product_id);
    	$stmt->execute();
    	$GLOBALS["conn" ]=null;

		
    }

    //add join
    
    static function get_price ($product_product_id)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT product_price FROM product  left outer JOIN  tools ON product.product_id = tools.product_product_id ORDER BY tools.product_product_id
		WHERE  product.product_id = tools.product_product_id ");
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
    

    ////////////////////////////////////////////////////////////
    #If join doesn't work more accurate use this function
    ////////////////////////////////////////////////////////////
    /*
    static function get_price ($product_product_id)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT product_price FROM product WHERE product_id = 12 ");
    		$stmt->execute();

    		// set the resulting array to associative
    		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		return $stmt->fetchColumn();
    		$GLOBALS["conn" ]=null;
			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}
		
    }*/
    
    static function get_description($product_product_id)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT product_description FROM product left outer JOIN  tools ON product.product_id = tools.product_product_id WHERE 
			product.product_id = tools.product_product_id ");
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


    ////////////////////////////////////////////////////////////
    #If join doesn't work more accurate use this function
    ////////////////////////////////////////////////////////////
    /*
    static function get_description($product_product_id)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT product_description FROM product WHERE product_id = 12 ");
    		$stmt->execute();

    		// set the resulting array to associative
    		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		return $stmt->fetchColumn();
    		$GLOBALS["conn" ]=null;
			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}

    }*/
    
    static function get_amount_available($product_product_id)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT amount_available FROM product left outer JOIN  tools ON product.product_id = tools.product_product_id
		WHERE product.product_id = tools.product_product_id  ");
    		$stmt->execute();

    		// set the resulting array to associative
    		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		return $stmt->fetchColumn();
			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}
		
    }

    ////////////////////////////////////////////////////////////
    #If join doesn't work more accurate use this function
    ////////////////////////////////////////////////////////////
    /*
    static function get_amount_available($product_product_id)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT amount_available FROM product WHERE product_id = 12 ");
    		$stmt->execute();

    		// set the resulting array to associative
    		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		return $stmt->fetchColumn();
			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}
		
    }*/

    
    static function get_barcode($product_product_id)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT product_barcode FROM product left outer JOIN  tools on product.product_id = tools.product_product_id 
                WHERE product.product_id = tools.product_product_id ");
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


    ////////////////////////////////////////////////////////////
    #If join doesn't work more accurate use this function
    ////////////////////////////////////////////////////////////

    /*
    static function get_barcode($product_product_id)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT product_barcode FROM product WHERE product_id = 11 ");
    		$stmt->execute();

    		// set the resulting array to associative
    		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		return $stmt->fetchColumn();
    		$GLOBALS["conn" ]=null;
			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}
		
    }*/



}