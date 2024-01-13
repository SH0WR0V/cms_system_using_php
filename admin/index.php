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
                <!-- /.row -->




                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query = "SELECT * FROM posts";
                                        $query_result = mysqli_query($connection, $query);
                                        $post_counts = mysqli_num_rows($query_result);
                                        ?>
                                        <div class='huge'><?php echo $post_counts; ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query = "SELECT * FROM comments";
                                        $query_result = mysqli_query($connection, $query);
                                        $comment_counts = mysqli_num_rows($query_result);
                                        ?>
                                        <div class='huge'><?php echo $comment_counts; ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query = "SELECT * FROM users";
                                        $query_result = mysqli_query($connection, $query);
                                        $user_counts = mysqli_num_rows($query_result);
                                        ?>
                                        <div class='huge'><?php echo $user_counts; ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query = "SELECT * FROM categories";
                                        $query_result = mysqli_query($connection, $query);
                                        $category_counts = mysqli_num_rows($query_result);
                                        ?>
                                        <div class='huge'><?php echo $category_counts; ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>


                <?php
                $query_for_published_posts = "SELECT * FROM posts where post_status = 'published'";
                $query_for_published_posts_result = mysqli_query($connection, $query_for_published_posts);
                $published_posts_count = mysqli_num_rows($query_for_published_posts_result);

                $query_for_draft_posts = "SELECT * FROM posts where post_status = 'draft'";
                $query_for_draft_posts_result = mysqli_query($connection, $query_for_draft_posts);
                $draft_posts_count = mysqli_num_rows($query_for_draft_posts_result);

                $query_for_app_comments = "SELECT * FROM comments where comment_status = 'approved'";
                $query_for_app_comments_result = mysqli_query($connection, $query_for_app_comments);
                $app_comments_count = mysqli_num_rows($query_for_app_comments_result);

                $query_for_unapp_comments = "SELECT * FROM comments where comment_status = 'unapproved'";
                $query_for_unapp_comments_result = mysqli_query($connection, $query_for_unapp_comments);
                $unapp_comments_count = mysqli_num_rows($query_for_unapp_comments_result);

                $query_for_user_admin = "SELECT * FROM users where user_role = 'admin'";
                $query_for_user_admin_result = mysqli_query($connection, $query_for_user_admin);
                $query_for_user_admin_result_count = mysqli_num_rows($query_for_user_admin_result);

                $query_for_user_subscriber = "SELECT * FROM users where user_role = 'subscriber'";
                $query_for_user_subscriber_result = mysqli_query($connection, $query_for_user_subscriber);
                $query_for_user_subscriber_count = mysqli_num_rows($query_for_user_subscriber_result);
                ?>


                <div class="row">
                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['bar']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Data', 'Count'],
                                <?php
                                $title = ['Active Posts', 'Draft Posts', 'Approved Comments', 'Unapproved Comments', 'Admins', 'Subscribers', 'Categories'];
                                $value = [$published_posts_count, $draft_posts_count, $app_comments_count, $unapp_comments_count, $query_for_user_admin_result_count, $query_for_user_subscriber_count, $category_counts];

                                for ($i = 0; $i < 7; $i++) {
                                    echo "['{$title[$i]}'" . "," . "{$value[$i]}],";
                                }
                                ?>
                                // ['posts', 100],

                            ]);

                            var options = {
                                chart: {
                                    title: '',
                                    subtitle: '',
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>




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