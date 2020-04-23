<?php

#include 'supplier.php';
class product_supplier_deal{
public $supplied_date;
public $deadline;
public $discount;


//kall get_info_by_n to hoose sup naewe fy el produt feeh funtion to get info by ae
static function insert_deal($product_id, $supplier_id,$deadline, $discount){
  konnekt();

  $sql = $GLOBALS["conn" ]->prepare("INSERT INTO `product_supplier_deal`( `product_product_id`, `Supplier_idSupplier`, `deadline`, `discount`) VALUES ('$product_id', '$supplier_id', '$deadline', '$discount');");
  $sql->execute();
  echo "New record created successfully";
  $GLOBALS["conn" ]=null;
}


#update based on id and supplied date; it's ery likely to hae a situatio where the produt_id adn supplier_id repeat we dot want to onfuse our db
static function update($product_product_id,$Supplier_idSupplier ,$supplied_date=NULL ,$deadline=NULL,$discount=NULL){
    if ($discount!=NULL){
        konnekt();
        $sql =  $GLOBALS["conn" ]->prepare("UPDATE `product_supplier_deal` SET `discount` = '$discount' WHERE `product_product_id`= '$product_product_id' AND `Supplier_idSupplier`='$Supplier_idSupplier' AND `supplied date`='$supplied_date' ");
        $sql->execute();
        $GLOBALS["conn" ]=null;

    }
    if ($deadline!=NULL){
        konnekt();
        $sql =  $GLOBALS["conn"]->prepare("UPDATE `product_supplier_deal` SET `deadline` = :deadline WHERE `product_product_id`= '$product_product_id' AND `Supplier_idSupplier`='$Supplier_idSupplier' AND `supplied date`='$supplied_date'");

        $sql->bindParam(':deadline', $deadline);
        if(!$sql){
       echo "Prepare failed: (". $GLOBALS["conn"]->errno.") ".$GLOBALS["conn"]->error."<br>";
    }
        $sql->execute();
        $GLOBALS["conn" ]=null;

    }

  
  
   echo "record updated successfully";

  }

}


?> 