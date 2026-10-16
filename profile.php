<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("location:index.php");
    exit();
}

require 'db.php';

$sql = "SELECT * FROM users WHERE sn = :id";
$stmt = $pdo->prepare($sql);
$stmt -> execute([':id'=> $_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="profile.php">Matrimonial Site</a>
    <div>
      <a href="profile.php" class="btn btn-outline-light me-2">Profile</a>
      <a href="logout.php" class="btn btn-outline-light">Logout</a>
    </div>
  </div>
</nav> 

<div class="container mt-5">
  
    <div class="card p-4">
        <h1>welcome<?php echo " " . $user['fname'];?></h1>
        <img src = "profile/<?php echo $user['photo'];?>" width="400">
        <p>Email : <?php echo $user['email'];?></p>
        <p>Name : <?php echo $user['fname'];?></p>
        <p>Last Name : <?php echo $user['lname'];?></p>
        <p>Occupation : <?php echo $user['occupation'];?></p>
        <p>Religion : <?php echo $user['religion'];?></p>
        <p>State : <?php echo $user['state'];?></p>
        <p>City : <?php echo $user['city'];?></p>
        <p>Country : <?php echo $user['country'];?></p>
        <p>Date Of Birth : <?php echo $user['birth'];?></p>

    </div>

    <div class="mt-3">
        <a href="edit.php" class="btn btn-warning">Edit Profile</a>
        <a href="change_pass.php" class="btn btn-warning">Change password</a>
    </div> 

</div>