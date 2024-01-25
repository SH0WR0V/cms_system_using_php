<?php

function check_query($query)
{
    global $connection;
    if (!$query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
}

function login_user_liked_this_post_or_not($post_id)
{
    global $connection;
    if (isset($_SESSION['userid'])) {
        $userid = $_SESSION['userid'];
        $query = "SELECT * FROM likes WHERE post_id = $post_id AND user_id = $userid";
        $result = mysqli_query($connection, $query);
        return mysqli_num_rows($result) >= 1 ? true : false;
    } else {
        echo "<script>alert('Please login to like this post')</script>";
        return true;
    }
}

function login_user_unliked_this_post_or_not($post_id)
{
    global $connection;
    if (isset($_SESSION['userid'])) {
        $userid = $_SESSION['userid'];
        $query = "SELECT * FROM likes WHERE post_id = $post_id AND user_id = $userid";
        $result = mysqli_query($connection, $query);
        return mysqli_num_rows($result) >= 1 ? true : false;
    } else {
        echo "<script>alert('Please login to unlike this post')</script>";
        return false;
    }
}

function get_post_likes($post_id)
{
    global $connection;
    $query = "SELECT likes FROM posts WHERE post_id = $post_id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);
    echo $row['likes'];
}
