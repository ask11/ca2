<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "123";
  $db = "";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
$sql = "CREATE DATABASE ca2";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
	echo "<br>";
}
 $db = "ca2";
 
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>
