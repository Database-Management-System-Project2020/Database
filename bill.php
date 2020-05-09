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
      public $date;
      public $customer_idcustomer;


  function __construct($date, $customer_idcustomer){
  
  $this->date = $date;
  $this->customer_idcustomer=$customer_idcustomer; 
}


public static function set_date($date){
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






public static function update_date($id_b)
    {
        connect();
        $stmt = $GLOBALS["conn"]->prepare("UPDATE Bill SET date = :date WHERE id_b= $id_b");
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $GLOBALS["conn" ]=null;

        
    }

public static function get_idcustomer($name_c){
     try{
        connect();
        $stmt = $$GLOBALS["conn"]->prepare("SELECT idcustomer from Customer WHERE name_c= $name_c ");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
         return $stmt-> fetchAll();
         $GLOBALS["conn" ]=null;
     }





}
 static function get_customerinfo($customer_idcustomer1)
    {
        try {
            connect();
            $stmt = $GLOBALS["conn"]->prepare("SELECT * from Customer INNER JOIN Bill on customer.idcustomer = bill.customer_idcustomer1 WHERE customer_idcustomer1=$customer_idcustomer1");
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



static function detele($id_b){
                try{
                    connect();
         $stmt = $GLOBALS["conn"]->prepare("DELETE FROM Bill WHERE id_b= $id_b");
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





