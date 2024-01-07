<?php include 'includes/db.php' ?>

<?php include 'includes/header.php' ?>

<!-- Navigation -->
<?php include 'includes/navigation.php' ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

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
                    <p><?php echo $post_content ?></p>

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

                            $comment_count_query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = '{$post_id}'";
                            $comment_count_query_data = mysqli_query($connection, $comment_count_query);
                        }
                        // $post_id = $_GET['p_id'];
                        else {
                            echo "<script>alert('Please fill all the boxes')</script>";
                        }
                    }

                    ?>

                    <div class="well">
                        <h4>Leave a Comment:</h4>
                        <form action="" method="POST" role="form">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="write your name here" name="comment_author">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="write your email here" name="comment_email">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" placeholder="leave a comment" name="comment_content"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="create_comment">Comment</button>
                        </form>
                    </div>

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
    <?php include 'includes/footer.php' ?>