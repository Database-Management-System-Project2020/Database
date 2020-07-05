<?php



class Product{

	public $product_id;
	public $product_barcode;
	public $product_price;
	public $product_description;
	public $amount_available;
	public $employee_idemployee;
	public $stock_idstock;
	public $idstock;

    function set_employee_ID($id){
            $GLOBALS["employee_idemployee"]= $id;
        }

        function delete_employee_ID($id){
             $GLOBALS["employee_idemployee"]= null;
        }
    function __construct($product_barcode, $product_price, $product_description, $amount_available, $stock_idstock){

    	connect();
        $employee_idemployee = $GLOBALS["employee_idemployee"];
        $this->product_barcode= $product_barcode;
        $this->product_price = $product_price;
        $this->product_description = $product_description;
        $this->amount_available = $amount_available;
        $this->employee_idemployee = $employee_idemployee;
    	$this->stock_idstock= $stock_idstock;

        $stmt = $GLOBALS["conn" ]->prepare("INSERT INTO product (product_barcode, product_price, product_description, amount_available,employee_idemployee, stock_idstock)
                VALUES(:product_barcode,:product_price,:product_description,:amount_available,:employee_idemployee,
                :stock_idstock)");
        $stmt->bindParam(':product_barcode', $product_barcode);
        $stmt->bindParam(':product_price', $product_price);
        $stmt->bindParam(':product_description', $product_description);
        $stmt->bindParam(':amount_available', $amount_available);
        $stmt->bindParam(':employee_idemployee', $employee_idemployee);
        $stmt->bindParam(':stock_idstock', $stock_idstock);
        $stmt->execute();
        //$this->id = $conn->lastInsertId();

        	$GLOBALS["conn" ]=null;

    }


    public static function get_infoProduct($product_barcode)
    {
    	try {
            connect();
            $stmt = $GLOBALS["conn"]->prepare("SELECT * FROM product WHERE `product_barcode` = '$product_barcode' ");
            $stmt->execute();

            // set the resulting array to associative
            // $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            foreach ($result as $row) {
     echo  "ID: " . $row["product_id"] ." - price: " . $row["product_price"]. " - description: " . $row["product_description"]. " - amount: " . $row["amount_available"]. " - employeId: " . $row["employee_idemployee"]. " - stockId: " . $row["stock_idstock"]. "<br>";
}
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





    public static function update_price($product_price,$product_id)
    {
        connect();
        $stmt = $GLOBALS["conn"]->prepare("UPDATE `product` SET `product_price` = :product_price WHERE `product_id`= :product_id ");
        $stmt->bindParam(':product_price', $product_price);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        $GLOBALS["conn" ]=null;

    }


    public static function update_description($product_description,$product_id)
    {
        connect();
        $stmt = $GLOBALS["conn"]->prepare("UPDATE `product` SET `product_description` = :product_description  WHERE `product_id`= :product_id ");
        $stmt->bindParam(':product_description', $product_description);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        $GLOBALS["conn" ]=null;

    }



    public static function update_amount_available($amount_available,$product_id)
    {
        connect();
        $stmt = $GLOBALS["conn"]->prepare("UPDATE `product` SET `amount_available` = :amount_available  WHERE `product_id`= :product_id ");
        $stmt->bindParam(':amount_available', $amount_available);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        $GLOBALS["conn" ]=null;

    }

    public static function delete_product($product_id)
	{
		connect();
		$stmt = $GLOBALS["conn" ]->prepare("DELETE FROM `product` WHERE `product_id`= :product_id ");
        $stmt->bindParam(':product_id', $product_id);
    	$stmt->execute();
    	$GLOBALS["conn" ]=null;

    }
    static function stockid_constraints(){
        connect();
        $stmt1= $GLOBALS["conn"]->prepare("ALTER TABLE product DROP CONSTRAINT fk_product_stock1");
        $stmt2= $GLOBALS["conn"]->prepare("ALTER TABLE product ADD constraint fk_product_stock1 foreign key (stock_idstock) references stock(idstock) on delete set null on update cascade");
        $stmt1->execute();
        $stmt2->execute();

        $GLOBALS["conn"] = NULL;
    }
    static function employee_idemployee_constraints(){
        connect();
        $stmt1= $GLOBALS["conn"]->prepare("ALTER TABLE product DROP CONSTRAINT fk_product_employee1");
        $stmt2= $GLOBALS["conn"]->prepare("ALTER TABLE product add constraint fk_product_employee1 foreign key (employee_idemployee) references employee(idemployee) on delete set null on update cascade");
        $stmt2->execute();
        $stmt1->execute();

        $GLOBALS["conn"] = NULL;

    }




}
?>
