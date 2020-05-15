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

//echo Bill:: get_customername(5);
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

 
    public static function bill_table_constraints(){
        connect();
        $stmt1= $GLOBALS["conn" ]->prepare("alter table Bill DROP  constraint `fk_bill_customer1` ");
        $stmt2=$GLOBALS["conn" ]->prepare(" ALTER TABLE Bill
                    ADD CONSTRAINT `fk_bill_customer1`
                    FOREIGN KEY(`customer_idcustomer1`)
                  REFERENCES `pro`.`customer` (`idcustomer`)
                    ON DELETE CASCADE 
                    ON UPDATE CASCADE ");

        $stmt3= $GLOBALS["conn" ]->prepare("ALTER TABLE `Bill Line`
                      DROP CONSTRAINT `fk_Bill Line_bill1`; ");
        $stmt4=$GLOBALS["conn" ]->prepare(" ALTER TABLE `Bill Line`
                      ADD CONSTRAINT `fk_Bill Line_bill1`
                      FOREIGN KEY(`bill_id_b`)
                      REFERENCES `pro`.`bill` (`id_b`)
                      ON DELETE CASCADE
                    ON UPDATE CASCADE ");
        $stmt5=$GLOBALS ["conn"]->prepare("ALTER TABLE `Bill Line`
                      DROP CONSTRAINT `fk_Bill Line_product1`;");

        $stmt6=$GLOBALS ["conn"]->prepare("ALTER TABLE `Bill Line`
                      ADD CONSTRAINT `fk_Bill Line_product1`
                       FOREIGN KEY (`product_product_id`)
                      REFERENCES `pro`.`product` (`product_id`)
                      ON DELETE CASCADE
                      ON UPDATE CASCADE;");
        $stmt1->execute();
        $stmt2->execute();
        $stmt3->execute();
        $stmt4->execute();
       $stmt5->execute();
        $stmt6->execute();
        echo "updated";
        $GLOBALS["conn" ]=null;

    }
public static function set_date($date){
  try{
    connect();
  
       $stmt = $GLOBALS["conn"]->prepare("INSERT INTO Bill (date) VALUES (:date)");
    $stmt->bindParam(':date', $date);
    

    $stmt->execute();



        echo "Connected successfully";
    }   

catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
}




public static function get_id_by_date($date){
     try{
        connect();
        $stmt = $$GLOBALS["conn"]->prepare("SELECT id_b from Bill WHERE date = :date ");
        $stmt->bindParam(':date', $date);
       
        $stmt->execute();
         return $stmt-> fetchAll();
         $GLOBALS["conn" ]=null;
     }catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            }
}
public static function update_date($id_b, $date)
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

catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
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



static function delete($id_b){
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





