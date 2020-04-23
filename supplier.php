 <?php
$conn ;



function konnekt(){
$servername = "localhost";
//app
 $username = "root";
//default
 $password = "";
 $dbnae="pro";
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbnae", $username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     echo "Connected successfully"; 
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$GLOBALS["conn" ]=$conn;
}

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
konnekt();
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


  static function get_info_by_n($name_s){

      konnekt();
      // prepare and bind

    $sql = $GLOBALS["conn"]->prepare("SELECT * FROM `supplier` WHERE `name_s`= '$name_s'"); 
    $sql->execute();

     $result = $sql->fetchAll();

     foreach ($result as $row) {
     echo "id: " . $row["idSupplier"]. " - Name: " . $row["name_s"]. " - telephone: " . $row["telephone_s"]. " - address: " . $row["address"]. " - deals: " . $row["deals"]. "<br>";
}

        }


  static function get_phone_by_n($name_s){
        konnekt();


        $sql = $GLOBALS["conn"]->prepare("SELECT `telephone_s` FROM `supplier` WHERE `name_s`= '$name_s'"); 
    $sql->execute();

     $result = $sql->fetchAll();

     foreach ($result as $row) {
     echo  " - telephone: " . $row["telephone_s"]. "<br>";
}

       
        $GLOBALS["conn" ]=null;
  }



  static function update($idSupplier ,$telephone_s=NULL ,$address=NULL,$deals=NULL){
    

    if ($telephone_s!=NULL){
        konnekt();
        $sql =  $GLOBALS["conn" ]->prepare("UPDATE `supplier` SET `telephone_s` = :telephone_s WHERE `idSupplier`= :idSupplier ");
        $sql->bindParam(':telephone_s', $telephone_s);
        $sql->bindParam(':idSupplier', $idSupplier);
        $sql->execute();
        $GLOBALS["conn" ]=null;
    }
    if ($address!=NULL){
      echo $address;
        konnekt();
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
        konnekt();
        $sql =  $GLOBALS["conn" ]->prepare("UPDATE `supplier` SET `deals` = :deals WHERE `idSupplier`= :idSupplier ");
        $sql->bindParam(':deals', $deals);
        $sql->bindParam(':idSupplier', $idSupplier);
        $sql->execute();
       
        $GLOBALS["conn" ]=null;
    }
   echo "record updated successfully";

  }

//getsupp info
  //nonken n5ally da ariable we y'searh b ayy 7aga; keda keda honna nafs eldatatype

   // get_address_by_n(){

   // }

//   get_deals(){

//   }
}
?> 
