<?php 
include "./includes/db.php";
include "./includes/header.php";
?>

<div class="container mt-3">
    <div class="row my-5">
        <div class="col-md-6 mx-auto">
            <h2>Create a Post</h2>
            <form method="POST" action="createPostSubmit.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter post title" required>
                </div>
                <div class="form-group">
                    <label for="details">Post Details</label>
                    <textarea name="details" class="form-control" id="details" rows="5" placeholder="Enter post details" required></textarea>
                </div>
               
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category_id" class="form-control" id="category" required>
                        <?php
                        $query = "SELECT * FROM categories";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row['category_id']}'>{$row['category']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Upload Image</label>
                    <input type="file" name="image" class="form-control" id="image" accept="image/*" required>
                </div>

                <button type="submit" class="btn btn-primary">Create Post</button>
            </form>
        </div>
    </div>
</div>

<?php include('./includes/footer.php'); ?>