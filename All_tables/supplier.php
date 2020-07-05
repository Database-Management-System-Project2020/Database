 <?php


class Supplier {
  public $idSupplier;
  public $name_s='';
  public $deals;
  public $address="";
  public $telephone_s='';

  //initial alues' new supplier

  function __construct($name_s=NULL ,$telephone_s=NULL ,$address=NULL,$deals=NULL){
#mesh mme7taga el7etta dy asasa hab3at elvariables we 5laas
  	$this-> name_s=$name_s;
  	$this-> deals=$deals;
  	$this-> address=$address;
  	#echo $this-> name_s ;
  	$this-> telephone_s=$telephone_s;
connect();
// prepare and bind
$stmt = $GLOBALS["conn"]->prepare("INSERT INTO `supplier`( `name_s`, `telephone_s`, `address`, `deals`) VALUES ( :name_s, :telephone_s,:address, :deals);");
$stmt->bindParam(':name_s', $name_s);
    $stmt->bindParam(':telephone_s', $telephone_s);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':deals', $deals);

  echo "New record created successfully";

  $stmt->execute();
  $GLOBALS["conn" ]=null;
  }

  static function get_Supplier_Table(){
      try {
        connect();
            $stmt = $GLOBALS["conn"]->prepare("SELECT * from supplier left join product_supplier_deal
 on supplier.idSupplier = product_supplier_deal.Supplier_idSupplier left join product on product_supplier_deal.product_product_id = product.product_id");
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



  static function get_Supplier_TableByID($ID){
      try {
        connect();
            $stmt = $GLOBALS["conn"]->prepare("SELECT * from supplier left join product_supplier_deal
 on supplier.idSupplier = product_supplier_deal.Supplier_idSupplier left join product on product_supplier_deal.product_product_id = product.product_id where idSupplier = $ID ");
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


  static function get_info_by_n($name_s){

      connect();
      // prepare and bind

    $sql = $GLOBALS["conn"]->prepare("SELECT * FROM `supplier` WHERE `name_s`= '$name_s'");
    $sql->execute();

     $result = $sql->fetchAll();

     foreach ($result as $row) {
     echo "id: " . $row["idSupplier"]. " - Name: " . $row["name_s"]. " - telephone: " . $row["telephone_s"]. " - address: " . $row["address"]. " - deals: " . $row["deals"]. "<br>";
}
    $GLOBALS["conn" ]=null;
        }


    static function get_id_from_name($name_s){
          connect();
            // prepare and bind

          $sql = $GLOBALS["conn"]->prepare("SELECT  `idSupplier` FROM `supplier` WHERE `name_s`= '$name_s'");
          $sql->execute();

           $result = $sql->fetchAll();

           foreach ($result as $row) {
           echo "id: " . $row["idSupplier"]. " - Name: " . $row["name_s"]. "<br>";
      }
          $GLOBALS["conn" ]=null;

    }


  static function get_phone_by_n($name_s){
        connect();


        $sql = $GLOBALS["conn"]->prepare("SELECT `telephone_s` FROM `supplier` WHERE `name_s`= '$name_s'");
    $sql->execute();

     $result = $sql->fetchAll();

     foreach ($result as $row) {
     echo  " - telephone: " . $row["telephone_s"]. "<br>";
}


        $GLOBALS["conn" ]=null;
  }



  static function update($idSupplier,$supplierName = NULL ,$telephone_s=NULL ,$address=NULL,$deals=NULL){

      if($supplierName != NuLL){
          connect();
          $sql =  $GLOBALS["conn" ]->prepare("UPDATE `supplier` SET `name_s` = :supplierName WHERE `idSupplier`= :idSupplier ");
          $sql->bindParam(':supplierName', $supplierName);
          $sql->bindParam(':idSupplier', $idSupplier);
          $sql->execute();
          $GLOBALS["conn" ]=null;

      }


    if ($telephone_s!=NULL){
        connect();
        $sql =  $GLOBALS["conn" ]->prepare("UPDATE `supplier` SET `telephone_s` = :telephone_s WHERE `idSupplier`= :idSupplier ");
        $sql->bindParam(':telephone_s', $telephone_s);
        $sql->bindParam(':idSupplier', $idSupplier);
        $sql->execute();
        $GLOBALS["conn" ]=null;
    }
    if ($address!=NULL){
      echo $address;
        connect();
        $sql =  $GLOBALS["conn"]->prepare("UPDATE `supplier` SET `address` = :address WHERE `idSupplier`= :idSupplier ");
        if(!$sql){
       echo "Prepare failed: (". $GLOBALS["conn"]->errno.") ".$GLOBALS["conn"]->error."<br>";
    }
    $sql->bindParam(':address', $address);
     $sql->bindParam(':idSupplier', $idSupplier);
        $sql->execute();

        $GLOBALS["conn" ]=null;

    }

    if ($deals!=NULL){
        connect();
        $sql =  $GLOBALS["conn" ]->prepare("UPDATE `supplier` SET `deals` = :deals WHERE `idSupplier`= :idSupplier ");
        $sql->bindParam(':deals', $deals);
        $sql->bindParam(':idSupplier', $idSupplier);
        $sql->execute();

        $GLOBALS["conn" ]=null;
    }
   echo "record updated successfully";

  }
  //JOIN supplier and sup_tool_deal
  static function get_supplier_deal_info_by_id($idsupplier){
      connect();
      $sql=$GLOBALS["conn"]->prepare("SELECT * FROM `supplier` AS s INNER JOIN `product_supplier_deal` AS p ON s.`idSupplier`=p.`Supplier_idSupplier` WHERE s.`idSupplier`= :idsupplier ");
      $sql->bindParam(':idsupplier', $idsupplier);
      $sql->execute();
      $result = $sql->fetchAll();

     foreach ($result as $row) {
     echo  " - idSupplier: " . $row["idSupplier"]. "<br>" ." - name_s: " . $row["name_s"] ." - telephone_s: " . $row["telephone_s"]." - address: " . $row["address"]. "<br>"." - deals: " . $row["deals"]. "<br>"." - product_product_id: " . $row["product_product_id"]. "<br>"." - Supplier_idSupplier: " . $row["Supplier_idSupplier"]. "<br>"." - supplied date: " . $row["supplied date"]. "<br>"." - deadline: " . $row["deadline"]. "<br>"." - discount: " . $row["discount"]. "<br>" ;
}

      $GLOBALS["conn" ]=null;
  }
  #join3 tables: supplier produt_supplier_deal and produt
  static function get_supplier_product_and_deal_info_by_id($id_sup=NULL,$id_pro=NULL){
      connect();
      $id;
      $idval;
      if($id_sup!=NULL){
        $id="s.`idSupplier`";
        $idval=$id_sup;
      }


      if($id_pro!=NULL){
        $id="p.`product_id`";
        $idval=$id_pro;
      }
      $sql=$GLOBALS["conn"]->prepare("SELECT * FROM `supplier` AS s INNER JOIN `product_supplier_deal` AS d ON s.`idSupplier`=d.`Supplier_idSupplier`
        INNER JOIN `product` AS p ON p.`product_id`=d.`product_product_id` WHERE $id='$idval' ");
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

      $GLOBALS["conn" ]=null;
  }
//getsupp info
  //nonken n5ally da ariable we y'searh b ayy 7aga; keda keda honna nafs eldatatype

   // get_address_by_n(){

   // }

//   get_deals(){

//   }


  static function delete($id){
        connect();
      // prepare and bind

        $sql = $GLOBALS["conn"]->prepare("DELETE FROM `supplier` WHERE `idSupplier`= '$id'");
        $sql->execute();
        $GLOBALS["conn" ]=null;
  }
}
?>
