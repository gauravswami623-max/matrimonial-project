<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("location:index.php");
    exit();
}

if(empty($_POST["old_pass"]) || empty($_POST["new_pass"]) || empty($_POST["confirm_pass"])){
    header("location:change_pass.php?empty=1");
    exit();
}
 $old = $_POST["old_pass"];
 $new = $_POST["new_pass"];
 $confirm = $_POST["confirm_pass"];


 if($new !== $confirm){
    header("location:change_pass.php?mismatch=1");
    exit();
 }

 if(strlen($new) < 6){
    header("location:change_pass.php?short=1");
    exit();
 }

 require 'db.php';

 $stmt = $pdo->prepare("SELECT * FROM users WHERE sn = :id");
 $stmt->execute([':id' => $_SESSION['user_id']]);
 $user = $stmt->fetch();

 if(!$user || !password_verify($old,$user["password"])){
    header("location:change_pass.php?wrong=1");
    exit();
 }

 $hash = password_hash($new,PASSWORD_DEFAULT);

 $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE sn = :id");
 $stmt -> execute([':password' => $hash, ':id' => $_SESSION['user_id']]);
 
 header("location:change_pass.php?done=1");
 exit();
?>