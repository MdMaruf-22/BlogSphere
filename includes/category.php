<div class="col-lg-4">
<div>
    <h5>Categories</h5>
    <ul>

    <?php 
        $category_sql = "SELECT * FROM categories";
        $category_result = $conn->query($category_sql);

        if ($category_result->num_rows > 0) {
            while($row = $category_result->fetch_assoc()) {
                echo '<li><a href="category.php?category_id=' . $row['category_id'] . '">'. $row['category'] .'</a></li>' ;
            }
        }
    ?>
    </ul>
</div>
</div>