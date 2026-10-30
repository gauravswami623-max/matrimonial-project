<?php
$host = "localhost";
$dbname = "matrimonial_data";
$username = "root";
$password = "";

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username,$password);
    $pdo -> setATTRIBUTE(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("Connection failed : " . $e->getMessage() );
}
?>
