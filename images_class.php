<?php
$conn;
function connect(){
$servername = "localhost";
$username = "root";
$dbname = "mydb";
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     echo "Connected successfully"; 
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$GLOBALS["conn"]=$conn;
}

class Images
{	
  public $product_product_id;
  public $product_stock_idstock;
  function getMAXproduct(){
      try {
       // connect();
          $stmt = $GLOBALS["conn" ]->prepare("SELECT product_id from product ORDER BY product_id DESC LIMIT 0, 1");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchColumn();
       // $GLOBALS["conn" ]=null;
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }

    }
    function getMAXstock(){
      try {
       // connect();
          $stmt = $GLOBALS["conn" ]->prepare("SELECT stock_idstock from product ORDER BY stock_idstock DESC LIMIT 0, 1");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchColumn();
       // $GLOBALS["conn" ]=null;
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }

    }
	
    
    function insert_image($filename)
	{
      connect(); 
      $product_product_id= Images::getMAXproduct();
      $product_stock_idstock = Images::getMAXstock();
       
  		$folder = "images/".basename($filename);
  		$stmt = $GLOBALS["conn"]->prepare("INSERT INTO images (image,product_product_id, product_stock_idstock ) VALUES (:filename , :product_product_id , :product_stock_idstock )");
  		$stmt->bindParam(':filename', $filename);
      $stmt->bindParam(':product_product_id', $product_product_id);
      $stmt->bindParam(':product_stock_idstock', $product_stock_idstock);
  		$stmt->execute();
      $GLOBALS["conn" ]=null;

		}

    static function get_images($product_product_id){
      connect();
      $stmt = $GLOBALS["conn"]->prepare("SELECT * FROM images where idimages = $product_product_id ");
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $stmt->execute();
      return $stmt->fetch();
      $GLOBALS["conn" ]=null;
    } 
    static function update_images($filename ,$product_product_id){

      connect();
      $stmt = $GLOBALS["conn"]->prepare("UPDATE `images` SET `image` = :filename  WHERE `product_product_id`= :product_product_id ");
      $stmt->bindParam(':filename', $filename);
      $stmt->bindParam(':product_product_id', $product_product_id);
      $stmt->execute();
      $GLOBALS["conn" ]=null;
    } 


}