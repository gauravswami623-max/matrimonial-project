<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location:index.php");
    exit();
}

require 'db.php';

$stmt = $pdo->prepare("SELECT * FROM users WHERE sn = :id");
$stmt ->execute([':id' => $_SESSION["user_id"]]);
$user = $stmt->fetch();
?>

<html>

<!DOCTYPE html>
<html>
<head>

<title>Edit Profile</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container mt-5">
    <div class ="card-shadow p-4">
        <h3 class="text-center mb-4">Edit Profile</h3>
        <div class="row">
<form method ="POST" action="update.php" enctype="multipart/form-data">

        <?php
        if(isset($_GET['empty'])){
        ?>
            <div class="alert alert-danger">Fill all the fields</div>

        <?php
        } if(isset($_GET['exist'])){
        ?>
            <div class="alert alert-yellow">this acclount already exist</div>

        <?php
        } if(isset($_GET['badfile'])){
        ?>
            <div class="alert alert-danger">only jpg ,jpeg and png file allow</div>
            
        <?php
        }
        ?>

            <div class="col-md-6 mb-3">
                <label>Name : </label>
                 <input type="text" name="fname" class="form-control" value="<?php echo htmlspecialchars($user['fname']);?>" >
            </div>

            <div class="col-md-6 mb-3">
                <label>Last Name : </label>
                <input type="text" name="lname" class="form-control" value="<?php echo htmlspecialchars($user['lname']);?>" required>
            </div>

            
        </div>
        <div class="mb-4">
            <label>Email : <label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email'])?>">
        </div>

        <div class="mb-4">
            <label>Gender : </label>
            <input type="radio" name="gender" value="male" <?php echo $user['gender']== 'male' ? 'checked' : ''; ?>> Male
            <input type="radio" name="gender" value="female" <?php echo $user['gender']=='female' ? 'checked' : '';?>> Female
        </div>

        <div class="mb-3">
            <label>Occupation : </label>
            <input type="text" name="occ" class="form-control" value = "<?php echo htmlspecialchars($user['occupation']);?>" required>
        </div>

        <div class="mb-3">
            <label>Dob : </label>
            <input type="date" name="date" class="form-control" value = "<?php echo htmlspecialchars($user['birth'])?>" required >
        </div>

        <div class="mb-3">
            <label>Religion : </label>
            <select name="religion" class="form-select">
                <option vlaue="hindu" <?php echo $user['religion']=='hindu' ? 'selected' : '';?>> Hindu</option>
                <option value="muslim" <?php echo $user['religion']=='muslim' ? 'selected' : '';?>> Muslim</option>
                <option value="christian" <?php echo $user['religion']=='christian' ? 'selected' : '';?>> Christian</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Caste : </label>
            <select name="caste" class="form-select">
                <option value="swami" <?php echo $user['caste']=='swami' ? 'selected' : '' ; ?>>Swami</option>
                <option value="lamba" <?php echo $user['caste']=='lamba' ? 'selected' : '' ; ?>>Lamba</option>
                <option value="pathan" <?php echo $user['caste']== 'pathan' ? 'selected' : '' ; ?>>Pathan</option>
                <option value="mohammad"<?php echo $user['caste']== 'mohammad' ? 'selected' : '' ; ?>>Mohammad</option>
                <option value="haaland" <?php echo $user['caste']== 'haaland' ? 'selected' : '' ; ?>>Haaland</option>
                <option value="loan" <?php echo $user['caste']== 'loan' ? 'selected' : '' ; ?>>Loan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Country : </label>
            <select name="country" class="form-select">
                <option value="india" <?php echo $user['country']=='india' ? 'selected' : '' ; ?>>India</option>
                <option value="iran" <?php echo $user['country']=='iran' ? 'selected' : '' ; ?>>Iran</option>
                <option value="america" <?php echo $user['country']=='america' ? 'selected' : '' ; ?>>America</option>
                <option value="pakistan" <?php echo $user['country']=='pakistan' ? 'selected' : '' ; ?>>Pakistan</option>

            </select>
        </div>

        <div class="mb-3">
            <label>State :  </label>
            <select name="state" class="form-select">
                <option value="rajastan" <?php echo $user['state']=='rajasthan' ? 'selected' : '' ; ?>>Rajasthan</option>
                <option value="punjab" <?php echo $user['state']=='punjab' ? 'selected' : '' ; ?>>Punjab</option>
                <option value ="haryana" <?php echo $user['state']=='haryana' ? 'selected' : '' ; ?>>Haryana</option>
                <option value="odisha" <?php echo $user['state']=='odisha' ? 'selected' : '' ;?>>Odisha</option>
            </select>
        </div>

        <div class="mb-3">
        <label>City : </label>
        <select name="city" class="form-select">
            <option value="surat" <?php echo $user['state']=='surat' ? 'selected' : '' ; ?>>Surat</option>
            <option value="bikaner" <?php echo $user['city']=='bikaner' ? 'selected' : '' ; ?>>Bikaner</option>
            <option value="ganganagar" <?php echo $user['city']=='ganganagar' ? 'selected' : '' ; ?>>ganganagar</option>

        </select>
        </div>

        <div class="mb-3">
            <label>Current photo : </label>
            <img src="profile/<?php echo htmlspecialchars($user['photo']);?>" width="120"><br>
            <label class="mt-2">New Photo : </label>
            <input type="file" name = "photo" class="form-control">
        </div>

    </div>
    <button type="submit" class="btn btn-primary w-100 mt-3">Save Changes</button>
</form>

</div>

</body>


</html>