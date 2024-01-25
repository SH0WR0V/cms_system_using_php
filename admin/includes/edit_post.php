<?php

if (isset($_GET['p_id'])) {
    $edit_post_id = $_GET['p_id'];
}

$query = "select * from posts where post_id = $edit_post_id";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_date = $row['post_date'];
}

if (isset($_POST['update_post'])) {
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category'];
    $post_author = $_POST['author'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if (empty($post_image)) {
        $query = "select * from posts where post_id = $edit_post_id";
        $select_image_query = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_image_query)) {
            $post_image = $row['post_image'];
        }
    }

    $query = "update posts set ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_date = now(), ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "where post_id =  {$edit_post_id}";

    $update_query = mysqli_query($connection, $query);

    if (!$update_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    echo "<p class='bg-success'><b>Post Updated  </b><a href='../post.php?p_id=$edit_post_id'> check post</a> or <a href='./posts.php'> edit more posts?</a></p>";
    echo "<br>";
}

?>




<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $post_title ?>">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select name="post_category" id="post_category">
            <?php
            $query = "SELECT * from categories";
            $categories_query_result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($categories_query_result)) {
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
                if ($cat_id == $post_category_id) {
                    echo "<option selected value=$cat_id>{$cat_title}</option>";
                } else {
                    echo "<option value=$cat_id>{$cat_title}</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author" value="<?php echo $post_author ?>">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="radio" name="post_status" value="<?php echo $post_status; ?>" checked><?php echo $post_status; ?>
        <?php
        if ($post_status === 'published') {
            echo "<input type='radio' name='post_status' value='draft'> Draft";
        } else {
            echo "<input type='radio' name='post_status' value='published'> Published";
        }
        ?>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label><br>
        <img src="../images/<?php echo $post_image; ?>" alt="" width=200>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags ?>">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo "$post_content" ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
</form>