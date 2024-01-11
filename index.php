<?php include 'includes/db.php' ?>

<?php include 'includes/header.php' ?>

<!-- Navigation -->
<?php include 'includes/navigation.php' ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <!-- <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1> -->

            <!-- First Blog Post -->
            <?php $per_page = 5; ?>
            <?php $page = ""; ?>

            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];

                if ($page == 1) {
                    $set_post_no = 0;
                } else {
                    $set_post_no = ($page * $per_page) - $per_page;
                }
            } else {
                $set_post_no = 0;
            }
            ?>

            <?php
            $query = "SELECT * FROM posts";
            $data = mysqli_query($connection, $query);
            $count = mysqli_num_rows($data);
            $count = ceil($count / $per_page);

            $query_for_post_data = "SELECT * FROM posts LIMIT $set_post_no, $per_page";
            $result = mysqli_query($connection, $query_for_post_data);

            while ($row = mysqli_fetch_assoc($result)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0, 150);
                $post_status = $row['post_status'];
                $post_view_counts = $row['post_view_counts'];

                if ($post_status == 'published') {
            ?>
                    <h2 class=".font-weight-bolder">
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="post_author.php?a_name=<?php echo $post_author; ?>"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>

                    <hr>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="images/<?php echo $post_image ?>" alt=""></a>
                    <hr>
                    <small style="color:gray; display:block; text-align:end;"><?php echo $post_view_counts ?> views</small>
                    <br>
                    <p><?php echo $post_content ?></p>

                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
            <?php
                }
            }
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php' ?>

    </div>
    <!-- /.row -->

    <ul class="pager">
        <?php
        for ($i = 1; $i <= $count; $i++) {
            if ($i == $page) {
                echo "<li><a class='active' href='index.php?page={$i}'>$i</a></li>";
            } else {
                echo "<li><a href='index.php?page={$i}'>$i</a></li>";
            }
        }
        ?>
        <li></li>
    </ul>

    <!-- Footer -->
    <?php include 'includes/footer.php' ?>