<?php include 'includes/db.php' ?>

<?php include 'includes/header.php' ?>

<!-- Navigation -->
<?php include 'includes/navigation.php' ?>

<?php include 'functions.php' ?>



<?php
if (isset($_GET['u_id'])) {
    $post_id = $_GET['p_id'];
    $user_id = $_GET['u_id'];

    $query = "SELECT * FROM posts WHERE post_id=$post_id";
    $post_result = mysqli_query($connection, $query);
    $post = mysqli_fetch_array($post_result);
    $likes = $post['likes'];

    if (!login_user_liked_this_post_or_not($post_id)) {
        mysqli_query($connection, "UPDATE posts SET likes=$likes+1 WHERE post_id = $post_id");
        mysqli_query($connection, "INSERT INTO likes(user_id, post_id) VALUES($user_id, $post_id)");
        header("Location: post.php?p_id=$post_id");
    }
}
if (isset($_GET['user_id'])) {
    $post_id = $_GET['p_id'];
    $user_id = $_GET['user_id'];

    $query = "SELECT * FROM posts WHERE post_id=$post_id";
    $post_result = mysqli_query($connection, $query);
    $post = mysqli_fetch_array($post_result);
    $likes = $post['likes'];

    if (login_user_unliked_this_post_or_not($post_id)) {
        mysqli_query($connection, "UPDATE posts SET likes=$likes-1 WHERE post_id = $post_id");
        mysqli_query($connection, "DELETE FROM likes WHERE post_id = $post_id AND user_id = $user_id");
        header("Location: post.php?p_id=$post_id");
    }
}
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <!-- First Blog Post -->

            <?php
            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];

                $query_for_view_count = "UPDATE posts SET post_view_counts = post_view_counts + 1 WHERE post_id = {$post_id} AND post_status = 'published'";
                $query_for_view_count_result = mysqli_query($connection, $query_for_view_count);

                $query = "select * from posts where post_id = {$post_id} AND post_status = 'published'";
                $data = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($data)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
            ?>

                    <h2>
                        <a href=""><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="post_author.php?a_name=<?php echo $post_author; ?>"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                    <hr>


                    <?php while (mysqli_next_result($connection)) {;
                    } ?>



                    <div class="row">
                        <b class="pull-right" style="padding-right:14px; font-size: 15px;"><a href="post.php?p_id=<?php echo $post_id; ?>&u_id=<?php if (isset($_SESSION['userid'])) {
                                                                                                                                                    echo $_SESSION['userid'];
                                                                                                                                                } else {
                                                                                                                                                    echo 0;
                                                                                                                                                }  ?>"><span class="glyphicon glyphicon-thumbs-up"></span> Like </a>&nbsp<a href="post.php?p_id=<?php echo $post_id; ?>&user_id=<?php if (isset($_SESSION['userid'])) {
                                                                                                                                                                                                                                                                                    echo $_SESSION['userid'];
                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                    echo 0;
                                                                                                                                                                                                                                                                                }  ?>"><span class="glyphicon glyphicon-thumbs-down"></span> Unlike</a> | Likes: <?php get_post_likes($post_id); ?></b>
                    </div>


                    <?php while (mysqli_next_result($connection)) {;
                    } ?>


                    <br>
                    <p class="text-justify"><?php echo $post_content ?></p>

                    <hr>



                    <?php

                    if (isset($_POST['create_comment'])) {

                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];

                        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                            $comment_query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                            $comment_query .= "VALUES ($post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
                            $comment_query_data = mysqli_query($connection, $comment_query);
                        }
                    }

                    ?>
                    <?php
                    if (isset($_SESSION['username'])) {
                    ?>
                        <div class="well">
                            <h4>Leave a Comment:</h4>
                            <form action="" method="POST" role="form">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="write your name here" name="comment_author" value="<?php echo $_SESSION['username'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="write your email here" name="comment_email" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="3" placeholder="leave a comment" name="comment_content" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name="create_comment">Comment</button>
                            </form>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="well">
                            <h4>Leave a Comment:</h4>
                            <form action="" method="POST" role="form">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="please login to continue" name="comment_author" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="please login to continue" name="comment_email" readonly>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="3" placeholder="please login to continue" name="comment_content" readonly></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name="create_comment">Comment</button>
                            </form>
                        </div>
                    <?php
                    }
                    ?>


            <?php }
            } else {
                header("Location: index.php");
            }
            ?>

            <hr>

            <!-- Posted Comments -->



            <?php

            $query_for_showing_comments = "SELECT * FROM comments WHERE comment_post_id = '{$post_id}' ORDER BY comment_id DESC";
            $query_for_showing_comments_data = mysqli_query($connection, $query_for_showing_comments);
            while ($row = mysqli_fetch_assoc($query_for_showing_comments_data)) {
                $comment_content = $row['comment_content'];
                $comment_date = $row['comment_date'];
                $comment_author = $row['comment_author'];
                $comment_status = $row['comment_status'];

                if ($comment_status == 'approved') {
            ?>
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author; ?>
                                <small><?php echo $comment_date; ?></small>
                            </h4>
                            <?php echo $comment_content; ?>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php' ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>