<?php
    if(isset($_POST['checkBoxArray'])){
        foreach ($_POST['checkBoxArray'] as $checkBoxArray){
            $bulk_options = $_POST['bulk_options'];

            switch($bulk_options){
                case 'published':
                    $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = {$checkBoxArray}";
                    $query_result = mysqli_query($connection, $query);
                    break;

                case 'draft':
                    $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = {$checkBoxArray}";
                    $query_result = mysqli_query($connection, $query);
                    break;

                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = {$checkBoxArray}";
                    $query_result = mysqli_query($connection, $query);
                    break;
            }
        }
    }
?>


<form action="" method = "post">


<table class="table table-bordered table-hover">

<div id="bulkOptionContainer"  class="col-xs-4">
    <select name="bulk_options" id="" class="form-control">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
    </select>
</div>
<div class="col-xs-4">
    <input type="submit" name="submit" value="Apply" class="btn btn-success">
    <a href="" class="btn btn-primary">Add New</a>
</div>
<br><br><br>
    <thead>
        <tr>
            <th><input type="checkbox" id="selectAllBoxs"></th>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Content</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "select * from posts";
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
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];

            echo "<tr>";
            ?>
                <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $post_id ?>"></td>
            <?php
            echo "<td>$post_id</td>";
            echo "<td>$post_author</td>";
            echo "<td>$post_title</td>";

            $query_for_cat_title = "select * from categories where cat_id = $post_category_id";
            $result_for_cat_title = mysqli_query($connection, $query_for_cat_title);
            while ($row = mysqli_fetch_assoc($result_for_cat_title)) {
                $cat_title = $row['cat_title'];
            }
            echo "<td>$cat_title</td>";

            echo "<td>$post_status</td>";
            echo "<td><img width='80' src='../images/$post_image' alt='image'></td>";
            echo "<td>$post_content</td>";
            echo "<td>$post_tags</td>";
            echo "<td>$post_comment_count</td>";
            echo "<td>$post_date</td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
            echo "</tr>";
        }

        if (isset($_GET['delete'])) {
            $delete_post_id = $_GET['delete'];
            $query = "DELETE from posts where post_id = {$delete_post_id}";
            $delete_post_query = mysqli_query($connection, $query);
            header("Location: posts.php");
        }
        ?>
    </tbody>
</table>

</form>