<?php
include "./includes/db.php";
include "./includes/header.php";

if (isset($_GET['post_id'])) {
    $post_id = intval($_GET['post_id']); 


    $query = "SELECT posts.*, users.name as user_name, categories.category 
              FROM posts 
              JOIN users ON posts.user_id = users.user_id 
              JOIN categories ON posts.category_id = categories.category_id 
              WHERE posts.post_id = $post_id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $post = $result->fetch_assoc();
        ?>
        <div class="container mt-5">
            <h1 class="mb-4"><?php echo htmlspecialchars($post['title']); ?></h1>
            <img src="images/blogs/<?php echo htmlspecialchars($post['image']); ?>" class="img-fluid mb-4" alt="Post Image">
            <p><?php echo nl2br(htmlspecialchars($post['details'])); ?></p>
            <p class="text-muted mt-4"><strong>Category:</strong> <?php echo htmlspecialchars($post['category']); ?></p>
            <p class="text-muted"><strong>Posted by:</strong> <?php echo htmlspecialchars($post['user_name']); ?></p>
            <p class="text-muted"><strong>Date:</strong> <?php echo htmlspecialchars($post['date_time']); ?></p>
        </div>
        <?php
    } else {
        echo "<div class='container mt-5'><p class='alert alert-danger'>Post not found.</p></div>";
    }
} else {
    echo "<div class='container mt-5'><p class='alert alert-danger'>Invalid post ID.</p></div>";
}

include "./includes/footer.php";
?>
