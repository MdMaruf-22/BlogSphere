<?php
include "./includes/db.php";
include "./includes/header.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in to edit your post.'); window.location.href='login.php';</script>";
    exit();
}


$post_id = $_GET['post_id'];
$user_id = $_SESSION['user_id'];


$query = "SELECT * FROM posts WHERE post_id = '$post_id' AND user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Post not found or you do not have permission to edit it.'); window.location.href='my_posts.php';</script>";
    exit();
}

$post = mysqli_fetch_assoc($result);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);


    $update_query = "UPDATE posts SET title = '$title', details = '$details', category_id = '$category_id' WHERE post_id = '$post_id' AND user_id = '$user_id'";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Post updated successfully!'); window.location.href='my_posts.php';</script>";
    } else {
        echo "<script>alert('Error: Unable to update post.'); window.location.href='edit_post.php?post_id=$post_id';</script>";
    }
}
?>
<div class="container mt-5">
    <h2>Edit Post</h2>
    <form method="POST" action="edit_post.php?post_id=<?= $post['post_id'] ?>">
        <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" name="title" class="form-control" id="title" value="<?= htmlspecialchars($post['title']) ?>" required>
        </div>
        <div class="form-group">
            <label for="details">Post Details</label>
            <textarea name="details" class="form-control" id="details" rows="5" required><?= htmlspecialchars($post['details']) ?></textarea>
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control" id="category_id" required>
                <option value="1" <?= ($post['category_id'] == 1) ? 'selected' : '' ?>>Web Development</option>
                <option value="2" <?= ($post['category_id'] == 2) ? 'selected' : '' ?>>Tech News</option>
                <!-- Add more categories as needed -->
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>

<?php include './includes/footer.php'; ?>
