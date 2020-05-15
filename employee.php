<?php
include_once ('connection.php');
class employee{
	public $idemployee;
	public $name_emp;
	public $job_description;
	public $employee_type_idemployee_type;

	function getMAXid_employee_type(){
    	try {
    		Connection::connect();
        	$stmt = Connection::get_conn()->prepare("SELECT idemployee_type from employee_type ORDER BY idemployee_type DESC LIMIT 0, 1");
    		$stmt->execute();
    		// set the resulting array to associative
    		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		return $stmt->fetchColumn();
    		Connection::close_conn();

			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}

		}



	static function insert_employee($name_emp, $job_description  , $password ){
		$employee_type_idemployee_type = employee::getMAXid_employee_type();
		$hashed = sha1($password);
		$stmt = Connection::get_conn()->prepare("INSERT INTO employee (name_emp, job_description,employee_type_idemployee_type ,password  ) values (:name_emp,:job_description,:employee_type_idemployee_type, :password)");
		$stmt->bindParam(':name_emp', $name_emp);
	    $stmt->bindParam(':job_description', $job_description);
    	$stmt->bindParam(':employee_type_idemployee_type', $employee_type_idemployee_type);
    	$stmt->bindParam(':password', $hashed);

    	$stmt->execute();

	}
	static function get_emp_name($idemployee){
		Connection::connect();
		try {
			$stmt = Connection::get_conn()->prepare("SELECT name_emp FROM employee WHERE idemployee = $idemployee");
    		$stmt->execute();

    		// set the resulting array to associative
    		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		return $stmt->fetchColumn();
    		Connection::close_conn();
			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}

	}
	static function get_job_description($idemployee){
		Connection::connect();
		try {
			$stmt = Connection::get_conn()->prepare("SELECT job_description FROM employee WHERE idemployee = $idemployee");
    		$stmt->execute();

    		// set the resulting array to associative
    		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		return $stmt->fetchColumn();
    		Connection::close_conn();
			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}

	}
	static function get_idemployee_type($idemployee){
		Connection::connect();
		try {
			
			$stmt = Connection::get_conn()->prepare("SELECT employee_type_idemployee_type FROM employee WHERE idemployee = $idemployee ");
    		$stmt->execute();

    		// set the resulting array to associative
    		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		return $stmt->fetchColumn();
    		Connection::close_conn();
			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}

	}
	static function get_type_of_employee($ID){
        try {
            Connection::connect();   
             $stmt = Connection::get_conn()->prepare("SELECT * FROM employee_type left outer JOIN  employee ON employee_type.idemployee_type = employee.employee_type_idemployee_type where employee.idemployee =$ID");
            $stmt->execute();
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            //returns the array ""not echo nor print"";
            return $stmt-> fetchAll();
            Connection::close_conn();
            }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            }

    }
	static function update_name_emp ($name_emp ,$idemployee){
		Connection::connect();
		$stmt = Connection::get_conn()->prepare("UPDATE `employee` SET `name_emp` = :name_emp  WHERE `idemployee`=:idemployee ");
		$stmt->bindParam(':name_emp', $name_emp);
        $stmt->bindParam(':idemployee', $idemployee);
    	$stmt->execute();
    	Connection::close_conn();

	}
	static function update_job_description ($job_description ,$idemployee){
		Connection::connect();
		$stmt = Connection::get_conn()->prepare("UPDATE `employee` SET `job_description` = :job_description  WHERE `idemployee`=:idemployee ");
		$stmt->bindParam(':job_description', $job_description);
        $stmt->bindParam(':idemployee', $idemployee);
    	$stmt->execute();
    	Connection::close_conn();

	}
	static function update_password ($password ,$idemployee){
		Connection::connect();		
		$hashed = sha1($password);
		$stmt = Connection::get_conn()->prepare("UPDATE `employee` SET `password` = :password  WHERE `idemployee`=:idemployee ");
		$stmt->bindParam(':password', $hashed);
        $stmt->bindParam(':idemployee', $idemployee);
    	$stmt->execute();
    	Connection::close_conn();

	}
	//___________________________________________________________________________
	#############(DELETE FUNCTION)#############################
	//__________________________________________________________________________
	function delete_employee_with_type($ID)
    {
        //delete from employee &employee_type
        Connection::connect();        
        $stmt = Connection::get_conn()->prepare("DELETE employee_type , employee FROM employee_type 
		LEFT  JOIN employee 
		on employee_type.idemployee_type = employee.employee_type_idemployee_type
		where  idemployee = $ID");
        $stmt->execute();
        Connection::close_conn();

    }
        function set_null_idemployeetype(){
        Connection::connect();

        $stmt1= Connection::get_conn()->prepare("ALTER TABLE employee DROP CONSTRAINT fk_employee_employee_type1");
        $stmt2=Connection::get_conn()->prepare("alter table employee add constraint fk_employee_employee_type1 foreign key (employee_type_idemployee_type) references employee_type(idemployee_type)
            on delete set null on update cascade");
        $stmt1->execute();
        $stmt2->execute();

        echo "updated";
        Connection::close_conn();

    }
    function elfunction_else7rya(){
    	//this function is used one only time in your life..
    	Connection::connect();
    	$stmt1= Connection::get_conn()->prepare("ALTER TABLE employee DROP CONSTRAINT fk_employee_employee_type1");
    	$stmt2= Connection::get_conn()->prepare("ALTER TABLE employee DROP COLUMN employee_type_idemployee_type");
    	$stmt3= Connection::get_conn()->prepare("ALTER TABLE  employee ADD employee_type_idemployee_type int null;");
    	$stmt4= Connection::get_conn()->prepare("alter table employee add constraint fk_employee_employee_type1 foreign key (employee_type_idemployee_type) references employee_type(idemployee_type)
            on delete set null on update cascade");
    	$stmt1->execute();
        $stmt2->execute();
        $stmt3->execute();
        $stmt4->execute();
        echo "5alas keda ";
        Connection::close_conn();

    }


}



?>