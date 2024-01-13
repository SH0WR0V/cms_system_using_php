<?php
include "db.php";
include "../functions.php";
session_start();
?>

<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users where username = '{$username}'";
    $result_query = mysqli_query($connection, $query);

    check_query($result_query);


    while ($row = mysqli_fetch_assoc($result_query)) {
        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_password = $row['password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_email = $row['user_email'];
        $db_user_role = $row['user_role'];
    }

    if ($username === $db_username && $password === $db_password && $db_user_role === "admin") {
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['role'] = $db_user_role;
        $_SESSION['userid'] = $db_id;
        header("Location: ../admin");
    } else {
        header("Location: ../index.php");
    }
}
?>
