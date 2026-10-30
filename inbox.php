<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("location:index.php");
    exit();
}

require 'db.php';


$stmt = $pdo->prepare("
    SELECT m.id, m.message, m.created_at, u.sn, u.fname, u.lname
    FROM messages m
    JOIN users u ON m.sender_id = u.sn
    WHERE m.receiver_id = :me
    ORDER BY m.created_at DESC
");
$stmt->execute([':me'=> $_SESSION["user_id"]]);
$messages = $stmt->fetchALL();
?>

<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Inbox</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>

        <body>
            <div class="container mt-5">
                <h3 class="mb-4">Inbox</h3>

                <?php if(empty($messages)){?>
                    <div class = "alert alert-info">No Messages</div>
                <?php }?>

                <?php foreach($messages as $m){?>
                <div class="card mb-3">
                    <div class="card-body">

                        <h6>
                            <a href="view.php?id=<?php echo $m['sn'];?>">
                            <?php echo htmlspecialchars($m['fname']. " " .$m['lname']);?>
                            </a>
                        </h6>
                        <p><?php echo htmlspecialchars($m['message']); ?></p>
                        
                    </div>
                    <small class="text-muted" <?php echo htmlspecialchars($m['created_at']); ?> >Reply</small>

                    <form method="post" action="delete_message.php" class="d-inline">
                        <input type="hidden" name="message_id" value="<?php echo (int)$m['id']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm mt-2">Delete</button>
                    </form>
                </div>
                <?php }?>
                
                
            </div>
            
        </body>
    </html>