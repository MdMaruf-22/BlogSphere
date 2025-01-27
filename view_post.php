<?php
include "./includes/db.php";
include "./includes/header.php";

if (isset($_SESSION['user_id']) && isset($_GET['post_id'])) {
    $post_id = intval($_GET['post_id']);
    $user_id = $_SESSION['user_id']; 


    $query = "SELECT posts.*, users.name as user_name, categories.category 
              FROM posts 
              JOIN users ON posts.user_id = users.user_id 
              JOIN categories ON posts.category_id = categories.category_id 
              WHERE posts.post_id = $post_id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $post = $result->fetch_assoc();

        $is_owner = ($post['user_id'] == $user_id);

  
        $likes_query = "SELECT users.name FROM likes JOIN users ON likes.user_id = users.user_id WHERE likes.post_id = $post_id";
        $likes_result = $conn->query($likes_query);

 
        $comments_query = "SELECT comments.comment_id, comments.comment_text, comments.date_time, users.name, users.user_id AS commenter_id 
                           FROM comments 
                           JOIN users ON comments.user_id = users.user_id 
                           WHERE comments.post_id = $post_id 
                           ORDER BY comments.date_time DESC";
        $comments_result = $conn->query($comments_query);
        ?>

        <div class="container mt-5">
            <h1 class="mb-4"><?php echo htmlspecialchars($post['title']); ?></h1>
            <img src="images/blogs/<?php echo htmlspecialchars($post['image']); ?>" class="img-fluid mb-4" alt="Post Image">
            <p><?php echo nl2br(htmlspecialchars($post['details'])); ?></p>
            <p class="text-muted mt-4"><strong>Category:</strong> <?php echo htmlspecialchars($post['category']); ?></p>
            <p class="text-muted"><strong>Posted by:</strong> <?php echo htmlspecialchars($post['user_name']); ?></p>
            <p class="text-muted"><strong>Date:</strong> <?php echo htmlspecialchars($post['date_time']); ?></p>


            <div class="mt-4">
                <h3>Likes:</h3>
                <?php
                if ($likes_result->num_rows > 0) {
                    while ($like = $likes_result->fetch_assoc()) {
                        echo '<p class="mb-1"><i class="fa-regular fa-user"></i> ' . htmlspecialchars($like['name']) . '</p>';
                    }
                } else {
                    echo '<p>No likes yet.</p>';
                }
                ?>
            </div>


            <div class="mt-4">
                <h3>Comments:</h3>

                <?php
                if ($comments_result->num_rows > 0) {
                    while ($comment = $comments_result->fetch_assoc()) {
                        echo '<div class="mb-2 border p-3 rounded">
                                <strong>' . htmlspecialchars($comment['name']) . ':</strong> ' . htmlspecialchars($comment['comment_text']) . '
                                <p class="text-muted"><small>' . $comment['date_time'] . '</small></p>';

                        if ($is_owner) {
                            echo '<form action="delete_comment.php" method="POST" class="d-inline">
                                    <input type="hidden" name="comment_id" value="' . $comment['comment_id'] . '">
                                    <input type="hidden" name="post_id" value="' . $post_id . '">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                  </form>';
                        }

                        echo '</div>';
                    }
                } else {
                    echo '<p>No comments yet.</p>';
                }
                ?>
            </div>
        </div>
        <?php
    } else {
        echo "<div class='container mt-5'><p class='alert alert-danger'>Post not found.</p></div>";
    }
} else {
    echo "<div class='container mt-5'><p class='alert alert-danger'>Invalid post ID or you are not logged in.</p></div>";
}

include "./includes/footer.php";
?>
