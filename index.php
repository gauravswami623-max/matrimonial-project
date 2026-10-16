<div class = "container mt-5">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">log-in</h3>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <form method="post" action="check.php">
              <?php if(isset($_GET["successful"])){
                    ?>
                    <div class="alert alert-success">User is login</div>
                    <?php
                    };
                    ?>
        <div class="row"> 

            <label>Email : </label>
            <input type ="text" name="email"><br><br>

            <label>Password : </label>
            <input type="password" name="pass"><br>

            <button type="submit" class="btn btn-danger">submit</button>

         </div> 

        </form>

        <h4>if you do not have any account yet you can create your own profile click below</h4><br>
        <a href="registration.php"><button class="btn btn-primary">create account</button></a>
   </div>
</div>