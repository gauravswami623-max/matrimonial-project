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

$me    = $_SESSION['user_id'];
$other = (int)$_GET['id'];

$stmt = $pdo->prepare("
    SELECT sender_id, message, created_at
    FROM messages
    WHERE (sender_id = :me1 AND receiver_id = :other1)
       OR (sender_id = :other2 AND receiver_id = :me2)
    ORDER BY created_at ASC
");
$stmt->execute([
    ':me1' => $me, ':other1' => $other,
    ':other2' => $other, ':me2' => $me
]);
$chat = $stmt->fetchAll();

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
<p>Religion : <?php echo htmlspecialchars($p['religion']);?></p>
<p>Caste : <?php echo htmlspecialchars($p['caste']);?></p>
<p>State : <?php echo htmlspecialchars($p['state']);?></p>
<p>City : <?php echo htmlspecialchars($p['city']);?></p>
<p>Country : <?php echo htmlspecialchars($p['country']);?></p>
<p>Date Of Birth : <?php echo htmlspecialchars($p['birth']);?></p>

<h6 class="mt-4">Conversation</h6>

<?php if(empty($chat)){ ?>
    <p class="text-muted">No messages yet. Say hello!</p>
<?php } ?>

<?php foreach($chat as $c){ ?>
    <div class="mb-2 <?php echo ($c['sender_id'] == $me) ? 'text-end' : ''; ?>">
        <span class="d-inline-block p-2 rounded <?php echo ($c['sender_id'] == $me) ? 'bg-primary text-white' : 'bg-light'; ?>">
            <?php echo htmlspecialchars($c['message']); ?>
        </span><br>
        <small class="text-muted"><?php echo htmlspecialchars($c['created_at']); ?></small>
    </div>
<?php } ?>

<?php if(isset($_GET["sent"])){?>
<div class="alert alert-success">Message Sent</div>
<?php } ?>
<?php if(isset($_GET["err"])){?>
<div class="alert alert-danger">Message could not be sent</div>
<?php }?>
<form method="post" action="send_message.php" class="mt-3">
    <input type="hidden" name="receiver_id" value="<?php echo (int)$_GET['id'];?>" >
    <textarea name="message" class="form-control mb-2" rows="3" placeholder="Write a message..." required></textarea>
    <button type="submit" class="btn btn-primary btn-sm">Send Message</button>

</form>
<a href="browse.php" class="btn btn-outline-secondary btn-sm" >Back to Profiles</a>
</div>

</div>

</body>

</html>
