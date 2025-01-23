<?php 

include "./includes/db.php" ;

include "./includes/header.php";

?>


    <div class="container mt-3">

        <div class="row my-5">
            <div class="col-md-6 mx-auto">
                <h4>User Registration Form</h4>
                <hr>
                <form method="POST" action="registrationSubmit.php">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name" required>
                        
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
            
    </div>


    <?php include('./includes/footer.php'); ?>