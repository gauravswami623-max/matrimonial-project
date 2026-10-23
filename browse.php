<?php
session_start();

if(!isset($_SESSION["user_id"])){
    header("location:index.php");
    exit();
}

require 'db.php';

$stmt = $pdo->prepare("SELECT gender FROM users WHERE sn =:id");
$stmt -> execute([':id' => $_SESSION['user_id']]);
$me = $stmt->fetch();

$wanted = ($me['gender'] == 'male') ? 'female' : 'male';

$stmt = $pdo->prepare("SELECT sn,fname,lname,city,religion,occupation,caste,photo FROM users WHERE gender = :g");
$stmt->execute([':g' => $wanted]);
$users = $stmt->fetchAll();

 ?>
<!DOCTYPE html>
<html>
    <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>BROWSE PROFILE</title>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <h3 class= "mb-4">Profiles</h3>
            <div class="row">
            <?php foreach($users as $u){?>
                <div class="col-md-4 mb-3">
                   <div class="card">

                    
                        <?php if(!empty($u['photo']) && file_exists("profile/" . $u['photo'])){ ?>
                                <img src="profile/<?php echo htmlspecialchars($u['photo']); ?>" class="card-img-top" style="height:250px; object-fit:cover;">
                            <?php } else { ?>
                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height:250px;">No photo</div>
                            <?php } ?>

                        <div class="card-body">
                         <h5><?php echo htmlspecialchars($u['fname']  . " " . $u['lname']);?></h5>
                        <p class="mb-1"><?php echo htmlspecialchars($u['occupation']);?> , <?php echo htmlspecialchars($u['city'])?></p>
                        <p class="mb-2"><?php echo htmlspecialchars($u['religion']);?> , <?php echo htmlspecialchars($u['caste'])?></p>
                        <a href="view.php?id=<?php echo $u['sn'];?>" class="btn btn-primary btn-sm">View Profile</a>
                        </div>
                    </div>

                </div>
            <?php } ?>
            </div>
        <a href = "profile.php" class="btn btn-outline-secondary">My Profile</a>
        </div>

    </body>

</html>