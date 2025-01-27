<?php 
include "./includes/db.php";
include "./includes/header.php";

if (isset($_SESSION['user_email']) && !empty($_SESSION['user_email'])) {
?>

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="mb-4">About Section</h1>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title">Hello! I'm Mohammed Maruf Islam</h4>
                        <p class="card-text">
                            I created this project while learning PHP as part of the EDGE course, which is conducted by the Government of Bangladesh. This project is a part of my journey in Software Engineering. I am currently in the 3rd year, 2nd semester of my studies at Noakhali Science and Technology University.
                        </p>
                        <p class="card-text">
                            EDGE is a fantastic program that has allowed me to develop practical skills while continuing my academic studies. You can learn more about the EDGE course and its initiatives on their official website: <a href="https://edge.gov.bd/" target="_blank">EDGE Course</a>.
                        </p>
                        <p class="card-text">
                            Thank you for visiting my page, and feel free to explore the website to see the progress I've made!
                        </p>

                        <h5>Connect with Me</h5>
                        <p>If you'd like to get in touch, you can reach me via email or connect with me on LinkedIn:</p>
                        
                        <ul class="list-unstyled">
                            <li><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:marufislam74208@gmail.com">marufislam74208@gmail.com</a></li>
                            <li><i class="fa fa-linkedin"></i> <strong>LinkedIn:</strong> <a href="https://www.linkedin.com/in/mohammed-maruf-islam-545280248/" target="_blank">Connect with me on LinkedIn</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 
} else {
    header("location: login.php");
}

include('./includes/footer.php');
?>
