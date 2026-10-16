<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location:index.php");
    exit();
}

?>
<html>
    <div class= "container mt-5">
        <div class="card shadow p-4">
            <h3 class="text-center mb-4">Change Password</h3>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <form action="pass_process.php" method="post">
            <?php if(isset($_GET['empty'])){?>
            <div class="alert alert-danger">Please Fill All Fields</div>
            
            <?php
            };if(isset($_GET['mismatch'])){
            ?>
            <div class="alert alert-danger">Retype password</div>
            <?php
            };if(isset($_GET['short'])){
            ?>
            <div class="alert alert-danger">Use Atleast 6 numbers or alphabets</div>
            <?php
            };if(isset($_GET['wrong'])){
            ?>
            <div class="alert alert-danger">Wrong Password</div>
            <?php
            };
            if(isset($_GET['done'])){
            ?>
            <div class="alert alert-success">Password Changed</div>
            <?php
            };
            ?>

                <div class="mb-3">
                    <label>Current Password : </label>
                    <input type="password" name="old_pass" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>New Password : </label>
                    <input type="password" name="new_pass" class="form-control" requierd>
                </div>

                <div class="mb-3">
                    <label>Confirm Password : </label>
                    <input type="passord" name="confirm_pass" class="form-control" required>
                </div>

                <div class="mb-3">
                    <button class="btn btn-danger">Save Changes</button>

                </div>
            </form>
        </div>
    </div>
</html>