<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Registration Form</h3>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

                    <?php
                    if(isset($_GET["empty"])){
                    
                    ?>
                        <div class="alert alert-danger">please fill all fields</div>
                    
                    <?php
                    };
                    if(isset($_GET["exists"])){
                    ?>
                    <div class="alert alert-danger">This account already exist</div>
                    <?php
                    };
                    if(isset($_GET["nophoto"])){
                    ?>
                    <div class="alert alert-danger">Please put a photo</div>
                    <?php
                    };
                    if(isset($_GET["badfile"])){
                    ?>
                    <div class="alert alert-danger">Only give jpg,png,jpeg photo file otherwise it won't accept photo</div>
                    <?php
                    };?>
              

            <form method="post" action="log.php" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3" >
                        <label>First Name : </label>
                        <input type="text" name="fname" class="form-control" required><br><br>
                    </div>
                    <div class="col-md-6 mb-3" >
                        <label>Last Name : </label>
                        <input type="text" name="lname" class="form-control" required><br><br>
                    </div>
                    <div class="mb-3">
                        <label>Email : </label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password : </label>
                        <input type="password" name="pass" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Gender : </label>
                        <input type="radio" name="gender" value="male">Male
                        <input type="radio" name="gender" value="female">Female
                    </div>
                    <div class="mb-3">
                        <label>Occupation : </label>
                        <input type="text" name="occ" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>DOB : </label>
                        <input type="date" name="date" required>
                    </div>
                        <div class="mb-3">
                            <label>Religion : </label>
                            <select name="religion" class="form-select">
                                <option value="hindu">Hindu</option>
                                <option value="muslim">Muslim</option>
                                <option value="christain">Christain</option>
                            </select>
                        </div>
                    <div class="mb-3">
                        <label>Caste : </label>
                        <select name = "caste" class="form-select">
                            <option value="swami">Swami</option>
                            <option value="lamba">Lamba</option>
                            <option value="pathan">Pathan</option>
                            <option value="mohammad">Mohammad</option>
                            <option value="haaland">Haaland</option>
                            <option value="loan">Loan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Country : </label>
                        <select name="country" class="form-select">
                            <option value="india">India</option>
                            <option value="iran">Iran</option>
                            <option value="america">America</option>
                            <option value="pakistan">Pakistan</option>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label>State : </label>
                        <select name="state" class="form-select">
                        <option value="rajasthan">Rajasthan</option>
                        <option value="punjab">Punjab</option>
                        <option value="haryana">Haryana</option>
                        <option value="odisha">Odisha</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>City : </label>
                        <select name="city" class="form-select">
                        <option value="surat">Surat</option>
                        <option value="bikaner">Bikaner</option>
                        <option value="ganganagar">Ganganagar</option>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Upload Image : </label>
                        <input type="file" name="photo">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3">submit</button>

                </div>
            </form>
            
    </div>
</div>