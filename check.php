<?php

session_start();
if(empty($_POST["email"]) || empty($_POST["pass"])){
    header("location:index.php?empty=1");
    exit();
}

$email = $_POST["email"];
$pass = $_POST["pass"];

require 'db.php';

$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $pdo -> prepare($sql);
$stmt -> execute([':email' => $email,]);
$user = $stmt -> fetch();

if($user && password_verify($pass,$user['password'])) {
    $_SESSION["user_id"] = $user['sn'];
    $_SESSION["user_name"] = $user['fname'];

    header("location:profile.php");
}else{
    header("location:index.php");
}
?> 