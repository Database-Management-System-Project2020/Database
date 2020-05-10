<?php


class Connection{
	public $conn;
	static function connect(){
$servername = "localhost";
$username = "root";
$dbname = "pro";
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
function get_conn(){
	return $GLOBALS["conn"];


}
function close_conn(){
	$GLOBALS["conn"]= null;
}





}

?>