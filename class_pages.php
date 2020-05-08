<?php
$conn;

function connect(){
$servername = "localhost";
$username = "root";
$dbname = "project";
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     echo "Connected successfully"; 
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$GLOBALS["conn" ]=$conn;
}


try{
pages::setPage_url('abcd');
#pages:: delete(1)
#echo pages:: getPage_url('8');
#pages:: updatePages(1,'snapp');
#pages:: getID('abcd');
}




catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }



class pages{
	

public $idpages;
public $page_url;


public function __construct($page_url){

$this->$page_url = $page_url;
} 

 
   public static function setPage_url($page_url){
    try {
      connect();
  

    $stmt = $GLOBALS["conn"]->prepare("INSERT INTO pages (page_url)VALUES (:page_url)");
    $stmt->bindParam(':page_url', $page_url);
    $stmt->execute();
        echo "Connected successfully";
    }   
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
      
}



public static function getPage_url($idpages) { 
        try {

      connect();

    $stmt = $GLOBALS["conn"]->prepare("SELECT page_url FROM pages WHERE idpages = $idpages");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt-> fetchColumn();
    $GLOBALS["conn" ]=null;

}
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
        return $page_urll; 
    }
  
public static function getID($page_url) { 
        try {

      connect();

    $stmt = $GLOBALS["conn"]->prepare("SELECT idpages FROM pages WHERE page_url = $page_url");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt-> fetchColumn();
    $GLOBALS["conn" ]=null;

}
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
        return $page_urll; 
    }
  
   static function updatePages($idpages , $page_url){
    try{
        connect();
            $stmt = $GLOBALS["conn" ]->prepare("UPDATE pages SET page_url= :page_url WHERE idpages = $idpages ");
            $stmt->bindParam(':page_url', $page_url);
            $stmt->bindParam(':idpages', $idpages);

            $stmt->execute();


#$page_urll = "facebook";
      $GLOBALS["conn" ]=null;

    
    

         echo "Connected successfully";
    }   
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }




    } 

static function delete($idpages){
                try{
                    connect();
         $stmt = $GLOBALS["conn"]->prepare("DELETE FROM pages WHERE pages= $idpages");
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