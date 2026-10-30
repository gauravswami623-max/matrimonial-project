<?php
session_start();

if(!isset($_SESSION["user_id"])){
    header("location:index.php");
    exit();
}
    if(!isset($_POST['receiver_id']) || !is_numeric($_POST['receiver_id'])){
        header("location:browse.php");
        exit();
    }

$sender = $_SESSION['user_id'];
$receiver = (int)$_POST['receiver_id'];
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

if($message === '' || strlen($message) > 1000){
    header("location:view.php?id=" .$receiver . "&err=1");
    exit();
}

if($receiver == $sender){
    header("location:browse.php");
    exit();
}

require 'db.php';

$stmt = $pdo->prepare("SELECT sn FROM users WHERE sn =:id");
$stmt->execute([':id' => $receiver]);
if(!$stmt->fetch()){
    header("location:browse.php");
    exit();
}

$stmt = $pdo->prepare("INSERT INTO messages(sender_id,receiver_id,message) Values(:s,:r,:m)");
$stmt->execute([':s'=> $sender, ':r'=> $receiver, ':m' => $message]);

header("location:view.php?id=" .$receiver ."&sent=1");
exit();

?>