<?php

include "includes/header.php";

?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php

        include "includes/navigation.php";

        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['username'] ?></small>
                        </h1>

                    </div>
                </div>



                <?php

                if (isset($_SESSION['username'])) {

                    $query = "SELECT * FROM users WHERE username = '{$_SESSION['username']}'";
                    $query_result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($query_result)) {
                        // $user_id = $row['user_id'];
                        $username = $row['username'];
                        $password = $row['password'];
                        $user_firstname = $row['user_firstname'];
                        $user_lastname = $row['user_lastname'];
                        $user_email = $row['user_email'];
                    }
                }

                if (isset($_POST['edit_profile'])) {
                    $user_firstname = $_POST['user_firstname'];
                    $user_lastname = $_POST['user_lastname'];
                    $username = $_POST['username'];

                    // $post_image = $_FILES['image']['name'];
                    // $post_image_temp = $_FILES['image']['tmp_name'];

                    $password = $_POST['password'];
                    $user_email = $_POST['user_email'];
                    // $post_date = date('d-m-y');
                    // $post_comment_count = 4;

                    // move_uploaded_file($post_image_temp, "../images/$post_image");

                    $query = "update users set ";
                    $query .= "username = '{$username}', ";
                    $query .= "user_firstname = '{$user_firstname}', ";
                    $query .= "user_lastname = '{$user_lastname}', ";
                    $query .= "password = '{$password}', ";
                    $query .= "user_email = '{$user_email}' ";
                    $query .= "where username = '{$_SESSION['username']}'";
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

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
                    </div>

                    <div class="form-group">
                        <label for="user_email">Email</label>
                        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
                    </div>

                    <!-- <div class="form-group">
        <label for="image">Select Image</label>
        <input type="file" name="image">
    </div> -->

                   

                    <!-- <div class="form-group">
        <label for="randSalt">Rand Salt</label>
        <input type="text" class="form-control" name="randSalt">
    </div> -->

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="edit_profile" value="Update Profile">
                    </div>
                </form>


                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <?php

    include "includes/footer.php";

    ?>