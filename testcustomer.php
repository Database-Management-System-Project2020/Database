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

class Customer{
	public $idcustomer;
	public $name_c;
	public $telephone_c;
	//public $new_num;
	function __construct($name_c, $telephone_c){
		connect();
		$this->name_c = $name_c;
		$this->telephone_c = $telephone_c;
		$stmt = $GLOBALS["conn" ]->prepare("INSERT INTO customer (name_c, telephone_c) 
			VALUES (:name_c,:telephone_c)");
		
		$stmt->bindParam(':name_c', $name_c);
    	$stmt->bindParam(':telephone_c', $telephone_c);
    	//$stmt->bindParam(':new_num', $new_num);
    	$stmt->execute();
    	echo "New records created successfully";
    	$GLOBALS["conn" ]=null;


	}
	
	public static function get_info_by_name($name_c)
	{	try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT * FROM `customer` WHERE `name_c`= '$name_c'"); 
    		$stmt->execute();

    		// set the resulting array to associative
    		//$stmt->setFetchMode(PDO::FETCH_ASSOC);
    		$result = $stmt->fetchAll();
    		foreach ($result as $row) {
     echo "  ID: " . $row["idcustomer"]. " - telephone: " . $row["telephone_c"]. "<br>";
}
    		$GLOBALS["conn" ]=null;
			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}
		
    }
    
    public static function update_nameCustomer($idcustomer,$name_c)
	{
		connect();
		$stmt = $GLOBALS["conn" ]->prepare("UPDATE `customer` SET `name_c` = :name_c WHERE `idcustomer`= :idcustomer ");
		$stmt->bindParam(':name_c', $name_c);
        $stmt->bindParam(':idcustomer', $idcustomer);
    	$stmt->execute();
    	$GLOBALS["conn" ]=null;
		
    }
    
    public static function update_telephoneCustomer($idcustomer,$telephone_c)
	{
		connect();
		$stmt = $GLOBALS["conn"]->prepare("UPDATE `customer` SET `telephone_c` = :telephone_c WHERE `idcustomer`= :idcustomer ");
		$stmt->bindParam(':telephone_c', $telephone_c);
        $stmt->bindParam(':idcustomer', $idcustomer);

    	$stmt->execute();
    	$GLOBALS["conn" ]=null; 
    	
		
    }

    public static function delete_customer_by_id($idcustomer)
	{
		connect();
		$stmt = $GLOBALS["conn" ]->prepare("DELETE FROM `customer` WHERE `idcustomer`= :idcustomer ");
        $stmt->bindParam(':idcustomer', $idcustomer);
    	$stmt->execute();
    	$GLOBALS["conn" ]=null;
		
    }


  	

    


}