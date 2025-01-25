<?php 

include "./includes/db.php";
include "./includes/header.php";

?>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-8">

        <?php
            $search = $_GET['search'] ?? '';
            $search_terms = explode(' ', $search);

            $query_conditions = [];
            foreach ($search_terms as $term) {
                $term = $conn->real_escape_string($term);
                $query_conditions[] = "(posts.title LIKE '%$term%' OR posts.details LIKE '%$term%')";
            }

            if (!empty($query_conditions)) {
                $sql = "SELECT posts.*, users.name as user_name, categories.category 
                        FROM posts 
                        JOIN users ON posts.user_id = users.user_id 
                        JOIN categories ON posts.category_id = categories.category_id 
                        WHERE " . implode(' OR ', $query_conditions);
                
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="card mb-3">
                                <img src="images/blogs/' . $row['image'] . '" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>
                                    <p class="card-text">' . htmlspecialchars($row['details']) . '</p>
                                    <p class="card-text"><small class="text-muted">Posted by ' . htmlspecialchars($row['user_name']) . ' in ' . htmlspecialchars($row['category']) . '</small></p>
                                </div>
                              </div>';
                    }
                } else {
                    echo '<p class="alert alert-warning">No results found for your search.</p>';
                }
            } else {
                echo '<p class="alert alert-warning">Please enter a search term.</p>';
            }
        ?>

        </div>
    </div>
</div>

<?php include "./includes/footer.php"; ?>
