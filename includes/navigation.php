<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Home</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php
                $query = "select * from categories";
                $result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<li><a href='categories.php?categories=$cat_id'>{$cat_title}</a></li>";
                }
                ?>
                <li>
                    <a href="admin">Admin</a>
                </li>

                <li>
                    <a href="registration.php">Register</a>
                </li>

                <!-- <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li> -->


            </ul>
            <?php if (isset($_SESSION['username'])) {
            ?>
                <ul class="navbar-right top-nav">
                    <li class="dropdown">

                        <a href="#" style="margin-top: 10px;" class="dropdown-toggle btn btn-success" data-toggle="dropdown"><small><?php if (isset($_SESSION['username'])) {
                                                                                                                                        echo $_SESSION['username'];
                                                                                                                                    } ?></small> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <!-- <li>
                            <a href=""><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li> -->
                            <!-- <li class="divider"></li> -->
                            <li>
                                <a href="includes/logout.php">Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            <?php
            } ?>



        </div>
        <!-- /.navbar-collapse -->

    </div>

    <!-- /.container -->
</nav>