<?php

session_start();
if(!isset($_SESSION['user_id'])){
    header("location:index.php");
    exit();
}

if(empty($_POST['fname']) || empty($_POST["lname"]) || empty($_POST['email']) || empty($_POST['gender']) || empty($_POST['occ']) || empty($_POST['date']) || empty($_POST['religion']) || empty($_POST['caste']) || empty($_POST['country']) || empty($_POST['state']) || empty($_POST['city'])){
    header("location:edit.php?empty=1");
    exit();
}

require 'db.php';

$id = $_SESSION["user_id"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$gender = $_POST["gender"];
$occ = $_POST["occ"];
$dob = $_POST["date"];
$religion = $_POST["religion"];
$caste = $_POST["caste"];
$country = $_POST["country"];
$state = $_POST["state"];
$city = $_POST["city"];

$stmt = $pdo->prepare("SELECT sn FROM users WHERE email = :email AND sn != :id ");
$stmt ->execute([':email' =>$email ,':id' => $id ]);
if($stmt->fetch()){
    header("location:edit.php?exist=1");
    exit();
}

$photoName = null;
if(isset($_FILES['photo']) && $_FILES["photo"]["error"] === UPLOAD_ERR_OK){
    $ext = strtolower(pathinfo($_FILES["photo"]["name"],PATHINFO_EXTENSION));
    $allowed = ['jpg' , 'jpeg' , 'png'];
    if(!in_array($ext , $allowed)){
        header("location:edit.php?badfile=1");
        exit();
    }
    $photoName = time() ."_". basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], "profile/" . $photoName);
}
    $sql = "UPDATE users SET fname=:fname, lname=:lname, email=:email, gender=:gender, occupation=:occ, birth=:dob, religion=:religion, caste=:caste, country=:country, state=:state, city=:city, photo=COALESCE(:photo,photo) WHERE sn = :id";
    $stmt = $pdo->prepare($sql);
    $stmt -> execute([
        ':fname' => $fname, ':lname' => $lname, ':email' => $email,
        ':gender' => $gender, ':occ' => $occ, ':dob' => $dob,
        ':religion' => $religion, ':caste' => $caste, ':country' => $country,
        ':state' => $state, ':city' => $city, ':photo' => $photoName, ':id' => $id
    ]);

    $_SESSION['user_name'] = $fname;

    header("location:profile.php");
    exit();
?>