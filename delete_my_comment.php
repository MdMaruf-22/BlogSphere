<?php
include "./includes/db.php";

session_start();

if (isset($_SESSION['user_id']) && isset($_POST['comment_id']) && isset($_POST['post_id'])) {
    $comment_id = intval($_POST['comment_id']);
    $post_id = intval($_POST['post_id']);
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM comments WHERE comment_id = $comment_id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $comment = $result->fetch_assoc();

        if ($comment['user_id'] == $user_id) {
            $delete_query = "DELETE FROM comments WHERE comment_id = $comment_id";
            if ($conn->query($delete_query)) {
                header("Location: index.php");
                exit();
            } else {
                echo "<p class='alert alert-danger'>Error deleting comment.</p>";
            }
        } else {
            echo "<p class='alert alert-danger'>You are not authorized to delete this comment.</p>";
        }
    } else {
        echo "<p class='alert alert-danger'>Comment not found.</p>";
    }
} else {
    echo "<p class='alert alert-danger'>Invalid request.</p>";
}
?>
