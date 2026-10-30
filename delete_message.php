<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("location:index.php");
    exit();
}

if(!isset($_POST["message_id"]) || !is_numeric($_POST["message_id"])){
    header("location:inbox.php");
    exit();
}

require 'db.php';

$stmt = $pdo->prepare("DELETE FROM messages WHERE id=:id AND receiver_id = :me");
$stmt->execute([":id" => (int)$_POST['message_id'], ':me' => $_SESSION['user_id']]);

header("location:inbox.php");
exit();
?>