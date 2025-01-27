<?php
include "./includes/db.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You must be logged in to comment on a post.'); window.location.href='login.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = mysqli_real_escape_string($conn, $_POST['post_id']);
    $user_id = $_SESSION['user_id'];
    $comment_text = mysqli_real_escape_string($conn, $_POST['comment_text']);

    $insert_query = "INSERT INTO comments (post_id, user_id, comment_text, date_time) VALUES ('$post_id', '$user_id', '$comment_text', NOW())";
    if ($conn->query($insert_query)) {
        echo "<script>alert('Comment added successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error adding the comment.'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='index.php';</script>";
}
?>
