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

                // $contact = "contact";
                // $registration = "ragistration";

                while ($row = mysqli_fetch_assoc($result)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    $category_class = "";
                    $registration_class = "";
                    $contact_class = "";
                    $page_name = basename($_SERVER['PHP_SELF']);
                    $registration = "registration.php";
                    $contact = "contact.php";

                    if (isset($_GET['categories']) && $_GET['categories'] == $cat_id) {
                        $category_class = "active";
                    } elseif ($page_name == $registration) {
                        $registration_class = "active";
                    } elseif ($page_name == $contact) {
                        $contact_class = "active";
                    }

                    echo "<li class = '$category_class'><a href='categories.php?categories=$cat_id'>{$cat_title}</a></li>";
                }
                ?>

                <li class="<?php echo $contact_class ?>">
                    <a href="contact.php">Contact us</a>
                </li>


                <li class="<?php echo $registration_class ?>">
                    <a href="registration.php">Register</a>
                </li>

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                    echo "<li>";
                    echo "<a href='admin'>Admin</a>";
                    echo "</li>";
                } ?>



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