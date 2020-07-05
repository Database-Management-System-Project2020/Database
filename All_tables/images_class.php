<?php

//include 'connect.php';
class Images
{
  public $product_product_id;
  public $id_emp;
  function set_employee_ID($id){
            $GLOBALS["product_employee_idemployee"]= $id;
        }

        function delete_employee_ID($id){
             $GLOBALS["product_employee_idemployee"]= null;
        }
  function getMAXproduct(){
      try {
       //connect();
          $stmt = $GLOBALS['conn']->prepare("SELECT MAX(product_id) FROM product WHERE  product.employee_idemployee ='{$GLOBALS["product_employee_idemployee"]}' ");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchColumn();
        $GLOBALS['conn'] = NULL;
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }

    }
    function barcode_getsID($product_barcode){
        connect();
            $stmt = $GLOBALS["conn"]->prepare("SELECT product_id from product WHERE product_barcode = $product_barcode");
            $stmt->execute();
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchColumn();


        }


    function insert_image($filename)
	{
      connect();
      $product_product_id= Images::getMAXproduct();
      $id_emp = $GLOBALS["id_emp"];
  		$folder = "images/".basename($filename);
  		$stmt = $GLOBALS['conn']->prepare("INSERT INTO images (image,product_product_id, product_employee_idemployee ) VALUES (:filename , :product_product_id, :id_emp )");
  		$stmt->bindParam(':filename', $filename);
      $stmt->bindParam(':product_product_id', $product_product_id);
      $stmt->bindParam(':id_emp', $id_emp);
  		$stmt->execute();
      $GLOBALS['conn'] = NULL;

		}

    static function get_images($product_barcode){
     connect();
      $product_product_id= Images::barcode_getsID($product_barcode);
      $stmt =$GLOBALS["conn"]->prepare("SELECT * FROM images where product_product_id = $product_product_id ");
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $stmt->execute();
      return $stmt->fetch();
      $GLOBALS['conn'] = NULL;
    }
    static function update_images($filename ,$product_barcode){

      connect();
      $product_product_id= Images::barcode_getsID($product_barcode);
      $stmt = $GLOBALS["conn"]->prepare("UPDATE `images` SET `image` = :filename  WHERE `product_employee_idemployee`= :id_emp ");
      $stmt->bindParam(':filename', $filename);
      $stmt->bindParam(':id_emp', $product_product_id);
      $stmt->execute();
      $GLOBALS['conn'] = NULL;
    }
    function on_delete_cascade_images(){
        connect();
        $stmt1= $GLOBALS["conn"]->prepare("ALTER TABLE images DROP  constraint fk_images_product1");
        $stmt2=$GLOBALS["conn"]->prepare("ALTER TABLE images ADD constraint fk_images_product1 foreign key (product_product_id) references product(product_id) on delete cascade");
        $stmt1->execute();
        $stmt2->execute();

        $GLOBALS['conn'] = NULL;

    }


}
?>
