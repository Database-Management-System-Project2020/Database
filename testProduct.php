<?php

$conn;
function connect(){
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "projectdb";
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     echo "Connected successfully"; 
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$GLOBALS["conn" ]=$conn;
}

class Product{

	public $product_barcode;
	public $product_price;
	public $product_description;
	public $amount_available;
	public $employee_idemployee;
	public $stock_idstock;
	public $idstock;
	public $idemplyee;
    function __construct($product_barcode, $product_price, $product_description, $amount_available){

    	connect();
        $this->product_barcode= $product_barcode;
        $this->product_price = $product_price;
        $this->product_description = $product_description;
        $this->amount_available = $amount_available;
        //$this->employee_idemployee = $employee_idemployee;
    	//$this->stock_idstock= $stock_idstock;

        $stmt = $GLOBALS["conn" ]->prepare("INSERT INTO product (product_barcode, product_price, product_description, amount_available) 
                VALUES(:product_barcode,:product_price,:product_description,:amount_available)");
        $stmt->bindParam(':product_barcode', $product_barcode);
        $stmt->bindParam(':product_price', $product_price);
        $stmt->bindParam(':product_description', $product_description);
        $stmt->bindParam(':amount_available', $amount_available);
        //$stmt->bindParam(':employee_idemployee', $employee_idemployee);
        //$stmt->bindParam(':stock_idstock', $stock_idstock);
        $stmt->execute();
        //$this->id = $conn->lastInsertId();
        echo "New records created successfully";
        	$GLOBALS["conn" ]=null;

    }

    
    public static function get_productAttributes($product_barcode)
    {   
    	try {
            connect();
            $stmt = $GLOBALS["conn"]->prepare("SELECT product_price, product_description, amount_available FROM product WHERE `product_barcode` = '$product_barcode' ");
            $stmt->execute();

            // set the resulting array to associative
            // $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            foreach ($result as $row) {
     echo  "  price: " . $row["product_price"]. " - description: " . $row["product_description"]. " - amount: " . $row["amount_available"]. "<br>";
}
            $GLOBALS["conn" ]=null;
            }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            }
        
    }
    
   
    
    public static function get_stockID($product_barcode)
    {   
    	try {
            connect();
            $stmt = $GLOBALS["conn"]->prepare("SELECT stock_idstock FROM product WHERE `product_barcode` = '$product_barcode' ");
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

    public static function get_infoStock_innerJoin ($stock_idstock)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT * FROM stock  inner JOIN  product ON stock.idstock = product.stock_idstock WHERE  stock.idstock = $stock_idstock ");
    		$stmt->execute();

    		// set the resulting array to associative
    		// $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		$result = $stmt->fetchAll();
    		foreach ($result as $row) {
     echo " id: " . $row["idstock"]. " - quantity: " . $row["quantity"]. " - Barcode: " . $row["product_barcode"]. " - price: " . $row["product_price"]. " - description: " . $row["product_description"]. " - amount: " . $row["amount_available"]. "<br>";
}
    		$GLOBALS["conn" ]=null;
			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}
		
    }

    public static function get_infoStock_leftouterJoin ($stock_idstock)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT idstock, quantity FROM stock  left outer JOIN  product ON stock.idstock = product.stock_idstock WHERE  stock.idstock = $stock_idstock ");
    		$stmt->execute();

    		// set the resulting array to associative
    		// $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		$result = $stmt->fetchAll();
    		foreach ($result as $row) {
     echo " id: " . $row["idstock"]. " - quantity: " . $row["quantity"]. "<br>";
}
    		$GLOBALS["conn" ]=null;
			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}
		
    }

    public static function get_empID($product_barcode)
    {   
    	try {
            connect();
            $stmt = $GLOBALS["conn"]->prepare("SELECT employee_idemployee FROM product WHERE `product_barcode` = '$product_barcode' ");
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


    public static function get_infoEmployee_innerJoin ($employee_idemployee)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT * FROM employee  inner JOIN  product ON employee.idemployee = product.employee_idemployee WHERE  employee.idemployee = $employee_idemployee ");
    		$stmt->execute();

    		// set the resulting array to associative
    		// $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		$result = $stmt->fetchAll();
    		foreach ($result as $row) {
     echo " id: " . $row["idemployee"]. " - nameEmp: " . $row["name_emp"]. " - jobDescription: " . $row["Job_description"]. " - password: " . $row["password"]. " - Barcode: " . $row["product_barcode"]. " - price: " . $row["product_price"]. " - description: " . $row["product_description"]. " - amount: " . $row["amount_available"]. "<br>";
}
    		$GLOBALS["conn" ]=null;
			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}
		
    }

    public static function get_infoEmployee_leftouterJoin ($employee_idemployee)
	{
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT idemployee, name_emp, Job_description, password FROM employee  left outer JOIN  product ON employee.idemployee = product.employee_idemployee WHERE  employee.idemployee = $employee_idemployee ");
    		$stmt->execute();

    		// set the resulting array to associative
    		// $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		$result = $stmt->fetchAll();
    		foreach ($result as $row) {
     echo " id: " . $row["idemployee"]. " - nameEmp: " . $row["name_emp"]. " - jobDescription: " . $row["Job_description"]. " - password: " . $row["password"]. "<br>";
}
    		$GLOBALS["conn" ]=null;
			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}
		
    }





    public static function update_price($product_price,$product_barcode)
    {
        connect();
        $stmt = $GLOBALS["conn"]->prepare("UPDATE `product` SET `product_price` = :product_price WHERE `product_barcode`= :product_barcode ");
        $stmt->bindParam(':product_price', $product_price);
        $stmt->bindParam(':product_barcode', $product_barcode);
        $stmt->execute();
        $GLOBALS["conn" ]=null;
        
    }


    public static function update_description($product_description,$product_barcode)
    {
        connect();
        $stmt = $GLOBALS["conn"]->prepare("UPDATE `product` SET `product_description` = :product_description  WHERE `product_barcode`= :product_barcode ");
        $stmt->bindParam(':product_description', $product_description);
        $stmt->bindParam(':product_barcode', $product_barcode);
        $stmt->execute();
        $GLOBALS["conn" ]=null;
        
    }



    public static function update_amount_available($amount_available,$product_barcode)
    {
        connect();
        $stmt = $GLOBALS["conn"]->prepare("UPDATE `product` SET `amount_available` = :amount_available  WHERE `product_barcode`= :product_barcode ");
        $stmt->bindParam(':amount_available', $amount_available);
        $stmt->bindParam(':product_barcode', $product_barcode);
        $stmt->execute();
        $GLOBALS["conn" ]=null;
        
    }

    public static function delete_product($product_barcode)
	{
		connect();
		$stmt = $GLOBALS["conn" ]->prepare("DELETE FROM `product` WHERE `product_barcode`= :product_barcode ");
        $stmt->bindParam(':product_barcode', $product_barcode);
    	$stmt->execute();
    	$GLOBALS["conn" ]=null;
		
    }



	
}
?>