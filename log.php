<?php

if(empty($_POST["fname"]) || empty($_POST["lname"]) || empty($_POST["email"]) || empty($_POST["pass"]) || empty($_POST["gender"]) || empty($_POST["occ"]) || empty($_POST["date"]) || empty($_POST["religion"]) || empty($_POST["caste"]) || empty($_POST["country"]) || empty($_POST["state"]) || empty($_POST["city"])){
header("location:registration.php?empty=1");
exit();
}
else{
if(strlen($_POST['pass'])<6){
    header("location:registration.php?short=1");
    exit();
}
require 'db.php';

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

$stmt = $pdo->prepare("SELECT sn FROM users WHERE email= :email");
$stmt -> execute([':email' => $email]);
if($stmt->fetch()){
    header("location:registration.php?exists=1");
    exit();
}

if(!isset($_FILES["photo"]) || $_FILES["photo"]["error"] !== UPLOAD_ERR_OK){
    header("location:registration.php?nophoto=1");
    exit();
}

$ext = strtolower(pathinfo($_FILES["photo"]["name"],PATHINFO_EXTENSION));
$allowed =['jpg','jpeg','png'];
if(!in_array($ext,$allowed)){
    header("location:registration.php?badfile=1");
    exit();
}

$hashedpassword = password_hash($password,PASSWORD_DEFAULT);

$photoName = time() . "_" . basename($_FILES["photo"] ["name"]);
$target = "profile/" . $photoName;
move_uploaded_file($_FILES["photo"]["tmp_name"],$target);

$sql = "INSERT INTO users (fname,lname,email,password,gender,occupation,birth,religion,caste,country,state,city,photo)
Values (:fname,:lname,:email,:password,:gender,:occ,:dob,:religion,:caste,:country,:state,:city,:photo)";

$stmt = $pdo -> prepare($sql);

    $stmt -> execute([

        ':fname' => $fname,
        ':lname' => $lname,
        ':email' => $email,
        ':password' => $hashedpassword,
        ':gender' => $gender,
        ':occ' =>$occ,
        ':dob' => $dob,
        ':religion' =>$religion,
        ':caste' => $caste,
        ':country' => $country,
        ':state' => $state,
        ':city' => $city,
        ':photo' => $photoName,
    ]);
header("location:index.php?successful=1");
exit();
}

?>
