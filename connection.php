<?php 
$servername = "localhost";
$username = "root";
$password = "1234";
$db_name = "box";

$conn = new mysqli($servername, $username, $password, $db_name, 3306);
if($conn->connect_error){
    die("Connection Failed".$conn->connect_error);
}
?>