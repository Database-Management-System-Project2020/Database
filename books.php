<?php
include_once ('connection.php');
class Books
{
	public $product_product_id;
    public $brand_name;
    public $parts;
    public $educational_stage;
    public $subject;
    public $id_emp;
            function set_employee_ID($id){
            $GLOBALS["id_emp"]= $id;
        }

        function delete_employee_ID($id){
             $GLOBALS["id_emp"]= null;
        }
           
            function getMAXproduct(){
        try {
            Connection::connect();
            $stmt = Connection::get_conn()->prepare("SELECT MAX(product_id) FROM product WHERE  product.employee_idemployee ='{$GLOBALS["id_emp"]}' ");
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

        function barcode_getsID($product_barcode){
            $stmt = Connection::get_conn()->prepare("SELECT product_id from product WHERE product_barcode = $product_barcode");
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchColumn();


        }
        
         

	
	function __construct($brand_name,$parts, $educational_stage, $subject)
	{

		$product_product_id = Books::getMAXproduct();
        $id_emp = $GLOBALS["id_emp" ];
		$this ->ID = $product_product_id;
		$this->_brand_name = $brand_name;
	    $this->_parts = $parts;
	    $this->_educational_stage = $educational_stage;
	    $this->_subject = $subject;
        Connection::connect();
	    $stmt = Connection::get_conn()->prepare("INSERT INTO books (product_product_id,brand_name, parts, educational_stage, subject,id_emp) VALUES (:product_product_id,:brand_name,:parts,:educational_stage,:subject,:id_emp)");
	    $stmt->bindParam(':product_product_id', $product_product_id);
    	$stmt->bindParam(':brand_name', $brand_name);
    	$stmt->bindParam(':parts', $parts);
    	$stmt->bindParam(':educational_stage', $educational_stage);
    	$stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':id_emp', $id_emp);
    	$stmt->execute();
    	echo "innnssseeerreeedddd";
        Connection::close_conn();

	}
	static function get_brand_name($product_barcode)
	{
		try {
            Connection::connect();
            $ID = Books::barcode_getsID($product_barcode);
        	$stmt = Connection::get_conn()->prepare("SELECT brand_name FROM books WHERE product_product_id= $ID");
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

    static function get_parts($product_barcode)
	{
		try {
			Connection::connect();
            $ID = Books::barcode_getsID($product_barcode);
			$stmt = Connection::get_conn()->prepare("SELECT parts FROM books WHERE $ID = product_product_id");
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

    static function get_educational_stage($product_barcode)
	{
		try {
			Connection::connect();
            $ID = Books::barcode_getsID($product_barcode);
			$stmt = Connection::get_conn()->prepare("SELECT educational_stage FROM books WHERE $ID = product_product_id ");
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
    static function get_subject($product_barcode)
	{	try {
			Connection::connect();
            $ID = Books::barcode_getsID($product_barcode);
			$stmt = Connection::get_conn()->prepare("SELECT subject FROM books WHERE $ID = product_product_id ");
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
        static function get_price ($product_barcode)
	{
		try {
			Connection::connect();
            $ID = Books::barcode_getsID($product_barcode);
			$stmt = Connection::get_conn()->prepare("SELECT product_price FROM product left outer JOIN  books ON product.product_id = books.product_product_id
		        where product.product_id = $ID ");
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

    static function get_barcode($brand_name, $educational_stage, $subject, $product_description)
	{
		try {
			Connection::connect();
			$stmt = Connection::get_conn()->prepare("SELECT product_barcode FROM product WHERE books.brand_name = $brand_name
                and books.educational_stage = $educational_stage and books.subject= $subject and product.product_description= $product_description ");
    		$stmt->execute();

    		// set the resulting array to associative
    		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    		return $stmt->fetchAll();
    		Connection::close_conn();
			}
		catch(PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}
		
    }
    static function get_amount_available($product_barcode)
	{
		try {
			Connection::connect();
            $ID = Books::barcode_getsID($product_barcode);
			$stmt = Connection::get_conn()->prepare("SELECT amount_available FROM product left outer JOIN  books ON product.product_id = books.product_product_id
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
    static function get_description($product_barcode)
	{
		try {
			Connection::connect();
            $ID = Books::barcode_getsID($product_barcode);
			$stmt = Connection::get_conn()->prepare("SELECT product_description FROM product left outer JOIN  books ON product.product_id = books.product_product_id
		        where product.product_id = $ID ");
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
    static function get_product_book_images($product_barcode){
        try {
            Connection::connect();
            $ID = Books::barcode_getsID($product_barcode);
            $stmt = Connection::get_conn()->prepare("SELECT * FROM product left outer JOIN  books ON product.product_id = books.product_product_id
            left outer join images on product.product_id = images.product_product_id
            where product.product_id =$ID");
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


//_____________________________________________________________________________
    //######UPDATE FUNCTIONS#############
//_____________________________________________________________________________






    static function update_brand_name($brand_name, $product_barcode)
	{
		Connection::connect();
		$ID = Books::barcode_getsID($product_barcode);
		$stmt = Connection::get_conn()->prepare("UPDATE `books` SET `brand_name` = :brand_name  WHERE `product_product_id`=:product_product_id ");
		$stmt->bindParam(':brand_name', $brand_name);
        $stmt->bindParam(':product_product_id', $ID);
    	$stmt->execute();
    	Connection::close_conn();
    	
    }
    static function update_parts($parts,$product_barcode)
	{
		Connection::connect();
        $ID = Books::barcode_getsID($product_barcode);
		$stmt = Connection::get_conn()->prepare("UPDATE `books` SET `parts` = :parts  WHERE `product_product_id`= :product_product_id ");
		$stmt->bindParam(':parts', $parts);
        $stmt->bindParam(':product_product_id', $ID);
    	$stmt->execute();
    	Connection::close_conn();
    }
     function update_subject($subject,$product_barcode)
	{
		Connection::connect();
        $ID = Books::barcode_getsID($product_barcode);
		$stmt = Connection::get_conn()->prepare("UPDATE `books` SET `subject` = :subject  WHERE `product_product_id`= :product_product_id ");
		$stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':product_product_id', $ID);
    	$stmt->execute();
    	Connection::close_conn();
    }
     function update_educational_stage($educational_stage,$product_barcode)
	{
		Connection::connect();
        $ID = Books::barcode_getsID($product_barcode);
		$stmt = Connection::get_conn()->prepare("UPDATE `books` SET `educational_stage` = :educational_stage  WHERE `product_product_id`= :product_product_id ");
		$stmt->bindParam(':educational_stage', $educational_stage);
        $stmt->bindParam(':product_product_id', $ID);
    	$stmt->execute();
    	Connection::close_conn();
		
    }

    function update_price($price,$product_barcode)
	{
		Connection::connect();
        $ID = Books::barcode_getsID($product_barcode);
		$stmt = Connection::get_conn()->prepare("UPDATE `product` SET `product_price` = :price  WHERE `product_id`= :product_product_id ");
		$stmt->bindParam(':price', $price);
        $stmt->bindParam(':product_product_id', $ID);
    	$stmt->execute();
    	Connection::close_conn();
		
    }
   
    function update_available_amount($available_amount, $product_barcode)
	{
		Connection::connect();
        $ID = Books::barcode_getsID($product_barcode);
		$stmt = Connection::get_conn()->prepare("UPDATE `product` SET `amount_available` = :available_amount WHERE  `product_id`= :product_product_id");
		$stmt->bindParam(':available_amount', $available_amount);
        $stmt->bindParam(':product_product_id', $ID);
    	$stmt->execute();
    	Connection::close_conn();

		
    }
    function update_product_barcode($product_barcode, $old_product_barcode)
	{
		Connection::connect();
        $ID = Books::barcode_getsID($old_product_barcode);
		$stmt = Connection::get_conn()->prepare("UPDATE `product` SET `product_barcode` = :product_barcode WHERE  `product_id`= :product_product_id");
		$stmt->bindParam(':product_barcode', $product_barcode);
        $stmt->bindParam(':product_product_id', $ID);
    	$stmt->execute();
    	Connection::close_conn();

		
    }
    //________________________________________________________
    //DELETE FUNCTIONS
    //________________________________________________________

    function delete_book_record($product_barcode)
    {
        //delete from product &books &images
        //this query assumes that you anbled cascade delete in foreign constraints
        Connection::connect();
        $ID = Books::barcode_getsID($product_barcode);
        $stmt = Connection::get_conn()->prepare("DELETE FROM product WHERE product.product_id=$ID");
        $stmt->execute();
        Connection::close_conn();

    }
    function books_tbl_constraints(){
        Connection::connect();
        $stmt1= Connection::get_conn()->prepare("alter table books DROP  constraint fk_Books_product1");
        $stmt2=Connection::get_conn()->prepare("alter table books add constraint fk_Books_product1 foreign key (product_product_id) references product(product_id) on delete cascade");
        $stmt1->execute();
        $stmt2->execute();
        echo "updated";
        Connection::close_conn();

    }



}



?>
