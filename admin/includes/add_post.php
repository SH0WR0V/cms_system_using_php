<?php
if (isset($_POST['create_post'])) {
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    // $post_date = date('d-m-y');
    // $post_comment_count = 4;

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT into posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) 
    VALUES ('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";
    $insert_query = mysqli_query($connection, $query);
    echo "<p class='bg-success'><b>New Post Added  </b><a href='./posts.php'>  go back?</a></p>";
    echo "<br>";
}

?>



<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" required>
    </div>

    <div class="form-group">
        <label for="post_category">Post Category Id</label>
        <select name="post_category_id" id="post_category_id">

            <?php
            $query_for_selecting_all_categories = "SELECT * from categories";
            $categories_query_result = mysqli_query($connection, $query_for_selecting_all_categories);
            while ($row = mysqli_fetch_assoc($categories_query_result)) {
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>
        </select>

        <!-- <input type="text" class="form-control" name="post_category_id"> -->
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author" required>
    </div>


    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="radio" name="post_status" value="draft" checked> Draft
        <input type="radio" name="post_status" value="published"> Published
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" required>
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10" required></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>

</form>