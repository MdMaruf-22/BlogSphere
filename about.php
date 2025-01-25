<?php 

include "./includes/db.php" ;

include "./includes/header.php";



if(isset($_SESSION['user_email']) && !empty($_SESSION['user_email']))
{

?>


    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-8">

            <h1>About Section</h1>

        </div>
    </div>


    <?php 
    
}
else
{
    header("location: login.php");
}

    include('./includes/footer.php'); 
    
    ?>