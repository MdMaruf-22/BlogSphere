<?php
include "./includes/db.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to like or unlike a post.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = mysqli_real_escape_string($conn, $_POST['post_id']);
    $user_id = $_SESSION['user_id'];

    $check_query = "SELECT * FROM likes WHERE post_id = '$post_id' AND user_id = '$user_id'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        $delete_query = "DELETE FROM likes WHERE post_id = '$post_id' AND user_id = '$user_id'";
        $conn->query($delete_query);
        $liked = false;
    } else {
        $insert_query = "INSERT INTO likes (post_id, user_id) VALUES ('$post_id', '$user_id')";
        $conn->query($insert_query);
        $liked = true;
    }

    $like_count_query = "SELECT COUNT(*) AS like_count FROM likes WHERE post_id = '$post_id'";
    $like_count_result = $conn->query($like_count_query);
    $like_count = $like_count_result->fetch_assoc()['like_count'];

    echo json_encode(['success' => true, 'liked' => $liked, 'like_count' => $like_count]);
    exit();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    exit();
}
?>
