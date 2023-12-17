<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "select * from users";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_image = $row['user_image'];

            echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$username</td>";
            echo "<td>$user_firstname</td>";

            // $query_for_cat_title = "select * from categories where cat_id = $post_category_id";
            // $result_for_cat_title = mysqli_query($connection, $query_for_cat_title);
            // while ($row = mysqli_fetch_assoc($result_for_cat_title)) {
            //     $cat_title = $row['cat_title'];
            // }
            // echo "<td>$cat_title</td>";

            echo "<td>$user_lastname</td>";
            echo "<td>$user_email</td>";
            echo "<td>$user_role</td>";
            // echo "<td>$query_for_post_title_data</td>";
            // $query_for_post_title = "SELECT post_title FROM posts WHERE post_id = $comment_post_id";
            // $query_for_post_title_data = mysqli_query($connection, $query_for_post_title);
            // while ($row = mysqli_fetch_assoc($query_for_post_title_data)) {
            //     $result_for_post_title = $row['post_title'];
            // }
            // echo "<td><a href='../post.php?p_id=$comment_post_id'>$result_for_post_title</a></td>";
            // echo "<td>$comment_date</td>";
            // echo "<td><a href='comments.php?c_status_app=$comment_id='>Approve</a></td>";
            // echo "<td><a href='comments.php?c_status_unapp=$comment_id='>Unapprove</a></td>";
            // echo "<td><a href='posts.php?delete='>Edit</a></td>";
            // echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
            // echo "</tr>";
            echo "<td><a href='users.php?change_role=$user_id'>change role</a></td>";
            echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
            echo "</tr>";
        }

        if (isset($_GET['delete'])) {
            $delete_user_id = $_GET['delete'];
            $delete_user_id_query = "DELETE from users where user_id = {$delete_user_id}";
            $delete_user_query = mysqli_query($connection, $delete_user_id_query);
            header("Location: users.php");
        }

        if (isset($_GET['change_role'])) {
            $change_user_id = $_GET['change_role'];
            $query = "SELECT user_role from users WHERE user_id = '{$change_user_id}'";
            $query_result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($query_result)) {
                $user_role = $row['user_role'];
            }
            if ($user_role == 'admin') {
                $user_role_change_query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = '{$change_user_id}'";
                $user_role_change_query_result = mysqli_query($connection, $user_role_change_query);
            } else {
                $user_role_change_query = "UPDATE users SET user_role = 'admin' WHERE user_id = '{$change_user_id}'";
                $user_role_change_query_result = mysqli_query($connection, $user_role_change_query);
            }
            header("Location: users.php");
        }

        // if (isset($_GET['c_status_unapp'])) {
        //     $comment_status_id = $_GET['c_status_unapp'];
        //     $comment_status_unapprove_query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = '{$comment_status_id}'";
        //     $comment_status_unapprove_query_result = mysqli_query($connection, $comment_status_unapprove_query);
        //     header("Location: comments.php");
        // }
        ?>
    </tbody>
</table>