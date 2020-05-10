<?php
include_once ('connection.php');
class Images
{	
  public $product_product_id;
  public $id_emp;
  function set_employee_ID($id){
            $GLOBALS["id_emp"]= $id;
        }

        function delete_employee_ID($id){
             $GLOBALS["id_emp"]= null;
        }
  function getMAXproduct(){
      try {
       //Connection::connect();
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
	
    
    function insert_image($filename)
	{
      Connection::connect(); 
      $product_product_id= Images::getMAXproduct();
      $id_emp = $GLOBALS["id_emp"];
  		$folder = "images/".basename($filename);
  		$stmt = Connection::get_conn()->prepare("INSERT INTO images (image,product_product_id, id_emp ) VALUES (:filename , :product_product_id, :id_emp )");
  		$stmt->bindParam(':filename', $filename);
      $stmt->bindParam(':product_product_id', $product_product_id);
      $stmt->bindParam(':id_emp', $id_emp);
  		$stmt->execute();
      Connection::close_conn();

		}

    static function get_images($product_barcode){
      Connection::connect();
      $product_product_id= Images::barcode_getsID($product_barcode);
      $stmt = Connection::get_conn()->prepare("SELECT * FROM images where product_product_id = $product_product_id ");
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $stmt->execute();
      return $stmt->fetch();
      Connection::close_conn();
    } 
    static function update_images($filename ,$product_barcode){

      Connection::connect();
      $product_product_id= Images::barcode_getsID($product_barcode);
      $stmt = Connection::get_conn()->prepare("UPDATE `images` SET `image` = :filename  WHERE `product_product_id`= :product_product_id ");
      $stmt->bindParam(':filename', $filename);
      $stmt->bindParam(':product_product_id', $product_product_id);
      $stmt->execute();
      Connection::close_conn();
    }
    function on_delete_cascade_images(){
        Connection::connect();
        $stmt1= Connection::get_conn()->prepare("alter table images DROP  constraint fk_images_product1");
        $stmt2=Connection::get_conn()->prepare("alter table images add constraint fk_images_product1 foreign key (product_product_id) references product(product_id) on delete cascade");
        $stmt1->execute();
        $stmt2->execute();
        echo "updated";
        Connection::close_conn();

    } 


}
?>