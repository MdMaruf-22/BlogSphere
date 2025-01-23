<?php
include "./includes/db.php";
include "./includes/header.php";


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in to view your posts.'); window.location.href='index.php';</script>";
    exit();
}


$user_id = $_SESSION['user_id'];


$query = "SELECT posts.*, categories.category FROM posts 
          INNER JOIN categories ON posts.category_id = categories.category_id 
          WHERE posts.user_id = '$user_id' ORDER BY posts.date_time DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<div class="container mt-5">
    <h2>My Posts</h2>
    <div class="row">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($post = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars(substr($post['details'], 0, 100)) ?>...</p>
                            <p class="text-muted">Category: <?= htmlspecialchars($post['category']) ?></p>
                            <p class="text-muted">Date: <?= htmlspecialchars($post['date_time']) ?></p>
                            <a href="view_post.php?post_id=<?= $post['post_id'] ?>" class="btn btn-primary">Read More</a>
                            <a href="edit_post.php?post_id=<?= $post['post_id'] ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_post.php?post_id=<?= $post['post_id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">You haven't created any posts yet.</p>
        <?php endif; ?>
    </div>
</div>

<?php include './includes/footer.php'; ?>
