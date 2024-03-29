<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="search here">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <?php
    if (!isset($_SESSION['role'])) {
    ?>
        <div class="well">
            <h4>Login</h4>
            <form action="includes/login.php" method="post">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="enter username">
                </div>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="enter password">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit" name="login">
                            Login
                        </button>
                    </span>
                </div>

            </form>
            <!-- /.input-group -->
        </div>
    <?php
    }
    ?>


    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">

                    <?php
                    $query = "select * from categories";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                        echo "<li><a href='categories.php?categories=$cat_id'>{$cat_title}</a></li>";
                    }
                    ?>


                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include 'widget.php'; ?>

</div>