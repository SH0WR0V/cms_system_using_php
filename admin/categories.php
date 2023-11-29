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
                            <small>Author</small>
                        </h1>



                        <div class="col-xs-6">

                            <?php
                            if (isset($_POST['submit'])) {
                                $cat_title = $_POST['cat_title'];
                                if ($cat_title == "" || empty($cat_title)) {
                                    echo "<h4>* this field should not be empty</h4>";
                                } else {
                                    $query = "INSERT INTO categories(cat_title) value('$cat_title')";
                                    $create_query = mysqli_query($connection, $query);
                                    if (!$create_query) {
                                        die('query failed' . mysqli_error($connection));
                                    }
                                }
                            }
                            ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" name="cat_title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-primary">
                                </div>
                            </form>
                        </div>

                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $query = "select * from categories";
                                    $result = mysqli_query($connection, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $cat_title = $row['cat_title'];
                                        $cat_id = $row['cat_id'];
                                        echo "<tr>";
                                        echo "<td>{$cat_id}</td>";
                                        echo "<td>{$cat_title}</td>";
                                        echo "<td><a href = 'categories.php?delete={$cat_id}'>Delete</a></td>";
                                        echo "</tr>";
                                    }

                                    if (isset($_GET['delete'])) {
                                        $get_cat_id = $_GET['delete'];
                                        $query = "DELETE FROM categories WHERE cat_id = $get_cat_id";
                                        mysqli_query($connection, $query);
                                        header("Location: categories.php");
                                    }

                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

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