<?php
if (isset($_POST['create_user'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $username = $_POST['username'];

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    $password = $_POST['password'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];
    // $post_date = date('d-m-y');
    // $post_comment_count = 4;

    // move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT into users (username, user_firstname, user_lastname, password, user_email, user_role) 
    VALUES ('{$username}', '{$user_firstname}', '{$user_lastname}', '{$password}', '{$user_email}', '{$user_role}')";
    $insert_query = mysqli_query($connection, $query);
    header("Location: users.php");
}

?>



<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <!-- <div class="form-group">
        <label for="image">Select Image</label>
        <input type="file" name="image">
    </div> -->

    <div class="form-group">
        <label for="user_role">Select Role</label>
        <select name="user_role" id="user_role">
            <option value="admin">admin</option>
            <option value="subscriber">subscriber</option>
        </select>

        <!-- <input type="text" class="form-control" name="post_category_id"> -->
    </div>

    <!-- <div class="form-group">
        <label for="randSalt">Rand Salt</label>
        <input type="text" class="form-control" name="randSalt">
    </div> -->

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Create User">
    </div>
</form>