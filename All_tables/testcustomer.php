<?php

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

    	$GLOBALS["conn" ]=null;


	}
	static function get_Customer_Table(){
        try {
         connect();
              $stmt = $GLOBALS["conn"]->prepare("SELECT * from customer");
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

	static function getCustInfoByID($ID){
		try {
			connect();
			$stmt = $GLOBALS["conn"]->prepare("SELECT * FROM newpro.customer WHERE idcustomer= $ID ");
			$stmt->execute();

			// set the resulting array to associative
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$result = $stmt->fetchAll();
			return $result;
		}catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
		}

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
