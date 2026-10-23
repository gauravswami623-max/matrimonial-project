<?php
session_start();

if(!isset($_SESSION["user_id"])){
    header("location:index.php");
    exit();
}

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    header("location:browse.php");
    exit();
}
require 'db.php';

$stmt = $pdo->prepare("SELECT fname,lname,gender,occupation,religion,caste,city,country,state,birth,photo From users WHERE sn = :id");
$stmt -> execute([':id'=>$_GET['id']]);
$p = $stmt->fetch();

if(!$p){
    header("location:browse.php");
    exit();
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">
<div class="card shadow p-4">
<h3><?php echo htmlspecialchars($p['fname']  .  " "  . $p['lname']);?></h3>

<?php if(!empty($p['photo']) && file_exists("profile/" .$p['photo'])){?>
<img src="profile/<?php echo htmlspecialchars($p['photo']); ?>" width="300" class="mb-3">
<?php } else { ?>
<div class="bg-secondary text-white p-5 mb-3">No photo</div>
<?php } ?>

<p>Occupation : <?php echo htmlspecialchars($p['occupation']);?></p>
<p>Reliogion : <?php echo htmlspecialchars($p['religion']);?></p>
<p>Caste : <?php echo htmlspecialchars($p['caste']);?></p>
<p>State : <?php echo htmlspecialchars($p['state']);?></p>
<p>City : <?php echo htmlspecialchars($p['city']);?></p>
<p>Country : <?php echo htmlspecialchars($p['country']);?></p>
<p>Date Of Birth : <?php echo htmlspecialchars($p['birth']);?></p>
<a href="browse.php" class="btn btn-outline-secondary btn-sm" >Back to Profiles</a>
</div>

</div>

</body>

</html>
