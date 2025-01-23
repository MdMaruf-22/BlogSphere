<?php
include "./includes/db.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in to delete your post.'); window.location.href='login.php';</script>";
    exit();
}

$post_id = $_GET['post_id'];
$user_id = $_SESSION['user_id'];

$query = "DELETE FROM posts WHERE post_id = '$post_id' AND user_id = '$user_id'";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Post deleted successfully!'); window.location.href='my_posts.php';</script>";
} else {
    echo "<script>alert('Error: Unable to delete post.'); window.location.href='my_posts.php';</script>";
}
?>
