<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>

        <?php
        if (isset($_GET['edit'])) {
            $get_cat_id_for_edit = $_GET['edit'];
            $query_for_edit = "select * from categories where cat_id = $get_cat_id_for_edit";
            $result_for_edit = mysqli_query($connection, $query_for_edit);
            while ($row = mysqli_fetch_assoc($result_for_edit)) {
                $cat_title_for_edit = $row['cat_title'];
            }
        ?>
            <input type="text" value="<?php if (isset($cat_title_for_edit)) {
                                            echo $cat_title_for_edit;
                                        } ?>" name="cat_title" class="form-control">
        <?php
        }
        ?>


    </div>

    <?php
    if (isset($_POST['update'])) {
        $cat_title_for_update = $_POST['cat_title'];
        $query_for_update = "update categories set cat_title = '$cat_title_for_update' where cat_id = $get_cat_id_for_edit";
        $result_for_update = mysqli_query($connection, $query_for_update);
    }
    ?>
    <div class="form-group">
        <input type="submit" name="update" class="btn btn-primary" value="Update">
    </div>
</form>