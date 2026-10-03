<?php

if(empty($_POST["fname"]) || empty($_POST["lname"]) || empty($_POST["email"]) || empty($_POST["pass"]) || empty($_POST["gender"]) || empty($_POST["occ"]) || empty($_POST["date"]) || empty($_POST["religion"]) || empty($_POST["caste"]) || empty($_POST["country"]) || empty($_POST["state"]) || empty($_POST["city"])){
    header("location:registratrion.php?empty=1");
}

else{
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $email=$_POST["email"];
    $password=$_POST["pass"];
    $gender=$_POST["gender"];
    $occ=$_POST["occ"];
    $dob=$_POST["date"];
    $religion=$_POST["religion"];
    $caste=$_POST["caste"];
    $country=$_POST["country"];
    $state=$_POST["state"];
    $city=$_POST["city"];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    require 'db.php';
    echo $hashedPassword;
}

?>