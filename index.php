<?php
include "./includes/db.php";
include "./includes/header.php";

if (isset($_SESSION['user_email']) && !empty($_SESSION['user_email'])) {
?>

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-8">

                <?php
                $sql = "SELECT posts.*, users.name as user_name, categories.category 
                        FROM posts 
                        JOIN users ON posts.user_id = users.user_id 
                        JOIN categories ON posts.category_id = categories.category_id 
                        WHERE posts.status = 'Approved'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $post_id = $row['post_id'];

                        $like_count_query = "SELECT COUNT(*) AS like_count FROM likes WHERE post_id = $post_id";
                        $like_count_result = $conn->query($like_count_query);
                        $like_count = $like_count_result->fetch_assoc()['like_count'] ?? 0;

                        $user_id = $_SESSION['user_id'];
                        $user_like_query = "SELECT * FROM likes WHERE post_id = $post_id AND user_id = $user_id";
                        $user_like_result = $conn->query($user_like_query);
                        $liked = $user_like_result->num_rows > 0;

                        $comment_count_query = "SELECT COUNT(*) AS comment_count FROM comments WHERE post_id = $post_id";
                        $comment_count_result = $conn->query($comment_count_query);
                        $comment_count = $comment_count_result->fetch_assoc()['comment_count'] ?? 0;

                        $comments_query = "SELECT comments.comment_id, comments.comment_text, users.name, comments.user_id AS comment_user_id, comments.date_time
                                           FROM comments 
                                           JOIN users ON comments.user_id = users.user_id 
                                           WHERE comments.post_id = $post_id 
                                           ORDER BY comments.date_time DESC";
                        $comments_result = $conn->query($comments_query);

                        echo '<div class="card mb-3">
                                    <img src="images/blogs/' . $row['image'] . '" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $row['title'] . '</h5>
                                        <p class="card-text">' . $row['details'] . '</p>
                                        <p class="card-text"> <i class="fa-regular fa-clock"></i> <small class="text-muted">' . $row['date_time'] . '</small></p>
                                        <p><i class="fa-solid fa-user"></i> By ' . $row['user_name'] . '</p>
                                        <p><i class="fa-solid fa-list"></i> Category: ' . $row['category'] . '</p>

                                        <!-- Like Button -->
                                        <button class="btn ' . ($liked ? 'btn-success' : 'btn-primary') . ' btn-sm like-btn" data-post-id="' . $post_id . '">
                                            <i class="fa-regular fa-thumbs-up"></i> ' . ($liked ? 'Liked' : 'Like') . ' (<span class="like-count">' . $like_count . '</span>)
                                        </button>

                                        <!-- Comment Section -->
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="collapse" data-bs-target="#comments-' . $post_id . '">
                                            <i class="fa-regular fa-comments"></i> Comment (' . $comment_count . ')
                                        </button>

                                        <!-- Comments Section -->
                                        <div id="comments-' . $post_id . '" class="collapse mt-3">
                                            <form action="add_comment.php" method="POST" class="mb-3">
                                                <input type="hidden" name="post_id" value="' . $post_id . '">
                                                <textarea name="comment_text" class="form-control" rows="2" placeholder="Add a comment..." required></textarea>
                                                <button type="submit" class="btn btn-primary btn-sm mt-2">Submit</button>
                                            </form>';

                        if ($comments_result->num_rows > 0) {
                            while ($comment = $comments_result->fetch_assoc()) {
                                $comment_user_id = $comment['comment_user_id']; 
                                $current_user_id = $_SESSION['user_id'];  

                                echo '<div class="mb-3 p-3 border rounded bg-light">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <strong>' . htmlspecialchars($comment['name']) . ':</strong>
                                                <p>' . htmlspecialchars($comment['comment_text']) . '</p>
                                            </div>
                                            <div class="text-muted small">
                                                <p><i class="fa-regular fa-clock"></i> ' . $comment['date_time'] . '</p>
                                            </div>
                                        </div>';

                                
                                if ($comment_user_id == $current_user_id) {
                                    echo '<form action="delete_my_comment.php" method="POST" class="d-inline">
                    <input type="hidden" name="comment_id" value="' . $comment['comment_id'] . '">
                    <input type="hidden" name="post_id" value="' . $post_id . '">
                    <button type="submit" class="btn btn-danger btn-sm mt-2">Delete</button>
                </form>';
                                }

                                echo '</div>';
                            }
                        } else {
                            echo '<p>No comments yet.</p>';
                        }

                        echo '</div> <!-- End Comments Section -->
                                    </div>
                                </div>';
                    }
                }
                ?>

            </div>

            <?php include('./includes/category.php') ?>

        </div>
    </div>


<?php
} else {
    header("location: login.php");
}

include('./includes/footer.php');
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const likeButtons = document.querySelectorAll('.like-btn');

        likeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.dataset.postId;
                const likeCountSpan = this.querySelector('.like-count');

                fetch('like_post.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `post_id=${postId}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            likeCountSpan.textContent = data.like_count;
                            if (data.liked) {
                                this.classList.remove('btn-primary');
                                this.classList.add('btn-success');
                                this.innerHTML = `<i class="fa-regular fa-thumbs-up"></i> Liked (<span class="like-count">${data.like_count}</span>)`;
                            } else {
                                this.classList.remove('btn-success');
                                this.classList.add('btn-primary');
                                this.innerHTML = `<i class="fa-regular fa-thumbs-up"></i> Like (<span class="like-count">${data.like_count}</span>)`;
                            }
                        } else {
                            alert('Error updating like status.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
