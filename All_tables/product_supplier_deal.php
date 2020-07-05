<?php


#include 'supplier.php';
class product_supplier_deal{
public $supplied_date;
public $deadline;
public $discount;


static function supplier_and_emp_has_pages_tbls_contstr(){
			connect();
			$sql=$GLOBALS["conn" ]->prepare("DROP PROCEDURE IF EXISTS altertbl");
			$sql->execute();

			$sql=$GLOBALS["conn" ]->prepare("CREATE PROCEDURE altertbl()
			 			BEGIN
			 				ALTER TABLE `product_sale` DROP CONSTRAINT `fk_product_sale_product1`;
			 				ALTER TABLE `product_sale` ADD CONSTRAINT `fk_product_sale_product1`
                            FOREIGN KEY (`product_product_id`)
                            REFERENCES `product` (`product_id`)
                            ON DELETE CASCADE
                            ON UPDATE CASCADE;
                            ALTER TABLE `product_supplier_deal` DROP CONSTRAINT `fk_product_has_Supplier_Supplier1`;
                            ALTER TABLE `product_supplier_deal` DROP CONSTRAINT `fk_product_Supplier_deal_product1`;
                            ALTER TABLE `product_supplier_deal` ADD CONSTRAINT `fk_product_has_Supplier_Supplier1`
                            FOREIGN KEY (`Supplier_idSupplier`)
						    REFERENCES `newpro`.`Supplier` (`idSupplier`)
						    ON DELETE SET NULL
						    ON UPDATE CASCADE;
						    ALTER TABLE `product_supplier_deal` ADD CONSTRAINT `fk_product_Supplier_deal_product1`
                            FOREIGN KEY (`product_product_id`)
    						REFERENCES `newpro`.`product` (`product_id`)
						    ON DELETE CASCADE
						    ON UPDATE CASCADE;
						   ALTER TABLE employee_type_has_pages
                DROP CONSTRAINT `fk_employee_type_has_pages_employee_type1`;
                ALTER TABLE employee_type_has_pages
                DROP CONSTRAINT `fk_employee_type_has_pages_pages1`;
                ALTER TABLE employee_type_has_pages
                ADD  CONSTRAINT `fk_employee_type_has_pages_employee_type1`
                    FOREIGN KEY (`employee_type_idemployee_type`)
                    REFERENCES `newpro`.`employee_type` (`idemployee_type`)
                    ON DELETE CASCADE
                    ON UPDATE CASCADE;
                ALTER TABLE employee_type_has_pages
                 ADD CONSTRAINT `fk_employee_type_has_pages_pages1`
                    FOREIGN KEY (`pages_idpages`)
                    REFERENCES `newpro`.`pages` (`idpages`)
                    ON DELETE CASCADE
                    ON UPDATE CASCADE;

			 			END ");
			$sql->execute();
			$sql=$GLOBALS["conn" ]->prepare("CALL altertbl()");
			$sql->execute();
			$GLOBALS["conn" ]=null;


		}
//kall get_info_by_n to hoose sup naewe fy el produt feeh funtion to get info by ae
static function insert_deal($product_id, $supplier_id, $supplied_date,$deadline, $discount){
  connect();

  $sql = $GLOBALS["conn" ]->prepare("INSERT INTO `product_supplier_deal`( `product_product_id`, `Supplier_idSupplier`, `supplied date`,`deadline`, `discount`) VALUES ('$product_id', '$supplier_id', '$supplied_date' ,'$deadline', '$discount');");
  $sql->execute();

  $GLOBALS["conn" ]=null;
}


static function get_deal_info_by_date($supplied_date){

		 connect();
		      // prepare and bind

		    $sql=$GLOBALS["conn"]->prepare("SELECT * FROM `supplier` AS s INNER JOIN `product_supplier_deal` AS d ON s.`idSupplier`=d.`Supplier_idSupplier`
        INNER JOIN `product` AS p ON p.`product_id`=d.`product_product_id` WHERE `supplied date` = :supplied_date ");

      $sql->bindParam(':supplied_date', $supplied_date);
      $sql->execute();
      $result = $sql->fetchAll();
      //UPGRADE; another for loop
     foreach ($result as $row) {
     echo  " - idSupplier: " . $row["idSupplier"]. "<br>"
     ." - name_s: " . $row["name_s"]
      ." - telephone_s: " . $row["telephone_s"]
      ." - address: " . $row["address"]. "<br>"
      ." - deals: " . $row["deals"]. "<br>"
      ." - product_product_id: " . $row["product_product_id"]. "<br>"
      ." - Supplier_idSupplier: " . $row["Supplier_idSupplier"]. "<br>"
      ." - supplied date: " . $row["supplied date"]. "<br>"
      ." - deadline: " . $row["deadline"]. "<br>"
      ." - discount: " . $row["discount"]. "<br>"
       ." - product_barcode: " . $row["product_barcode"]
       ." - product_price: " . $row["product_price"]
       ." - amount_available: " . $row["amount_available"]. "<br>"
       ." - product_description: " . $row["product_description"]. "<br>";
}

}
#update based on id and supplied date; it's ery likely to hae a situatio where the produt_id adn supplier_id repeat we dot want to onfuse our db
static function update($product_product_id,$Supplier_idSupplier ,$supplied_date=NULL ,$deadline=NULL,$discount=NULL){
    if ($discount!=NULL){
        connect();
        $sql =  $GLOBALS["conn" ]->prepare("UPDATE `product_supplier_deal` SET `discount` = '$discount' WHERE `product_product_id`= '$product_product_id' AND `Supplier_idSupplier`='$Supplier_idSupplier' AND `supplied date`='$supplied_date' ");
        $sql->execute();
        $GLOBALS["conn" ]=null;

    }
    if ($deadline!=NULL){
        connect();
        $sql =  $GLOBALS["conn"]->prepare("UPDATE `product_supplier_deal` SET `deadline` = :deadline WHERE `product_product_id`= '$product_product_id' AND `Supplier_idSupplier`='$Supplier_idSupplier' AND `supplied date`='$supplied_date'");

        $sql->bindParam(':deadline', $deadline);
        if(!$sql){
       echo "Prepare failed: (". $GLOBALS["conn"]->errno.") ".$GLOBALS["conn"]->error."<br>";
    }
        $sql->execute();
        $GLOBALS["conn" ]=null;

    }





  }
  static function delete($sup_id,$pro_id,$suplied_date){
		        connect();
		      // prepare and bind

		        $sql = $GLOBALS["conn"]->prepare("DELETE FROM `product_supplier_deal` WHERE `Supplier_idSupplier`= '$sup_id' AND `product_product_id`='$pro_id' AND `supplied date` = :date " );
		        $sql->bindParam(':date', $suplied_date);
		        $sql->execute();
		        $GLOBALS["conn" ]=null;
		  }

}


?>
