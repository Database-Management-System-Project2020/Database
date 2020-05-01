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
$GLOBALS["conn"]=$conn;
}


class employee{
	public $idemployee;
	public $name_emp;
	public $job_description;
	public $type;
	public $employee_type_idemployee_type;

	function getMAXid_employee_type(){
    	try {
    		connect();

        	$stmt = $GLOBALS["conn"]->prepare("SELECT idemployee_type from employee_type ORDER BY idemployee_type DESC LIMIT 0, 1");
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



	static function insert_employee($name_emp, $job_description , $type , $password ){
		$employee_type_idemployee_type = employee::getMAXid_employee_type();
		$hashed = sha1($password);
		$stmt = $GLOBALS["conn"]->prepare("INSERT INTO employee (name_emp, job_description,type,employee_type_idemployee_type ,password  ) values (:name_emp,:job_description,:type,:employee_type_idemployee_type, :password)");
		$stmt->bindParam(':name_emp', $name_emp);
	    $stmt->bindParam(':job_description', $job_description);
    	$stmt->bindParam(':type', $type);
    	$stmt->bindParam(':employee_type_idemployee_type', $employee_type_idemployee_type);
    	$stmt->bindParam(':password', $hashed);

    	$stmt->execute();

	}
	static function get_emp_name($idemployee){
		connect();

		try {
			$stmt = $GLOBALS["conn"]->prepare("SELECT name_emp FROM employee WHERE idemployee = $idemployee");
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
	static function get_job_description($idemployee){
		connect();

		try {
			$stmt = $GLOBALS["conn"]->prepare("SELECT job_description FROM employee WHERE idemployee = $idemployee");
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
	static function get_type($idemployee){
		connect();

		try {
			$stmt = $GLOBALS["conn"]->prepare("SELECT type FROM employee WHERE idemployee = $idemployee");
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
	static function get_idemployee_type($idemployee){
		connect();

		try {
			
			$stmt = $GLOBALS["conn"]->prepare("SELECT employee_type_idemployee_type FROM employee WHERE idemployee = $idemployee ");
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
	static function update_name_emp ($name_emp ,$idemployee){
		connect();
		$stmt = $GLOBALS["conn"]->prepare("UPDATE `employee` SET `name_emp` = :name_emp  WHERE `idemployee`=:idemployee ");
		$stmt->bindParam(':name_emp', $name_emp);
        $stmt->bindParam(':idemployee', $idemployee);
    	$stmt->execute();
    	$GLOBALS["conn" ]=null;

	}
	static function update_type ($type ,$idemployee){
		connect();
		$stmt = $GLOBALS["conn"]->prepare("UPDATE `employee` SET `type` = :type  WHERE `idemployee`=:idemployee ");
		$stmt->bindParam(':type', $type);
        $stmt->bindParam(':idemployee', $idemployee);
    	$stmt->execute();
    	$GLOBALS["conn" ]=null;

	}
	static function update_job_description ($job_description ,$idemployee){
		connect();
		$stmt = $GLOBALS["conn"]->prepare("UPDATE `employee` SET `job_description` = :job_description  WHERE `idemployee`=:idemployee ");
		$stmt->bindParam(':job_description', $job_description);
        $stmt->bindParam(':idemployee', $idemployee);
    	$stmt->execute();
    	$GLOBALS["conn" ]=null;

	}

	






}



?>