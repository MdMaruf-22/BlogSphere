<?php

include "./includes/db.php";

include "./includes/header.php";


?>


<div class="container mt-3">
    <div class="row">
        <div class="col-lg-8">

            <?php
            $category_id = $_GET['category_id'];

            $sql = "SELECT posts.*, users.name as user_name, categories.category 
            FROM posts JOIN users ON posts.user_id=users.user_id 
            JOIN categories ON posts.category_id=categories.category_id 
            WHERE posts.category_id= $category_id AND posts.status = 'Approved'" ;
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    echo '<div class="card mb-3">
                                        <img src="images/blogs/' . $row['image'] . '" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">' . $row['title'] . '</h5>
                                            <p class="card-text">' . $row['details'] . '</p>
                                            <p class="card-text"> <i class="fa-regular fa-clock"></i> <small class="text-muted">' . $row['date_time'] . '</small></p>
                                            <p><i class="fa-solid fa-user"></i> By ' . $row['user_name'] . '</p>
                                            <p><i class="fa-solid fa-list"></i> Category: ' . $row['category'] . '</p>
                                        </div>
                                    </div>';
                }
            }
            ?>



        </div>

        <?php include('./includes/category.php') ?>

    </div>
</div>

<?php





include('./includes/footer.php');

?>