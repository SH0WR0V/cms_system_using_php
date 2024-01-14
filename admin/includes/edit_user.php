<?php

if (isset($_GET['edit_user'])) {
    $edit_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = '{$edit_user_id}'";
    $query_result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($query_result)) {
        // $user_id = $row['user_id'];
        $username = $row['username'];
        // $password = $row['password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
    }
}

if (isset($_POST['edit_user'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $username = $_POST['username'];

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    // $password = $_POST['password'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];
    // $post_date = date('d-m-y');
    // $post_comment_count = 4;

    // move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "update users set ";
    $query .= "username = '{$username}', ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    // $query .= "password = '{$password}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_role = '{$user_role}' ";
    $query .= "where user_id =  {$edit_user_id}";
    $insert_query = mysqli_query($connection, $query);
    header("location: ./users.php");
}

?>



<form action="" method="post">

    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
    </div>

    <!-- <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
    </div> -->

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
    </div>

    <!-- <div class="form-group">
        <label for="image">Select Image</label>
        <input type="file" name="image">
    </div> -->

    <div class="form-group">
        <label for="user_role">Select Role</label>
        <select name="user_role" id="user_role">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
            <?php
            if ($user_role == 'admin') {
                echo "<option value='subscriber'>subscriber</option>";
            } else {
                echo "<option value='admin'>admin</option>";
            }
            ?>
        </select>

        <!-- <input type="text" class="form-control" name="post_category_id"> -->
    </div>

    <!-- <div class="form-group">
        <label for="randSalt">Rand Salt</label>
        <input type="text" class="form-control" name="randSalt">
    </div> -->

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
    </div>
</form>