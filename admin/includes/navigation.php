<?php
$session = session_id();
$time = time();
$time_out_in_seconds = 30;
$time_out = $time - $time_out_in_seconds;
$userid = $_SESSION['userid'];
// $query_for_count = "SELECT * FROM users WHERE session = '$session'";
// $query_for_count_result = mysqli_query($connection, $query_for_count);
// $count = mysqli_num_rows($query_for_count_result);
// $user_session = $row['session'];
// $user_time = $row['time'];
// if ($count == NULL) {
mysqli_query($connection, "UPDATE users SET session = '$session', time = '$time' WHERE user_id = $userid");
// } else {
//     mysqli_query($connection, "UPDATE users SET time = $time WHERE user_id = $userid");
// }

$users_online_count = mysqli_query($connection, "SELECT * FROM users WHERE time > $time_out");
$users_online_count_result = mysqli_num_rows($users_online_count);


?>



<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./index.php">CMS Admin</a>
    </div>

    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li><a href="">Users Online: <?php echo $users_online_count_result; ?></a></li>
        <li><a href="../index.php">Home Site</a></li>


        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <small><?php echo $_SESSION['username'] ?></small> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>


            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa-solid fa-file-lines"></i> Posts<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts_dropdown" class="collapse">
                    <li>
                        <a href="./posts.php"> View All Posts</a>
                    </li>
                    <li>
                        <a href="./posts.php?source=add_post"> Add Posts</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="./categories.php"><i class="fa-solid fa-list"></i> Categories</a>
            </li>

            <li>
                <a href="./comments.php"><i class="fa-solid fa-comments"></i> Comments</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa-solid fa-users"></i> Users<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="./users.php">View all users</a>
                    </li>
                    <li>
                        <a href="./users.php?source=add_user">Add users</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>