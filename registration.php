<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<!-- Navigation -->

<?php include "includes/navigation.php"; ?>

<?php
$message = "";
$message2 = "";
$message3 = "";

$query = "SELECT username From users";
$result = mysqli_query($connection, $query);

// if (isset($_POST['username'])) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         $db_username = $row['username'];
//         if ($_POST['username'] === $db_username) {
//             $message3 = "*username is already taken";
//         }
//     }
// }

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($email) && !empty($password)) {
        $username = mysqli_real_escape_string($connection, $username);

        $query = "SELECT username FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) != 0) {
            $message3 = "*username is already taken";
        } else {

            $email = mysqli_real_escape_string($connection, $email);
            $password = mysqli_real_escape_string($connection, $password);
            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
            $query_for_registration = "INSERT into users (username, password, user_email, user_role) 
            VALUES ('{$username}', '{$password}', '{$email}', 'subscriber')";
            $insert_query = mysqli_query($connection, $query_for_registration);
            unset($message);
            unset($username);
            unset($email);
            $message = "";
            $message2 = "Registration Successful";
            // header("Location: registration.php");

        }
    } else {
        $message = "*This Field cannot be empty";
    }
}

?>


<!-- Page Content -->
<div class="container">


    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <b class="bg-danger"><?php if (isset($message3)) {
                                                    echo $message3;
                                                }  ?></b>
                        <b class="bg-success"><?php if (isset($message2)) {
                                                    echo $message2;
                                                }  ?></b>
                        <form action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <div><b style="color:red;"><?php if (empty($username)) {
                                                                echo $message;
                                                            } ?></b></div>
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" value="<?php if (isset($username)) {
                                                                                                                                                        echo $username;
                                                                                                                                                    }  ?>">
                            </div>
                            <div class="form-group">
                                <div><b style="color:red;"><?php if (empty($email)) {
                                                                echo $message;
                                                            } ?></b></div>
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" value="<?php if (isset($email)) {
                                                                                                                                                echo $email;
                                                                                                                                            }  ?>">
                            </div>
                            <div class="form-group">
                                <div><b style="color:red;"><?php if (empty($password)) {
                                                                echo $message;
                                                            } ?></b></div>
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password" value="">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-success btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>