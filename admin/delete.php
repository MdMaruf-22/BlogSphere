<?php

include "./includes/db.php" ;

if(isset($_GET['id'])){
    $post_id = intval($_GET['id']);
    $delete_query = "DELETE FROM posts WHERE post_id = $post_id";
    if ($conn->query($delete_query)) {
        echo "<script>alert('Post deleted successfully.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Failed to delete post.'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('Invalid Post ID.'); window.location.href='index.php';</script>";
}
?>