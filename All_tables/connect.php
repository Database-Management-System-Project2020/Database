<?php

global $conn;
function connect(){
$servername = "localhost";
$username   = "root"; //username
$password   = "MyNewPass2020"; //pass
$dbname     = "newpro"; //database name
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$GLOBALS["conn" ]=$conn;
 }
connect();
