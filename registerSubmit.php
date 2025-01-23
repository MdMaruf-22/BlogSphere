<?php 

include "./includes/db.php";

include "./includes/header.php";

?>

<div class="container mt-3">

    <div class="row my-5">
        <div class="col-md-6 mx-auto">
            <form method="POST" action="submit.php">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter your full name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="termsCheck" required>
                    <label class="form-check-label" for="termsCheck">I agree to the terms and conditions</label>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
        
</div>

<?php include('./includes/footer.php'); ?>
