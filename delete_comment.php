<?php
include "./includes/db.php";
session_start();

if (isset($_SESSION['user_id']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment_id = intval($_POST['comment_id']);
    $post_id = intval($_POST['post_id']);
    $user_id = $_SESSION['user_id'];

    $query = "SELECT posts.user_id 
              FROM comments 
              JOIN posts ON comments.post_id = posts.post_id 
              WHERE comments.comment_id = $comment_id AND posts.user_id = $user_id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $delete_query = "DELETE FROM comments WHERE comment_id = $comment_id";
        if ($conn->query($delete_query)) {
            header("Location: view_post.php?post_id=$post_id");
        } else {
            echo "Error deleting comment.";
        }
    } else {
        echo "You do not have permission to delete this comment.";
    }
} else {
    echo "Invalid request.";
}
?>
