<?php


		
		
class product_sale{
		    
		public $supplied_date;
		public $deadline;
		public $discount;

		static function alter_tables(){
			konnekt();
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
						    REFERENCES `pro`.`Supplier` (`idSupplier`)
						    ON DELETE SET NULL
						    ON UPDATE CASCADE;

						    ALTER TABLE `product_supplier_deal` ADD CONSTRAINT `fk_product_Supplier_deal_product1`
                            FOREIGN KEY (`product_product_id`)
    						REFERENCES `pro`.`product` (`product_id`)
						    ON DELETE CASCADE
						    ON UPDATE CASCADE;
			 			END ");
			$sql->execute();
			$sql=$GLOBALS["conn" ]->prepare("CALL altertbl()");
			$sql->execute();
			$GLOBALS["conn" ]=null;

		}

		//kall get_info_by_n to hoose sup naewe fy el produt feeh funtion to get info by ae
		static function insert_sale($product_id,$start_date, $end_date,$quantity){
		  konnekt();

		  $sql = $GLOBALS["conn" ]->prepare("INSERT INTO `product_sale`( `start_date`,`quantity`,`product_product_id`, `end_date` ) VALUES (:start_date,:quantity,:product_id, :end_date);");
		  $sql->bindParam(':product_id', $product_id);
		   $sql->bindParam(':start_date', $start_date);
		    $sql->bindParam(':end_date', $end_date);
		     $sql->bindParam(':quantity', $quantity);
		  $sql->execute();
		  echo "New record created successfully";
		  $GLOBALS["conn" ]=null;
		}

		//join 2 tables: produt_sale and produt
		static function get_discount_by_date($start_date){
				konnekt();
      // prepare and bind

			    $sql = $GLOBALS["conn"]->prepare("SELECT * FROM `product_sale` AS s INNER JOIN `product` AS p ON  s.`product_product_id` = p.`product_id` WHERE `start_date`= ':start_date' ");
			    $sql->bindParam(':start_date', $start_date);
			  //  $sql->bindParam(':end_date', $end_date);
		     	
			    $sql->execute();

			    $result = $sql->fetchAll();
			    foreach ($result as $row) {
			    	 echo "Sale id: " . $row["idproduct_sale"]. "<br>"
			    	 . " - product_id: " . $row["product_product_id"] . "<br>"
			    	 ." - quantity: " . $row["quantity"]. "<br>"
				       ." - product_barcode: " . $row["product_barcode"] . "<br>"
				       ." - product_price: " . $row["product_price"]. "<br>"
				       ." - amount_available: " . $row["amount_available"]. "<br>"
				       ." - product_description: " . $row["product_description"]. "<br>";

			    	 ;
			     #join
			    if(!$sql){
		       		echo "Prepare failed:(". $GLOBALS["conn"]->errno.") ".$GLOBALS["conn"]->error."<br>";
		    }
			}
		}
		#update based on id and supplied date; it's ery likely to hae a situatio where the produt_id adn supplier_id repeat we dot want to onfuse our db
		#input: product_sale
		##to use this funtion: the arguments must be givenn in the same order 
		static function update($idproduct_sale,$product_id=NULL,$start_date=NULL, $end_date=NULL,$quantity=NULL){
		    // if ($product_id!=NULL){
		    //     konnekt();
		    //     $sql =  $GLOBALS["conn" ]->prepare("UPDATE `product_sale` SET `product_product_id` = ':product_id' WHERE `idproduct_sale`= '$idproduct_sale' ");

		    //     $sql->execute();
		    //     $GLOBALS["conn" ]=null;

		    // }
		    echo $idproduct_sale;
		    echo $start_date;
		    echo $end_date;
		    echo $quantity;
		    if ($quantity!=NULL){
		    	echo "quantity";
		        konnekt();
		        $sql =  $GLOBALS["conn" ]->prepare("UPDATE `product_sale` SET `quantity` = '$quantity' WHERE `idproduct_sale`= '$idproduct_sale' ");
		        #$sql->bindParam(':quantity', $quantity);
		        #$sql->bindParam(':idproduct_sale', $idproduct_sale);
		        $sql->execute();
		        $GLOBALS["conn" ]=null;
		        


		    }
		    if ($start_date!=NULL){
		        konnekt();
		        $sql =  $GLOBALS["conn"]->prepare("UPDATE `product_sale` SET `start_date` =:start_date WHERE `idproduct_sale`= '$idproduct_sale' ");

		        $sql->bindParam(':start_date', $start_date);
		        if(!$sql){
		       echo "Prepare failed: (". $GLOBALS["conn"]->errno.") ".$GLOBALS["conn"]->error."<br>";
		    }
		        $sql->execute();
		        $GLOBALS["conn" ]=null;
		        


		    }
		    if ($end_date!=NULL){
		        konnekt();
		        $sql =  $GLOBALS["conn"]->prepare("UPDATE `product_sale` SET `end_date` = :end_date WHERE `idproduct_sale`= '$idproduct_sale'");

		        $sql->bindParam(':end_date', $end_date);
		        if(!$sql){
		       echo "Prepare failed: (". $GLOBALS["conn"]->errno.") ".$GLOBALS["conn"]->error."<br>";
		    }
		        $sql->execute();
		        $GLOBALS["conn" ]=null;
		         echo "record updated successfully";


		    }

		  }


		  static function delete($sale_id){
		        konnekt();
		      // prepare and bind

		        $sql = $GLOBALS["conn"]->prepare("DELETE FROM `product_sale` WHERE `idproduct_sale`= '$sale_id' " ); 
		       
		        $sql->execute();
		        $GLOBALS["conn" ]=null;
		  }


		}
		
?> 