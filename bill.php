<?php
$conn;
// Create connection
function connect(){
$servername = "localhost";
$username = "root";
$dbname = "project";

   try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     echo "Connected successfully"; 
    
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
     $GLOBALS["conn" ]=$conn;

}
try{


#Bill:: set_date('10');
#Bill:: update_date('15');

echo Bill:: get_customername(5);
#echo Bill:: getdate('1');

}




catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }


class Bill {

      public $id_b;
      public $date= "";
      public $customer_idcustomer;


  function __construct($date){
  function getMAXcustomer(){
           
     try {
         $stmt = $GLOBALS["conn" ]->prepare("SELECT customer_id_c from customer ORDER BY customer_id_c DESC LIMIT 0, 1");
      $stmt->execute();

      // set the resulting array to associative
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      return $stmt->fetchColumn();

   }
  catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
   }

  
  }

         connect();

  $customer_id_c = getMAXcustomer();
  $this->date = $date;
  $this->customer_id_c =$customer_id_c; 
  $stmt = $GLOBALS["conn" ]->prepare("INSERT INTO bill (date, customer_id_c) 
   VALUES (:date, :customer_id_c)");
  $stmt->bindParam(':type', $type);
  $stmt->bindParam(':customer_id_c', $customer_id_c);
     $stmt->execute();

  echo "New records created successfully";
        $GLOBALS["conn" ]=null;
 }

  


static function set_date($date){
  try{
    connect();
  
       $stmt = $GLOBALS['conn']->prepare("INSERT INTO Bill (date) VALUES (:date)");
    $stmt->bindParam(':date', $date);
    

    $stmt->execute();



        echo "Connected successfully";
    }   

catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
}


public static function getdate($customer_id_c) { 


        try {

      connect();

    $stmt = $GLOBALS["conn"]->prepare("SELECT date FROM Bill");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt-> fetchColumn();
    $GLOBALS["conn" ]=null;

    }

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
echo "</table>";

}
  






public static function update_date($customer_id_c)
    {
        connect();
        $stmt = $GLOBALS["conn"]->prepare("UPDATE Bill SET date = :date ");
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $GLOBALS["conn" ]=null;

        
    }


 static function get_customername($customer_id_c)
    {
        try {
            connect();
            $stmt = $GLOBALS["conn"]->prepare("SELECT Customer.name_c, bill.customer_id_c from Customer INNER JOIN Bill on customer.id_c = bill.customer_id_c ");
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchColumn();
            $GLOBALS["conn" ]=null;
            }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            }
        
    }
static function get_customerphone($customer_id_c)
    {
        try {
            connect();
            $stmt = $GLOBALS["conn"]->prepare("SELECT Customer.telephone_c, bill.customer_id_c from Customer INNER JOIN Bill on customer.id_c = bill.customer_id_c");
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchColumn();
            $GLOBALS["conn" ]=null;
            }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            }
        
    }



static function detele($id_b){
                try{
                    connect();
         $stmt = $GLOBALS["conn"]->prepare("DELETE FROM Bill WHERE $id_b=id_b");
         $stmt->execute();

        echo "record deleted successfully";
    }   
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }


    }
}


?>





