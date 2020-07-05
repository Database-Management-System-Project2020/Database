<?php

class employee{
	public $idemployee;
	public $name_emp;
	public $job_description;
	public $employee_type_idemployee_type;

	function getMAXid_employee_type(){
    	try {
    		connect();
        	$stmt = $GLOBALS["conn"]->prepare("SELECT idemployee_type from employee_type ORDER BY idemployee_type DESC LIMIT 0, 1");
    		$stmt->execute();
    		// set the resulting array to associative
    		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		return $stmt->fetchColumn();
    		$GLOBALS["conn"]=NULL;

			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}

		}


		static function get_Employee_Table(){
	        try {
	          connect();
	              $stmt = $GLOBALS["conn"]->prepare("SELECT
					  employee.idemployee,
					  employee.name_emp,
					  employee.Job_description,
					  employee.employeeEmail,
					  employee.employee_type_idemployee_type,
					  employee_type.type,
					  pages.page_url

					  from employee left join employee_type on employee.employee_type_idemployee_type = employee_type.idemployee_type left join employee_type_has_pages on employee_type_has_pages.employee_type_idemployee_type = employee.idemployee left join pages on employee_type_has_pages.pages_idpages = pages.idpages ");
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



	static function insert_employee($name_emp, $job_description, $password, $email, $employee_type_idemployee_type ){
		//$employee_type_idemployee_type = employee::getMAXid_employee_type();
		$hashed = sha1($password);
		$stmt = $GLOBALS["conn"]->prepare("INSERT INTO employee (name_emp, job_description,employee_type_idemployee_type ,password, employeeEmail ) values (:name_emp,:job_description,:employee_type_idemployee_type, :password, :employeeEmail)");
		$stmt->bindParam(':name_emp', $name_emp);
	    $stmt->bindParam(':job_description', $job_description);
    	$stmt->bindParam(':employee_type_idemployee_type', $employee_type_idemployee_type);
    	$stmt->bindParam(':password', $hashed);
		$stmt->bindParam(':employeeEmail', $email);


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
    		$GLOBALS["conn"]=NULL;
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
    		return $stmt->fetch();
    		$GLOBALS["conn"]=NULL;
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
    		$GLOBALS["conn"]=NULL;
			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}

	}
	static function get_type_of_employee($ID){
        try {
            connect();
             $stmt = $GLOBALS["conn"]->prepare("SELECT * FROM employee_type left outer JOIN  employee ON employee_type.idemployee_type = employee.employee_type_idemployee_type where employee.idemployee =$ID");
            $stmt->execute();
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            //returns the array ""not echo nor print"";
            return $stmt-> fetchAll();
            $GLOBALS["conn"]=NULL;
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
    	$GLOBALS["conn"]=NULL;

	}
	static function update_job_description ($job_description ,$idemployee){
		connect();
		$stmt = $GLOBALS["conn"]->prepare("UPDATE `employee` SET `job_description` = :job_description  WHERE `idemployee`=:idemployee ");
		$stmt->bindParam(':job_description', $job_description);
        $stmt->bindParam(':idemployee', $idemployee);
    	$stmt->execute();
    	$GLOBALS["conn"]=NULL;

	}
	static function update_password ($password ,$idemployee){
		connect();
		//$hashed = sha1($password);
		$stmt = $GLOBALS["conn"]->prepare("UPDATE `employee` SET `password` = :password  WHERE `idemployee`=:idemployee ");
		$stmt->bindParam(':password', $password);
        $stmt->bindParam(':idemployee', $idemployee);
    	$stmt->execute();
    	$GLOBALS["conn"]=NULL;

	}
	static function update_email($email ,$idemployee){
		connect();
		$stmt = $GLOBALS["conn"]->prepare("UPDATE `employee` SET `employeeEmail` = :employeeEmail  WHERE `idemployee`=:idemployee ");
		$stmt->bindParam(':employeeEmail', $email);
        $stmt->bindParam(':idemployee', $idemployee);
    	$stmt->execute();
    	$GLOBALS["conn"]=NULL;

	}
	static function update_type($type ,$idemployee){
		connect();
		$stmt = $GLOBALS["conn"]->prepare("UPDATE `employee` SET `employee_type_idemployee_type` = :employee_type_idemployee_type  WHERE `idemployee`=:idemployee ");
		$stmt->bindParam(':employee_type_idemployee_type', $type);
        $stmt->bindParam(':idemployee', $idemployee);
    	$stmt->execute();
    	$GLOBALS["conn"]=NULL;

	}


	//___________________________________________________________________________
	#############(DELETE FUNCTION)#############################
	//__________________________________________________________________________
	function delete_employee_with_type($ID)
    {
        //delete from employee &employee_type
        connect();
        $stmt = $GLOBALS["conn"]->prepare("DELETE FROM `newpro`.`employee` WHERE (`idemployee` = $ID );");
        $stmt->execute();

        $GLOBALS["conn"]=NULL;


    }
        function set_null_idemployeetype(){
        connect();

        $stmt1= $GLOBALS["conn"]->prepare("ALTER TABLE employee DROP CONSTRAINT fk_employee_employee_type1");
        $stmt2=$GLOBALS["conn"]->prepare("alter table employee add constraint fk_employee_employee_type1 foreign key (employee_type_idemployee_type) references employee_type(idemployee_type)
            on delete set null on update cascade");
        $stmt1->execute();
        $stmt2->execute();

        $GLOBALS["conn"]=NULL;

    }
    static function elfunction_else7rya(){
    	//this function is used one only time in your life..
    	connect();
    	$stmt1= $GLOBALS["conn"]->prepare("ALTER TABLE employee DROP CONSTRAINT fk_employee_employee_type1");
    	$stmt2= $GLOBALS["conn"]->prepare("ALTER TABLE employee DROP COLUMN employee_type_idemployee_type");
    	$stmt3= $GLOBALS["conn"]->prepare("ALTER TABLE  employee ADD employee_type_idemployee_type int null;");
    	$stmt4= $GLOBALS["conn"]->prepare("ALTER TABLE employee add constraint fk_employee_employee_type1 foreign key (employee_type_idemployee_type) references employee_type(idemployee_type)
            on delete set null on update cascade");
    	$stmt1->execute();
        $stmt2->execute();
        $stmt3->execute();
        $stmt4->execute();
        echo "5alas keda ";
        $GLOBALS["conn"]=NULL;

    }


}



?>
