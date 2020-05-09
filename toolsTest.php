<?php

$conn;
function connect(){
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "projectdb";
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
	public $product_id;
	public $type;
	public $product_product_id;
	public $id_emp;
	function __construct($type,$id_emp){

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
  $this->id_emp = $id_emp;
  
  $stmt = $GLOBALS["conn" ]->prepare("INSERT INTO tools (type, product_product_id,id_emp) 
   VALUES (:type, :product_product_id,:id_emp)");
  $stmt->bindParam(':type', $type);
  
  $stmt->bindParam(':product_product_id', $product_product_id);
  $stmt->bindParam(':id_emp', $id_emp);
     $stmt->execute();

  echo "New records created successfully";
        $GLOBALS["conn" ]=null;
 }

	public static function get_foreignID_by_type($type)
	{
		try {
			connect();
        	$stmt = $GLOBALS["conn"]->prepare("SELECT product_product_id FROM tools WHERE `type` = '$type' ");
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

	public static function get_toolsAttributes($product_product_id)
	{
		try {
			connect();
        	$stmt = $GLOBALS["conn"]->prepare("SELECT type, id_emp FROM tools WHERE $product_product_id = product_product_id");
    		$stmt->execute();

    		// set the resulting array to associative
    		// $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		$result = $stmt->fetchAll();
    		foreach ($result as $row) {
     echo "  type: " . $row["type"]. " - empID: " . $row["id_emp"]. "<br>";
}
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

    public static function update_empTools($id_emp, $product_product_id)
	{
		connect();
		$stmt = $GLOBALS["conn"]->prepare("UPDATE `tools` SET `id_emp` = :id_emp WHERE  `product_product_id`= :product_product_id");
		$stmt->bindParam(':id_emp', $id_emp);
        $stmt->bindParam(':product_product_id', $product_product_id);
    	$stmt->execute();
    	$GLOBALS["conn" ]=null;

		
    }

    //add join
    
    static function get_infoProduct_leftouterJoin ($product_product_id)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT product_id, product_barcode, product_price, product_description, amount_available FROM product  left outer JOIN  tools ON product.product_id = tools.product_product_id WHERE  product.product_id = $product_product_id ");
    		$stmt->execute();

    		// set the resulting array to associative
    		//$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		$result =  $stmt->fetchAll();
    		foreach ($result as $row) {
     echo " id: " . $row["product_id"]. " - Barcode: " . $row["product_barcode"]. " - price: " . $row["product_price"]. " - description: " . $row["product_description"]. " - amount: " . $row["amount_available"]."<br>";
}
    		$GLOBALS["conn" ]=null;
			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}
		
    }
    

    static function get_infoProduct_innerJoin ($product_product_id)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT * FROM product  inner JOIN  tools ON product.product_id = tools.product_product_id WHERE  product.product_id = $product_product_id ");
    		$stmt->execute();

    		// set the resulting array to associative
    		//$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		$result =  $stmt->fetchAll();
    		foreach ($result as $row) {
     echo " id: " . $row["product_id"]. " - Barcode: " . $row["product_barcode"]. " - price: " . $row["product_price"]. " - description: " . $row["product_description"]. " - amount: " . $row["amount_available"]. " - type: " . $row["type"]. " - empID: " . $row["id_emp"]. "<br>";
}
    		$GLOBALS["conn" ]=null;
			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}
		
    }
    



}